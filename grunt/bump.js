module.exports = {
   options: {
      updateConfigs: ['<%= package.name %>'], // make sure to check updated package variables
      push: false,
      commitFiles: ['-a'], // Commit all files
      createTag: false, // Branch is tagged by git flow
      commitMessage: 'Bump the version to %VERSION%',
      prereleaseName: 'rc',
   }
};