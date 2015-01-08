module.exports = function(grunt) {
  var path = require("path");
  var deploy_dir = 'RLM';

  grunt.initConfig({
    pkg: require('./package.json'),
    manifest : require('./manifest.json'),
    deploy_dir : grunt.option('deploy_dir') || deploy_dir,
    absolute_root : path.resolve(__dirname)
  });

  grunt.dev_mode = (grunt.config.get('manifest').dev_mode) ? true : false;

  grunt.file.expand({filter:'isDirectory'}, 'grunt/**').forEach(grunt.loadTasks);
  grunt.log.writeln("Working in '%s'", grunt.config('deploy_dir'));

 // default task is to init dev env
  grunt.registerTask('default', [
    'cssmin',
    'concat',
    'forge-config',
  ]);
};
