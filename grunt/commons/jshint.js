module.exports = function(grunt) {

  
  var manifest = grunt.config.get('manifest'),
      files = new Array(),
      task = 'jshint';

  for(var index in manifest.files) { 
      var infos =  manifest.files[index];
      if (infos[task] && infos[task] === true)
        files[files.length] = index;
  }


  var jshint_cache = '<%= deploy_dir %>/app.jshint.js';
  grunt.config('concat.jshint', {
    options: {
      separator: '',
      sourceMap:false, //cant get it to work
      process: function(src, filepath) {
        return '// Source: ' + filepath + '\n' + src;
      },
    },
    dest: jshint_cache,
    src: files
   });

  grunt.config('jshint', {
    default: {
      src: jshint_cache,
      options : require(grunt.config.get('absolute_root') + '/app.jshintrc.json'),
    }
  });

  grunt.registerTask('jshintfull', ['concat:jshint', 'jshint']);
  
  grunt.loadNpmTasks('grunt-contrib-jshint');
};
