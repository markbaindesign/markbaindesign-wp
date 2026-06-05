'use strict';

module.exports = function (grunt) {

   require('load-grunt-tasks')(grunt);
   require('load-grunt-config')(grunt);

   // var mozjpeg = require('imagemin-mozjpeg');

   grunt.initConfig({

      /**
      *
      * Variables
      *
      */

      // Variables from package.json
      pkg: grunt.file.readJSON('package.json'),

      // Global variables
      vars: grunt.file.readJSON('gruntVars.json'),

      // README
      rdm: 'README.md',

      /**
      *
      * Grunt plugin configuration
      *
      */

      // BrowserSync
      browserSync: {
         dev: {
            bsFiles: {
               src: [
                  // Project root
                  'Gruntfile.js', // This is the only file we care about

                  // Theme files
                  '<%= vars.theme_path %>/<%= vars.theme_dir %>/**/*', // All

                  // Plugin files
                  '<%= vars.plugin_path %>/<%= vars.plugin_dir %>/**/*', // All
               ]
            },
            options: {
               watchTask: true,
               // https: {
               //     key: "path-to-custom.key",
               //     cert: "path-to-custom.crt"
               // },
               proxy: '<%= vars.url %>' // local url to proxy
            }
         }
      },

      // Delete temporary files
      clean: {
         dir_release: ['release/**/*'], // Clean out the release dir
         build: ['<%= vars.theme_path %>/<%= vars.theme_dir %>/assets/css/build/**/*'], // Clean out the release dir
         copy_theme: ['release/<%= pkg.name %>.<%= pkg.version %>/<%= vars.theme_dir %>.<%= pkg.version %>'],
         copy_plugin: ['release/plugins/**/*'],

         // Delete legacy stylesheets
         version: [
            '<%= vars.theme_path %>/<%= vars.theme_dir %>/<%= vars.stylesheet_name %>.<%= pkg.version %>.css',
            '<%= vars.theme_path %>/<%= vars.theme_dir %>/<%= vars.stylesheet_name %>.<%= pkg.version %>.min.css'],
      },

      // Create an archive
      compress: {

         plugin: {
            options: {
               mode: 'zip',
               archive: 'release/plugins/plugins.zip'
            },
            expand: true,
            cwd: 'release/plugins/',
            src: ['**/*']
         },

         theme: {
            options: {
               mode: 'zip',
               archive: 'release/theme/theme.zip'
            },
            expand: true,
            cwd: 'release/theme',
            src: ['**/*']
         }
      },

      concat: {
         css: {
            src: ['<%= vars.theme_path %>/<%= vars.theme_dir %>/assets/css/dev/**/*.css'], // all modular CSS
            dest: '<%= vars.theme_path %>/<%= vars.theme_dir %>/assets/css/build/style.css'
         }
      },

      postcss: {
         options: {
            map: false,
            processors: [
               require('autoprefixer')(),
               require('cssnano')(),
               // Uncomment PurgeCSS if you want to strip unused selectors
               // require('@fullhuman/postcss-purgecss')({
               //   content: ['**/*.php', '**/*.js'],
               //   safelist: ['.keep-this', /^js-/]
               // })
            ]
         },
         dist: {
            src: '<%= vars.theme_path %>/<%= vars.theme_dir %>/assets/css/build/style.css',
            dest: '<%= vars.theme_path %>/<%= vars.theme_dir %>/assets/css/build/style.min.css'
         }
      },

      // Copy files
      copy: {

         theme: {
            files: [
               {
                  expand: true, // includes files within path and its sub-directories
                  cwd: '<%= vars.theme_path %>/<%= vars.theme_name %>/', // Target dir
                  src: [
                     '**',
                     '!style.css.map',
                     '!**/*.*.orig' // Don't copy .orig copies
                  ],
                  dest: 'release/<%= pkg.name %>.<%= pkg.version %>/<%= vars.theme_name %>.<%= pkg.version %>'
               },
            ],
         },

         plugin: {
            files: [
               // includes files within path and its sub-directories
               {
                  expand: true,
                  cwd: '<%= vars.plugin_path %>/<%= vars.plugin_name %>', // Target dir
                  src: [
                     '**',
                     '!**/*.*.orig' // Don't copy .orig copies
                  ],
                  dest: 'release/<%= pkg.name %>.<%= pkg.version %>/<%= vars.plugin_name %>.<%= pkg.version %>'
               },
            ],
         },

         mu_plugins: {
            files: [
               // includes files within path and its sub-directories
               {
                  expand: true,
                  cwd: 'httpdocs/wp-content/mu-plugins/',
                  src: [
                     '**',
                  ],
                  dest: 'release/<%= pkg.name %>.<%= pkg.version %>/<%= vars.mu_plugin_path %>'
               },
            ],
         },

         font_awesome: {
            expand: true,
            flatten: true,
            src: ['bower_components/fontawesome/fonts/*'],
            dest: '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/fonts'
         },

         deploy_scripts: {
            expand: true,
            flatten: true,
            src: ['node_modules/mbd-wp-deploy-scripts/scripts/*'],
            dest: 'scripts'
         }
      },

      // Optimize images
      imagemin: {
         dist: {
            options: {
               optimizationLevel: 7,
               progressive: true,
               interlaced: true,
               use: [mozjpeg()],
            },
            files: [{
               expand: true,
               cwd: '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/images/src',
               src: ['**/*.{png,jpg,jpeg,gif}'],
               dest: '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/images/dist'
            }]
         }
      },

      // javascript linting with jshint
      jshint: {
         options: {
            jshintrc: '.jshintrc',
            "force": true
         },
         all: [
            'Gruntfile.js',
            '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/js/src/custom/**/*.js',
            '<%= vars.plugin_path %>/<%= vars.plugin_name %>/assets/js/src/custom/**/*.js',
         ]
      },

      // Modernizr
      modernizr: {
         dist: {
            // [REQUIRED] Path to the build you're using for development.
            "devFile": "bower_components/modernizr/modernizr.js",

            // Path to save out the built file.
            "outputFile": "<%= vars.theme_path %>/<%= vars.theme_name %>/assets/js/dist/custom/modernizr-custom.js",
         }
      },

      // Sass
      sass: {
         dist: {
            options: {
               style: 'expanded',
               sourceMap: true
            },
            files: {
               '<%= vars.theme_path %>/<%= vars.theme_name %>/style.css': 'sass/styles.scss',
               //'<%= vars.theme_path %>/<%= vars.theme_name %>/style-custom-login.css': 'sass/custom-login-styles.scss',
            }
         }
      },

      // Shell
      shell: {
         exp: {
            command: [
               'cd bin/scripts',
               './local-export.sh',
               'cd ../..'
            ].join('&&')
         },
         imp: {
            command: [
               'cd bin/scripts',
               './local-import.sh',
               'cd ../..'
            ].join('&&')
         },
         import_production_db: {
            command: 'scripts/',
         },
         project_stats: {
            command: 'du -sh httpdocs',
         },
         build_stats: {
            command: 'du -sh release',
         }
      },

      // Version
      version: {
         css: {
            options: {
               prefix: 'Version\\:\\s'
            },
            src: [
               'sass/styles.scss',

               // Edit the version directly in the generated CSS file.
               // Avoids having to run the Sass task just for this. 
               '<%= vars.theme_path %>/<%= vars.theme_name %>/style.css',
            ],
         },
         theme: {
            options: {
               prefix: 'Version\\:\\s'
            },
            src: [
               '<%= vars.theme_path %>/<%= vars.theme_name %>/theme-version.php',
            ],
         },
         readme: {
            options: {
               prefix: 'Version\ \s*'
            },
            src: ['<%= rdm %>'],
         },
         plugin: {
            options: {
               prefix: 'Version\\:\\s'
            },
            src: ['<%= vars.plugin_path %>/<%= vars.plugin_name %>/<%= vars.plugin_name %>.php'],
         },
      },

      // watch for changes and trigger sass, jshint, uglify and livereload
      watch: {
         sass: {
            files: ['sass/**/*.{scss,sass}'],
            tasks: [
               'sass',
               // 'autoprefixer',
               'shell:project_stats'
            ]
         },
         js: {
            files: '<%= jshint.all %>',
            tasks: [
               'jshint',
               'shell:project_stats'
            ]
         },
         img: {
            files: ['<%= vars.theme_path %>/<%= vars.theme_name %>/assets/images/src/*.{png,jpg,jpeg,gif,webp,svg}'],
            tasks: [
               'newer:imagemin:dist',
               'shell:project_stats'
            ]
         },
         livereload: {
            options: { livereload: true },
            files: [

               // Gruntfile
               'Gruntfile.js',

               // Theme files
               '<%= vars.theme_path %>/<%= vars.theme_name %>/**/*.php',
               '<%= vars.theme_path %>/<%= vars.theme_name %>/lib/**/*.php',
               '<%= vars.theme_path %>/<%= vars.theme_name %>/style.css',
               '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/js/src/**/*.js',
               '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/images/dist/**/*.{png,jpg,jpeg,gif,webp,svg}',

               // Plugin files
               '<%= vars.plugin_path %>/<%= vars.plugin_name %>/**/*',

            ]
         }
      }

   });
};
