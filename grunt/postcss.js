module.exports = {
   options: {
      map: false,
      processors: [
         require('autoprefixer')(),
         require('cssnano')(),
         // Uncomment PurgeCSS if you want to strip unused selectors
         // require('@fullhuman/postcss-purgecss')({
         //   content: ['**/*.php', '**/*.js'],
         //   safelist: ['.keep-this', /^js-/]
         // })
      ]
   },
   dist: {
   src: '<%= theme_path %>/<%= theme_name %>/assets/css/build/style.css',
   dest: '<%= theme_path %>/<%= theme_name %>/assets/css/build/style.min.css'
   }
};