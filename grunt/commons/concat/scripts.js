module.exports = function(grunt) {

  var manifest = grunt.config.get('manifest'),
      files = new Array(),
      task = 'jscsrc';

  for(var index in manifest.files) { 
      var infos =  manifest.files[index];
      files[files.length] = index;
  }

  grunt.config('concat.scripts', {
    options: {
      separator: ';'
    },
    dest: '<%= deploy_dir %>/app.js',
    src: files,
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
};
