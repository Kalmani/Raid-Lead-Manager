module.exports = function(grunt) {
  grunt.config('cssmin', {
    default: {
      options : {
        noAdvanced : true,
      },
      files: {
       '<%= deploy_dir %>/theme/main.css' : ['RLM/theme/_main.css'],
      }
    }
  } );

  grunt.loadNpmTasks('grunt-contrib-cssmin');
};
