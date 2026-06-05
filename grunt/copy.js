module.exports = {

   theme: {
      files: [
         {
            expand: true, // includes files within path and its sub-directories
            cwd: '<%= theme_path %>/<%= theme_name %>/', // Target dir
            src: [
               '**',
               '!style.css.map',
               '!**/*.*.orig' // Don't copy .orig copies
            ],
            dest: 'release/<%= package.name %>.<%= package.version %>/<%= theme_name %>.<%= package.version %>'
         },
      ],
   },

   plugin: {
      files: [
         // includes files within path and its sub-directories
         {
            expand: true,
            cwd: '<%= plugin_path %>/<%= plugin_name %>', // Target dir
            src: [
               '**',
               '!**/*.*.orig' // Don't copy .orig copies
            ],
            dest: 'release/<%= package.name %>.<%= package.version %>/<%= plugin_name %>.<%= package.version %>'
         },
      ],
   },

   mu_plugins: {
      files: [
         // includes files within path and its sub-directories
         {
            expand: true,
            cwd: 'httpdocs/wp-content/mu-plugins/',
            src: [
               '**',
            ],
            dest: 'release/<%= package.name %>.<%= package.version %>/<%= mu_plugin_path %>'
         },
      ],
   },

   deploy_scripts: {
      expand: true,
      flatten: true,
      src: ['node_modules/mbd-wp-deploy-scripts/scripts/*'],
      dest: 'scripts'
   }
};