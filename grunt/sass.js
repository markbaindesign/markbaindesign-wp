const sass = require('sass');
module.exports = {
   dist: {
      options: {
         implementation: sass,
         style: 'expanded',
         sourceMap: true
      },
      files: {
         '<%= theme_path %>/<%= theme_name %>/style.css': 'sass/styles.scss',
         //'<%= theme_path %>/<%= theme_name %>/style-custom-login.css': 'sass/custom-login-styles.scss',
      }
   }
};