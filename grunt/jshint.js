module.exports = {
   options: {
      jshintrc: '.jshintrc',
      "force": true
   },
   all: [
      'Gruntfile.js',
      '<%= theme_path %>/<%= theme_name %>/assets/js/src/custom/**/*.js',
      '<%= plugin_path %>/<%= plugin_name %>/assets/js/src/custom/**/*.js',
   ]
};