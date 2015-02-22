var fs       = require('fs');
var glob     = require("glob");
var exec     = require('child_process').exec;


module.exports = function(grunt) {

  grunt.registerTask('forge-config', '', function(){
    var done = grunt.task.current.async();

    var dest = grunt.config('deploy_dir');
    var files = glob.sync('config/*.json');
    files.sort();
    if(grunt.dev_mode === false)
      files.pop();

    var json = {};

    for (var i = 0; i < files.length; i++) {
      json = merge_options(json, JSON.parse(fs.readFileSync(files[i])));
    }
    
    var writeversion = function(version) {
        json.version = version;
        grunt.log.oklns("Configuration forge for version '%s' ", json.version);
        grunt.file.write(dest + "/config.json", JSON.stringify(json));
        done();
    };

    if(grunt.option('package_version')) {
      writeversion(grunt.option('package_version'));
    } else {
      exec("git rev-parse HEAD", function(err, stdout){
        writeversion(stdout.substr(0,6));
      });
    }
    if (!grunt.dev_mode) {
      var ftp_datas = JSON.parse(fs.readFileSync('ftp/ftpaccess.json'));
      grunt.config('ftp-deploy', {
        build: {
          auth: {
            host: ftp_datas.host,
            port: ftp_datas.port,
            authKey: ftp_datas.authKey
          },
          src: ftp_datas.src,
          dest: ftp_datas.dest,
          exclusions: []
        }
      });
    }

  });

};

function merge_options(obj1,obj2){
    var obj3 = {};
    for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
    for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
    return obj3;
}
