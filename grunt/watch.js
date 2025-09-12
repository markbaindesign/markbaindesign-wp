module.exports = {
   sass: {
      files: ['sass/**/*.{scss,sass}'],
      tasks: [
         // 'sass',
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
      files: ['<%= theme_path %>/<%= theme_name %>/assets/images/src/*.{png,jpg,jpeg,gif,webp,svg}'],
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
         '<%= theme_path %>/<%= theme_name %>/**/*.php',
         '<%= theme_path %>/<%= theme_name %>/lib/**/*.php',
         '<%= theme_path %>/<%= theme_name %>/style.css',
         '<%= theme_path %>/<%= theme_name %>/assets/js/src/**/*.js',
         '<%= theme_path %>/<%= theme_name %>/assets/images/dist/**/*.{png,jpg,jpeg,gif,webp,svg}',

         // Plugin files
         '<%= plugin_path %>/<%= plugin_name %>/**/*',

      ]
   }
};