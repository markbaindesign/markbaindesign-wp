module.exports = {
   dir_release: ['release/**/*'], // Clean out the release dir
   build: ['<%= theme_path %>/<%= theme_name %>/assets/css/build/**/*'], // Clean out the release dir
   copy_theme: ['release/<%= package.name %>.<%= package.version %>/<%= theme_name %>.<%= package.version %>'],
   copy_plugin: ['release/plugins/**/*'],

   // Delete legacy stylesheets
   version: [
   '<%= theme_path %>/<%= theme_name %>/<%= stylesheet_name %>.<%= package.version %>.css',
   '<%= theme_path %>/<%= theme_name %>/<%= stylesheet_name %>.<%= package.version %>.min.css'],

};