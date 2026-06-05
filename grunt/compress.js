module.exports = {
   plugin: {
      options: {
         mode: 'zip',
         archive: 'release/plugins/plugins.zip'
      },
      expand: true,
      cwd: 'release/plugins/',
      src: ['**/*']
   },

   theme: {
      options: {
         mode: 'zip',
         archive: 'release/theme/theme.zip'
      },
      expand: true,
      cwd: 'release/theme',
      src: ['**/*']
   }
};
