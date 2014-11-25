'use strict';
module.exports = function(grunt) {

    // auto-load all grunt tasks matching the `grunt-*` pattern in package.json
    require('load-grunt-tasks')(grunt); // no need for grunt.loadNpmTasks!

    grunt.initConfig({
			pkg:    grunt.file.readJSON( 'package.json' ),
        // watch for changes and trigger sass, jshint, uglify and livereload
        watch: {
            sass: {
					options: { sourcemap: true },
                files: ['assets/sass/**/*.{scss,sass}'],
                tasks: ['sass', 'autoprefixer']
            },
            js: {
                files: '<%= jshint.all %>',
                tasks: ['jshint']
            },
            livereload: {
                options: { livereload: true },
                files: [ 
					 	'httpdocs/wp-content/themes/markbaindesign/*.php', 
						'httpdocs/wp-content/themes/markbaindesign/lib/**/*.php', 
						'assets/sass/**/*.{scss,sass}',
						'assets/js/*.js', 
						'httpdocs/wp-content/themes/markbaindesign/assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },
			
		  	// Bower

		  	bower: {
    			install: {	//just run 'grunt bower:install' and you'll see files from your Bower packages in lib directory
					options: { 
						targetDir: 'assets/bower_components',
						cleanup: true
					}
				}
  			},

			// Modernizr
			modernizr: {
    			dist: {
        			// [REQUIRED] Path to the build you're using for development.
        			"devFile" : "assets/bower_components/modernizr/modernizr.js",

        			// Path to save out the built file.
        			"outputFile" : "httpdocs/wp-content/themes/markbaindesign/assets/js/vendor/modernizr-custom.js",
		    	}

			},

        // sass
        sass: {
            dist: {
                options: {
                    sourcemap: true,
                    style: 'expanded',
                },
                files: {
                    'httpdocs/wp-content/themes/markbaindesign/assets/css/style.css': 'assets/sass/style.scss',
                }
            }
        },

        // autoprefixer
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4', 'android 3'],
                map: true
            },
            files: {
                expand: true,
                flatten: true,
                src: 'httpdocs/wp-content/themes/markbaindesign/assets/css/style.css',
                dest: 'httpdocs/wp-content/themes/markbaindesign'
            },
        },

		  bump: {
    			options: {

      updateConfigs: [],
      createTag: false,
      push: false,

    }
  },

		 // Version
		 version: {
		 	css: {
        		options: {
            	prefix: 'Version\\:\\s'
        		},
        		src: [ 'httpdocs/wp-content/themes/markbaindesign/style.css' ],
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
                'assets/js/source/**/*.js'
            ]
        },



        // image optimization
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 7,
                    progressive: true,
                    interlaced: true
                },
                files: [{
                    expand: true,
                    cwd: 'httpdocs/wp-content/themes/markbaindesign/assets/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'httpdocs/wp-content/themes/markbaindesign/assets/images/'
                }]
            }
        },

		  // Copy the plugin to a versioned release directory
		  copy: {
			main: {
				files:  [
					// includes files within path and its sub-directories
      			{expand: true, 
					cwd: 'httpdocs/wp-content/themes/markbaindesign/',
					src: [
						'**',
						'!style.css.map'
					], 
					dest: 'release/<%= pkg.name %>.<%= pkg.version %>/'},
					],
			},		
		},

		clean: {
			main: ['release/<%= pkg.name %>.<%= pkg.version %>']
		},

		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: 'release/<%= pkg.name %>.<%= pkg.version %>.zip'
				},
				expand: true,
				cwd: 'release/<%= pkg.name %>.<%= pkg.version %>',
				src: ['**/*'],
				dest: '<%= pkg.name %>/'
			}		
		}

    });

    // register tasks

    grunt.registerTask('default', [
	 	'sass', 
		'modernizr',		
		'jshint',
		'watch'
	]);

	grunt.registerTask('build', [
		'autoprefixer',
		'bump',
		'version',
		'copy', 
		'compress',
		'clean',
		'watch'
	]);

	

};
