# markbaindesign WordPress theme

## By Mark Bain Design

### Version 2.4.0

## 1. Setup

- [NPM]. Open project directory in terminal and run `npm install` to install all grunt plugins. See `package.json`for details. 
- Run `bower install` to download Bower components (and their dependencies) to `/bower_components`. See `bower.json`for details.
- Run `grunt copyassets`to copy assets from `/bower_components`to the appropriate theme directory. See `Gruntfile.js`for details.

## 2. Development

- Run `grunt` to compile your Sass and run the watch task. See `Gruntfile.js`for details.
- Run `grunt build` to output build files to `/release`. See `Gruntfile.js`for details.

## 3. Deployment

### Scripts

This project comes with a set of shell scripts to aid with deployment, [markbaindesign/mbd-wp-deploy-scripts]. These scripts can either be run manually, or via grunt tasks. For configuration instructions, see [mbd-wp-deploy-scripts/scripts/README.md]. 

- Run `grunt import`to run the import script and install the archive currently in `/import`to your local environment.
- Run `grunt export`to run the export script which creates an archive of your local install in `/export`, ready to upload to your remote environment (staging/production).

### Replacing URLs

Once you have run the import script, you need to change all the URLs in the database. I suggest using [interconnectit/Search-Replace-DB]. 

[NPM]: https://www.npmjs.com/
[interconnectit/Search-Replace-DB]: https://github.com/interconnectit/Search-Replace-DB
[markbaindesign/mbd-wp-deploy-scripts]: https://github.com/markbaindesign/mbd-wp-deploy-scripts
[mbd-wp-deploy-scripts/scripts/README.md]: https://github.com/markbaindesign/mbd-wp-deploy-scripts/blob/master/scripts/README.md