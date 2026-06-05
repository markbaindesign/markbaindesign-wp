module.exports = {
   dev: {
      bsFiles: {
         src: [
            // Project root
            'Gruntfile.js', // This is the only file we care about

            // Theme files
            '<%= theme_path %>/<%= theme_name %>/**/*', // All

            // Plugin files
            '<%= plugin_path %>/<%= plugin_path %>/**/*', // All
         ]
      },
      options: {
         watchTask: true,
         // https: {
         //     key: "path-to-custom.key",
         //     cert: "path-to-custom.crt"
         // },
         proxy: 'https://bain.design.ddev.site'
      }
   }
};