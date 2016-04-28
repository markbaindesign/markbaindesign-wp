'use strict';

module.exports = function(grunt) {

    // auto-load all grunt tasks matching the `grunt-*` pattern in package.json
    // no need for grunt.loadNpmTasks!
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        /**
        *
        * Variables
        *
        */
			
        // Variables from package.json
        pkg: grunt.file.readJSON( 'package.json' ),

        // Global variables
        vars: grunt.file.readJSON( 'gruntVars.json' ),
        
        // README
        rdm: 'README.md', 

        /**
        *
        * Grunt plugin configuration
        *
        */

        // autoprefixer
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9'],
                map: true
            },
            target_file: {
               src: '<%= vars.theme_path %>/<%= vars.theme_name %>/style.css',
            },
        },

        // Increment the version number in package.json
	  	bump: {
			options: {
  			    updateConfigs: ['pkg'], // make sure to check updated pkg variables
  			    push: false,
                commitFiles: ['-a'], // Commit all files
                tagName: '%VERSION%',
                tagMessage: 'Bump the version to %VERSION%',
			}
		},

        // Delete temporary files
		clean: {
			main: ['release/<%= pkg.name %>.<%= pkg.version %>']
		},

        // Create an archive
		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: 'release/<%= pkg.name %>.<%= pkg.version %>.zip'
				},
				expand: true,
				cwd: 'release/<%= pkg.name %>.<%= pkg.version %>',
				src: ['**/*']
			}		
		},

        // Copy the plugin to a versioned release directory
        copy: {
            theme: {
                files:  [
                    // includes files within path and its sub-directories
                {expand: true, 
                    cwd: '<%= vars.theme_path %>/<%= vars.theme_name %>/',
                    src: [
                        '**',
                        '!style.css.map'
                    ], 
                    dest: 'release/<%= pkg.name %>.<%= pkg.version %>/<%= vars.theme_path %>/<%= vars.theme_name %>'},
                    ],
            },
            plugin: {
                files:  [
                    // includes files within path and its sub-directories
                {expand: true, 
                    cwd: 'httpdocs/wp-content/plugins/<%= pkg.name %>-custom-functions/',
                    src: [
                        '**',
                    ], 
                    dest: 'release/<%= pkg.name %>.<%= pkg.version %>/<%= vars.plugin_path %>/<%= vars.plugin_name %>'},
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
                    interlaced: true
                },
                files: [{
                    expand: true,
                    cwd: '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/images/'
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
                '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/js/source/**/*.js'
            ]
        },

        // Modernizr
        modernizr: {
            dist: {
                // [REQUIRED] Path to the build you're using for development.
                "devFile" : "bower_components/modernizr/modernizr.js",

                // Path to save out the built file.
                "outputFile" : "<%= vars.theme_path %>/<%= vars.theme_name %>/assets/js/source/vendor/modernizr-custom.js",
            }
        },

        // Sass
        sass: {
            dist: {
                options: {
                    style: 'expanded',
                },
                files: {
                    '<%= vars.theme_path %>/<%= vars.theme_name %>/style.css': 'sass/styles.scss',
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
            }       
        },

        // Version
        version: {
            bower: {
                options: {
                   prefix: '"version"\\:\\s"'
                },
                src: [ 'bower.json' ],
            },
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
            readme: {
                options: {
                    prefix: 'Version\ \s*'
                },
                src: [ '<%= rdm %>' ],
            },
            plugin: {
                options: {
                prefix: 'Version\\:\\s'
                },
                src: [ '<%= vars.plugin_path %>/<%= vars.plugin_name %>/<%= vars.plugin_name %>.php' ],
           },           
        },

        // watch for changes and trigger sass, jshint, uglify and livereload
        watch: {
            sass: {
                files: ['sass/**/*.{scss,sass}'],
                tasks: [
                        'sass', 
                        'autoprefixer'
                    ]
            },
            /*js: {
                files: '<%= jshint.all %>',
                tasks: ['jshint']
            },*/
            livereload: {
                options: { livereload: true },
                files: [

                    // Gruntfile
                    'Gruntfile.js',

                    // Theme files
                    '<%= vars.theme_path %>/<%= vars.theme_name %>/**/*.php', 
                    '<%= vars.theme_path %>/<%= vars.theme_name %>/lib/**/*.php',
                    '<%= vars.theme_path %>/<%= vars.theme_name %>/style.css', 
                    '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/js/source/**/*.js', 
                    '<%= vars.theme_path %>/<%= vars.theme_name %>/assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}',

                    // Plugin files
                    '<%= vars.plugin_path %>/<%= vars.plugin_name %>/**/*',

                ]
            }
        }

    });

    /**
    *
    * Register tasks
    *
    */

    grunt.registerTask('default', [
	 	'sass',
        'autoprefixer', 
		'modernizr',		
		'watch',
	]);

    grunt.registerTask( 'bump-minor', [
        'bump-only:minor',
        'version', 
        'bump-commit',        
    ]);

    grunt.registerTask( 'bump-patch', [
        'bump-only:patch',
        'version', 
        'bump-commit',        
    ]);

    // Build Task
    grunt.registerTask('build', [

        // NOTE
        // This task does not automatically bump the version
        // Precede with grunt bump:{major|minor|patch} to change the version in package.json

        // Update versions across the project
        'version', 

        // Make a copy of files for upload to the server
        'copy:theme',
        'copy:plugin', 

        // Create an archive from the copy
        'compress', 

        // Delete the uncompressed copy
        'clean', 

    ]);
	
	// Copy assets 
	grunt.registerTask('copyassets', [
		'copy:font_awesome',
        'copy:deploy_scripts'       
	]);	

    // Export entire WP site for deployment
    grunt.registerTask('export', [
        'shell:exp'
    ]); 

    // Import entire WP site for local development
    grunt.registerTask('import', [
        'shell:imp'
    ]); 

};