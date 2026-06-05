module.exports = {
   css: {
      options: {
         prefix: 'Version\\:\\s'
      },
      src: [
         'sass/styles.scss',

         // Edit the version directly in the generated CSS file.
         // Avoids having to run the Sass task just for this. 
         '<%= theme_path %>/<%= theme_name %>/style.css',
      ],
   },
   theme: {
      options: {
         prefix: 'Version\\:\\s'
      },
      src: [
         '<%= theme_path %>/<%= theme_name %>/theme-version.php',
      ],
   },
   readme: {
      options: {
         prefix: 'Version\ \s*'
      },
      src: ['<%= rdm %>'],
   },
   plugin: {
      options: {
         prefix: 'Version\\:\\s'
      },
      src: ['<%= plugin_path %>/<%= plugin_name %>/<%= plugin_name %>.php'],
   },
};