module.exports = function(grunt) {

  var manifest = grunt.config.get('manifest'),
      files = new Array(),
      task = 'jscsrc';

  for(var index in manifest.files) { 
      var infos =  manifest.files[index];
      if (infos[task] && infos[task] === true)
        files[files.length] = index;
  }


  grunt.config('jscs', {
    default: {
        options : require(grunt.config.get('absolute_root') + '/app.jscsrc.json'),
        files: {src : files}
    }
  });

  grunt.loadNpmTasks('grunt-jscs');
};
