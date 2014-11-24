'use strict';
module.exports = function(grunt) {

    // auto-load all grunt tasks matching the `grunt-*` pattern in package.json
    require('load-grunt-tasks')(grunt); // no need for grunt.loadNpmTasks!

    grunt.initConfig({

        // watch for changes and trigger sass, jshint, uglify and livereload
        watch: {
            sass: {
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

        // sass
        sass: {
            dist: {
                options: {
                    sourcemap: true,
                    style: 'expanded',
                },
                files: {
                    'httpdocs/wp-content/themes/markbaindesign/style.css': 'assets/sass/style.scss',
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
                src: 'httpdocs/wp-content/themes/markbaindesign/assets/styles/build/*.css',
                dest: 'httpdocs/wp-content/themes/markbaindesign/assets/styles/build'
            },
        },

        // css minify
        cssmin: {
            options: {
                keepSpecialComments: 1
            },
            minify: {
                expand: true,
                cwd: 'httpdocs/wp-content/themes/markbaindesign/assets/styles/build',
                src: ['*.css', '!*.min.css'],
					 dest: 'httpdocs/wp-content/themes/markbaindesign',
                ext: '.css'
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

        // uglify to concat, minify, and make source maps
        uglify: {
            plugins: {
                options: {
                    sourceMap: 'httpdocs/wp-content/themes/varee/assets/js/plugins.js.map',
                    sourceMappingURL: 'plugins.js.map',
                    sourceMapPrefix: 2
                },
                files: {
                    'httpdocs/wp-content/themes/varee/assets/js/plugins.min.js': [
                       	'httpdocs/wp-content/themes/varee/assets/js/vendor/responsive-nav.js',
                       	'httpdocs/wp-content/themes/varee/assets/js/vendor/slider.js',
                       	'httpdocs/wp-content/themes/varee/assets/js/vendor/jquery.sticky-kit.min.js',								
								'httpdocs/wp-content/themes/varee/assets/js/vendor/jquery.easing.1.3.min.js',
                       	'httpdocs/wp-content/themes/varee/assets/js/vendor/jquery.flexslider.js',
								'httpdocs/wp-content/themes/varee/assets/js/vendor/jquery.jcontent.0.8.js',
								'httpdocs/wp-content/themes/varee/assets/js/vendor/twitterFetcher.js',
		 						'httpdocs/wp-content/themes/varee/assets/js/vendor/jquery.milk.js',                       
		 						// 'httpdocs/wp-content/themes/varee/assets/js/vendor/yourplugin/yourplugin.js',
                    ]
                }
            },
            main: {
                options: {
                    sourceMap: 'httpdocs/wp-content/themes/varee/assets/js/main.js.map',
                    sourceMappingURL: 'main.js.map',
                    sourceMapPrefix: 2
                },
                files: {
                    'httpdocs/wp-content/themes/varee/assets/js/main.min.js': [
                        'httpdocs/wp-content/themes/varee/assets/js/source/main.js'
                    ]
                }
            },
            portfolio: {
                options: {
                    sourceMap: 'httpdocs/wp-content/themes/varee/assets/js/portfolio.js.map',
                    sourceMappingURL: 'portfolio.js.map',
                    sourceMapPrefix: 2
                },
                files: {
                    'httpdocs/wp-content/themes/varee/assets/js/portfolio.min.js': [
                        'httpdocs/wp-content/themes/varee/assets/js/source/portfolio.js'
                    ]
                }
            }
				
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
                    cwd: 'httpdocs/wp-content/themes/varee/assets/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'httpdocs/wp-content/themes/varee/assets/images/'
                }]
            }
        },

    });

    // register tasks

    grunt.registerTask('default', [
	 	'sass', 
		'autoprefixer', 
		'watch'
	]);

	grunt.registerTask('build', [
		'cssmin', 
		'uglify'
	]);

};
