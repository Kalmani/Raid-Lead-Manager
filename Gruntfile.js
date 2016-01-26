module.exports = function(grunt) {
  var path = require("path");
      dev_mode   = (grunt.cli.tasks[0] != 'distribute'),
      deploy_dir = dev_mode ? 'RLM' : 'server';
  grunt.dev_mode = dev_mode;
  grunt.initConfig({
    pkg: require('./package.json'),
    manifest : require('./manifest.json'),
    deploy_dir : grunt.option('deploy_dir') || deploy_dir,
    absolute_root : path.resolve(__dirname)
  });

  grunt.file.expand({filter:'isDirectory'}, 'grunt/**').forEach(grunt.loadTasks);
  grunt.log.writeln("Working in '%s'", grunt.config('deploy_dir'));

 // default task is to init dev env
  grunt.registerTask('default', [
    'cssmin',
    'pack',
    'forge-config',
  ]);

  grunt.registerTask('distribute', [
    'statics',
    'cssmin',
    'pack',
    'forge-config',
    'ftp-deploy'
  ]);
  grunt.loadNpmTasks('grunt-ftp-deploy');
};
