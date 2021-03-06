require('mootools');
module.exports = function(grunt) {

  var manifest = grunt.config.get('manifest'),
      files = Object.keys( Object.filter(manifest.files, function(v, k) {
         return k;
      }));

  grunt.config('concat.scripts', {
    options: {
      separator: ';'
    },
    dest: '<%= deploy_dir %>/app.js',
    src: files,
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
};
