module.exports = function(grunt) {
  var path = require("path");
      dev_mode   = (grunt.cli.tasks[0] != 'distribute'),
      deploy_dir = dev_mode ? 'RLM' : 'server';

  grunt.initConfig({
    pkg: require('./package.json'),
    manifest : require('./manifest.json'),
    deploy_dir : grunt.option('deploy_dir') || deploy_dir,
    absolute_root : path.resolve(__dirname),
    'ftp-deploy': {
      build: {
        auth: {
          host: 'server_ip',
          port: 21,
          authKey: 'key1'
        },
        src: 'server/',
        dest: '/path_to_install/',
        exclusions: []
      }
    }
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

  grunt.registerTask('distribute', [
    'statics',
    'cssmin',
    'concat',
    'forge-config',
    'ftp-deploy'
  ]);
  grunt.loadNpmTasks('grunt-ftp-deploy');
};
