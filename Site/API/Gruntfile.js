module.exports = function(grunt) {
    grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),
        jsbeautifier : {
            "default": {
                src : ["../js/*.js", "../css/*.css"]
            }
        },

        jshint: {
              src: ["Gruntfile.js", "../js/*.js", "!../js/googleCharts.js"]
        }
    });

    grunt.loadNpmTasks('grunt-jsbeautifier');
    grunt.loadNpmTasks('grunt-contrib-jshint');

    grunt.registerTask('default', ['jsbeautifier', 'jshint']);

};
