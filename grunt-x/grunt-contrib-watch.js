module.exports = {
    watch: {
        sass: {
            files: ['sass/**/*.{scss,sass}'],
            tasks: [
			 	'sass', 
				'autoprefixer'
			]
        },

        js: {
            files: '<%= jshint.all %>',
            tasks: ['jshint']
        },

        livereload: {
            options: { livereload: true },
            files: [ 
			 	'httpdocs/html/cms/expressionengine/templates/default_site/**/*.html', 
				'Gruntfile.js',
				'httpdocs/html/css/style-mbd.css', 
				'httpdocs/html/js/**/*.js', 
				'httpdocs/html/images/**/*.{png,jpg,jpeg,gif,webp,svg}',
            ]
        }
    }
};