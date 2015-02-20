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

  grunt.registerTask('statics', ['clean-statics', 'copy']);

  grunt.loadNpmTasks('grunt-contrib-copy');
};
