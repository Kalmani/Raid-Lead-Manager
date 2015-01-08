module.exports = function(grunt) {
  grunt.config('concat.admin', {
    options: {
      separator: ';'
    },
    dest: '<%= deploy_dir %>/admin/admin.js',
    src: [

      //Cordova
      'vendor/cordova/cordova-3.2.0.js',
      'vendor/cordova/inappbrowserwebkit.js',

      //Vendor
      'vendor/mootools-1.4.1.js',
      'vendor/mootools-more-1.4.0.1.js',
      'vendor/String.sprintf.js',
      'vendor/mustache.js',
      'vendor/soap/String.js',
      'vendor/soap/JSON.js',
      'vendor/soap/SOAP.js',
      'vendor/socket.io-1.0.2.js',
      'vendor/class.js',
      'vendor/hermes/ws/client.js',

      'vendor/jquery/jquery.min.js',
      'vendor/bootstrap/js/bootstrap.js',
      'vendor/chosen/chosen.jquery.min.js',
      'www/admin/app/knobHandler.js',

      // IVS Pages
      'www/admin/app/Screen.js',
      'www/admin/app/main.js',
      'www/admin/pages/WelcomeScreenBackOffice/WelcomeScreenBackOffice.js',
      'www/admin/pages/DesignBackOffice/DesignBackOffice.js',
      'www/admin/pages/acsBackOffice/acsBackOffice.js',
      'www/admin/pages/ExportBackOffice/ExportBackOffice.js',
      'www/admin/pages/statBackOffice/statBackOffice.js',
      'www/admin/pages/QuestionnaireBackOffice/QuestionnaireBackOffice.js',
      'www/admin/pages/EquipementBackOffice/EquipementBackOffice.js',
      'www/admin/pages/EquipementBackOffice/DropCube.js',
      'www/admin/pages/mySight/mySight.js',
      'www/admin/pages/EyeCube/EyeCube.js',
      'www/admin/pages/DropCube/DropCube.js',
      
      //Modernizr JS Script
      'vendor/modernizr/modernizr.js',
      //FastClick for mobiles
      'vendor/fastclick/fastclick.js',

      'vendor/colpick-jQuery-Color-Picker-master/js/colpick.js',

      //Animo
      'vendor/animo/animo.min.js',

      //Sparklines
      'vendor/sparklines/jquery.sparkline.min.js',

      //Slimscroll
      'vendor/slimscroll/jquery.slimscroll.min.js',

      //Gmap
      'vendor/jQuery-Knob-master/js/jquery.knob.js',
      'vendor/jqueryui/js/jquery-ui-1.10.4.custom.min.js',
      'vendor/touch-punch/jquery.ui.touch-punch.min.js',


      // Sketch
      'www/admin/app/sketch.min.js',
      'www/admin/app/sketchScreen.js',

      //App Main
      'vendor/moment/min/moment-with-langs.min.js',
      'www/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js',
      
      'www/vendor/app/js/app.js',

      'vendor/parallax-master/deploy/jquery.parallax.js',

      'vendor/datatable/media/js/jquery.dataTables.min.js',
      'vendor/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrap.js',
      'vendor/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrapPagination.js',
      'vendor/datatable/extensions/ColVis/js/dataTables.colVis.min.js',
      //Markdown Area Codemirror and dependencies
      'vendor/codemirror/lib/codemirror.js',
      'vendor/codemirror/addon/mode/overlay.js',
      'vendor/codemirror/mode/markdown/markdown.js',
      'vendor/codemirror/mode/xml/xml.js',
      'vendor/codemirror/mode/gfm/gfm.js',
      'vendor/marked/marked.js',


      //Tags input
      'vendor/tagsinput/bootstrap-tagsinput.min.js',
      //Input Mask
      'vendor/inputmask/jquery.inputmask.bundle.min.js',


      //START Page Custom Script

      // Flot Charts
      'vendor/flot/jquery.flot.min.js',
      'vendor/flot/jquery.flot.tooltip.min.js',
      'vendor/flot/jquery.flot.resize.min.js',
      'vendor/flot/jquery.flot.time.min.js',
      'vendor/flot/jquery.flot.categories.min.js',


      // IVS App*/
      'www/admin/app/ScreenManager.js',
      'www/app/ivs/session.js',

      //plugins
        'www/vendor/slider/js/bootstrap-slider.js',
        'www/vendor/filestyle/bootstrap-filestyle.min.js',
        'www/vendor/sketch.min.js',

      //app.skin utilities
      'www/app/skin/utils.js',
      //'www/app/init.js',

      'www/admin/app/init.js',
    ],
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
};
