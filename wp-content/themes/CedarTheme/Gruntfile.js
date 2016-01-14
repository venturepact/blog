
module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		watch: {
			options: {
				livereload: {
					port: 35729,
				}
			},
			js: {
				files: ['src/js/*'],
				tasks: ['uglify']
			},
			sass: {
				files: ['src/sass/*'],
				tasks: ['sass', 'cssmin']
			}
		},

		sass: {
			dist: {
				files: [{
					src: 'src/sass/screen.scss',
					dest: 'src/sass/build/screen.css',
					ext: '.css'
				}]
			},
			alt: {
				files: [
				{
					src: 'src/sass/screen.scss',
					dest: 'assets/css/theme.css',
					ext: '.css'
				}]
			}
		},

		cssmin: {
			combine: {
				files: {
					'assets/css/theme.min.css': ['src/sass/build/screen.css']
				}
			}
		},

		uglify: {
			js: {
				files: {
					'assets/js/theme.min.js': ['src/js/plugins/*.js', 'src/js/*.js']
				}
			}
		},

		connect: {
			server: {
				options: {
					hostname: 'localhost',
					port: 8080,
					base: '',
					livereload: true
				}
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-connect');

	grunt.registerTask('default', ['sass', 'cssmin', 'uglify', 'watch']);
	grunt.registerTask('dev', ['sass', 'cssmin', 'uglify', 'connect', 'watch']);
	grunt.registerTask('build', ['sass', 'cssmin', 'uglify']);

};
