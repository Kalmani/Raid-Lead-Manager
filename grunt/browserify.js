var fs = require('fs');
var cp = require('child_process');

module.exports = function(grunt) {

  grunt.config('browserify', {
    options : {
      browserifyOptions : {
        transform : false
      }
    },

    pack : {
      files: {
        'RLM/application/_bootstrap.js': ['RLM/application/init.js'],
      }
    }
  });


  grunt.registerTask('pack', ['browserify', 'concat']);

  grunt.loadNpmTasks('grunt-browserify');
};