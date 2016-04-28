'use strict';
module.exports = function(grunt) {

    // auto-load all grunt tasks matching the `grunt-*` pattern in package.json
    require('load-grunt-tasks')(grunt); // no need for grunt.loadNpmTasks!

    grunt.initConfig({
			pkg: grunt.file.readJSON( 'package.json' ),
            rdm: 'README.md',
        
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
				 	'httpdocs/wp-content/themes/<%= pkg.name %>/**/*.php', 
					'httpdocs/wp-content/themes/<%= pkg.name %>/lib/**/*.php',
					'httpdocs/wp-content/themes/<%= pkg.name %>/style.css', 
					'httpdocs/wp-content/themes/<%= pkg.name %>/assets/js/source/**/*.js', 
					'httpdocs/wp-content/themes/<%= pkg.name %>/assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}',

                    // Plugins
                    'httpdocs/wp-content/plugins/<%= pkg.name %>-custom-functions/**/*',

                ]
            }
        },
		


			// Modernizr
			modernizr: {
    			dist: {
        			// [REQUIRED] Path to the build you're using for development.
        			"devFile" : "bower_components/modernizr/modernizr.js",

        			// Path to save out the built file.
        			"outputFile" : "httpdocs/wp-content/themes/<%= pkg.name %>/assets/js/source/vendor/modernizr-custom.js",
		    	}

			},

        // sass
        sass: {
            dist: {
                options: {
                    style: 'expanded',
                },
                files: {
                    'httpdocs/wp-content/themes/<%= pkg.name %>/style.css': 'sass/styles.scss',
                }
            }
        },

        // autoprefixer
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9'],
                map: true
            },
            target_file: {
               src: 'httpdocs/wp-content/themes/<%= pkg.name %>/style.css',
            },
        },

		  	bump: {
    			options: {
      			updateConfigs: ['pkg'], // make sure to check updated pkg variables
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
        		src: [ 'sass/styles.scss' ],
            },
            readme: {
                options: {
                    prefix: 'Version\ \s*'
                },
                src: [ '<%= rdm %>' ],
            },
            plugin1: {
                options: {
                prefix: 'Version\\:\\s'
                },
                src: [ 'httpdocs/wp-content/plugins/<%= pkg.name %>-custom-functions/<%= pkg.name %>-custom-functions.php' ],
           },           
		},


        // javascript linting with jshint
        jshint: {
            options: {
                jshintrc: '.jshintrc',
                "force": true
            },
            all: [
                'Gruntfile.js',
                'httpdocs/wp-content/themes/<%= pkg.name %>/assets/js/source/**/*.js'
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
                    cwd: 'httpdocs/wp-content/themes/<%= pkg.name %>/assets/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'httpdocs/wp-content/themes/<%= pkg.name %>/assets/images/'
                }]
            }
        },

		  // Copy the plugin to a versioned release directory
		  copy: {
			theme: {
				files:  [
					// includes files within path and its sub-directories
      			{expand: true, 
					cwd: 'httpdocs/wp-content/themes/<%= pkg.name %>/',
					src: [
						'**',
						'!style.css.map'
					], 
					dest: 'release/<%= pkg.name %>.<%= pkg.version %>/wp-content/themes/<%= pkg.name %>'},
					],
			},
            plg1: {
                files:  [
                    // includes files within path and its sub-directories
                {expand: true, 
                    cwd: 'httpdocs/wp-content/plugins/<%= pkg.name %>-custom-functions/',
                    src: [
                        '**',
                    ], 
                    dest: 'release/<%= pkg.name %>.<%= pkg.version %>/wp-content/plugins/<%= pkg.name %>-custom-functions'},
                    ],
            },
			font_awesome: {
				 expand: true,
				 flatten: true,
				 src: ['bower_components/fontawesome/fonts/*'],
				 dest: 'httpdocs/wp-content/themes/<%= pkg.name %>/assets/fonts'
			},

            deploy_scripts: {
                 expand: true,
                 flatten: true,
                 src: ['node_modules/mbd-wp-deploy-scripts/scripts/*'],
                 dest: 'scripts'
            }
		},

		clean: {
			main: ['release/<%= pkg.name %>.<%= pkg.version %>']
		},

		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: 'release/<%= pkg.name %>.<%= pkg.version %>/wp-content.zip'
				},
				expand: true,
				cwd: 'release/<%= pkg.name %>.<%= pkg.version %>/wp-content',
				src: ['**/*'],
				dest: 'wp-content/'
			}		
		},

        // Shell
        shell: {
            exp: {
                command: [
                    'cd scripts',
                    'sh local-export.sh',
                    'cd ..'
                ].join('&&')
            },
            imp: {
                command: [
                    'cd scripts',
                    'sh local-import.sh',
                    'cd ..'
                ].join('&&')
            }       
        }

    });

    // register tasks

    grunt.registerTask('default', [
	 	'sass', 
		// 'modernizr',		
		'watch'
	]);
    grunt.registerTask('copyassets', [

    ]);

    // Build Task
	grunt.registerTask('build', [
		'bump',
		'version',
        'autoprefixer',
        'sass', 
        'modernizr',
		'copy:theme',
        'copy:plg1',
        'watch'
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
