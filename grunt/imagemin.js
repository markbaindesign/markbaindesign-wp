module.exports = {
   dist: {
      options: {
         optimizationLevel: 7,
         progressive: true,
         interlaced: true,
         // use: [mozjpeg()],
      },
      files: [{
         expand: true,
         cwd: '<%= theme_path %>/<%= theme_name %>/assets/images/src',
         src: ['**/*.{png,jpg,jpeg,gif}'],
         dest: '<%= theme_path %>/<%= theme_name %>/assets/images/dist'
      }]
   }
};