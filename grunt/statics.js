var fs = require('fs');

module.exports = function(grunt) {
  var dest = grunt.config('deploy_dir');
  var manifest = grunt.config.get('manifest')

  grunt.config('copy.statics', {
    expand: true, 
    cwd: 'RLM',
    src: manifest.statics,
    dest: dest,
  });

  grunt.registerTask('clean-statics', '', function(){
    grunt.file.delete(dest);
    grunt.file.mkdir(dest);
  });

  grunt.registerTask('check-prod', '', function(){
    if (!grunt.dev_mode) {
      var path = "server/actions/";
      grunt.file.copy(path + "config.prod.php", path + "config.php");
      grunt.file.delete(path + "config.prod.php");
    }
  });

  grunt.registerTask('statics', ['clean-statics', 'copy', 'check-prod']);

  grunt.loadNpmTasks('grunt-contrib-copy');
};
