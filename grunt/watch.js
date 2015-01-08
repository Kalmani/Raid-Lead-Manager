module.exports = function(grunt) {
  grunt.config('watch.css', {
      files: ['RLM/theme/css/*.css'],
      tasks: ['cssmin']
  });

  grunt.config('watch.scripts', {
     tasks: [
        'concat:scripts'
      ]
  });


  grunt.config('watch.templates', {
      files: ['RLM/theme/tpl/**/*.xml', 'RLM/theme/tpl/**/**/*.xml'],
      tasks: [
        'concat:templates'
      ]
  });
  
  grunt.loadNpmTasks('grunt-contrib-watch');
};

