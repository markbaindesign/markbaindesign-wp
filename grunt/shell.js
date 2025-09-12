module.exports = {
   exp: {
      command: [
         'cd bin/scripts',
         './local-export.sh',
         'cd ../..'
      ].join('&&')
   },
   imp: {
      command: [
         'cd bin/scripts',
         './local-import.sh',
         'cd ../..'
      ].join('&&')
   },
   import_production_db: {
      command: 'scripts/',
   },
   project_stats: {
      command: 'du -sh httpdocs',
   },
   build_stats: {
      command: 'du -sh release',
   }
};