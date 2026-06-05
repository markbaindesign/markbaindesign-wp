'use strict';
module.exports = function (grunt) {
   var path = require('path');
   var mozjpeg = require('imagemin-mozjpeg');

   require('load-grunt-tasks')(grunt);
   require('load-grunt-config')(grunt, {
      data: {
         rdm: path.join(process.cwd(), 'README.md'),
         theme_name: 'bain-design-theme',
         theme_path: 'public_html/wp-content/themes',
         plugin_name: 'markbaindesign-custom-functions',
         plugin_path: 'public_html/wp-content/plugins',
         mu_plugin_path: 'wp-content/mu-plugins',
         stylesheet_name: 'style',
         url: 'https://bain.design.ddev.site'
      },
   });
};
