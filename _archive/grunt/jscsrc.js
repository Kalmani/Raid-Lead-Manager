require('mootools');
module.exports = function(grunt) {

  var manifest = grunt.config.get('manifest'),
      files = Object.keys( Object.filter(manifest.files, function(v, k) {
         return v.jshint === undefined ? manifest.behavior.jshint : v.jshint;
      }));


  grunt.config('jscs', {
    default: {
        options : require(grunt.config.get('absolute_root') + '/app.jscsrc.json'),
        files: {src : files}
    }
  });

  grunt.loadNpmTasks('grunt-jscs');
};
