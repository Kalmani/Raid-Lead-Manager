// Web Server for dev
module.exports = function(grunt) {
  grunt.config('http-server', {
      //Create an http-server for your computer
      'dev': {
        root: grunt.config.get('deploy_dir'),
        port: 8001,

        host: "127.0.0.1",
        //cache: <sec>,
        showDir : true,
        autoIndex: true,
        defaultExt: "html",

        // run in parallel with other tasks
        runInBackground: false,
      },

      //Create an http-server for all your network
      'public': {
        root: grunt.config.get('deploy_dir'),
        port: 8000,

        host: "0.0.0.0",
        //cache: <sec>,
        showDir : true,
        autoIndex: true,
        defaultExt: "html",

        // run in parallel with other tasks
        runInBackground: false,
      }
    });

  grunt.loadNpmTasks('grunt-http-server');
};
