module.exports = function(grunt) {
    grunt.initConfig({
        concat: {
            plugins: {
                src: ['assets/oembed/oembed.js', 'assets/lib/jStorage/jstorage.min.js', 'assets/lib/lazysizes/lazysizes.min.js', 'assets/lib/lazysizes/optimumx/ls.optimumx.min.js', 'assets/js/vendor/jquery-ui/jquery-ui.min.js','assets/lib/jquery.pep/src/jquery.pep.js', 'assets/lib/js-signals/dist/signals.min.js', 'assets/lib/hasher/dist/js/hasher.min.js', 'assets/lib/jquery.scrollTo/jquery.scrollTo.js', 'assets/lib/jquery-form/jquery.form.js', 'assets/lib/hypher/hyphen.js', 'assets/lib/crawler/crawler.js','assets/lib/gsap/src/minified/TweenMax.min.js', 'assets/lib/scrollmagic/scrollmagic/minified/ScrollMagic.min.js', 'assets/lib/scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js'],
                dest: 'assets/js/plugins.concat.js'
            },
            js: {
                src: ['assets/js/app.js'],
                dest: 'assets/js/app.concat.js'
            },
        },
        uglify: {
            plugins: {
                src: 'assets/js/plugins.concat.js',
                dest: 'assets/js/build/plugins.js'
            },
            build: {
                src: 'assets/js/app.concat.js',
                dest: 'assets/js/build/app.min.js',
                options: {
                    sourceMap: true
                }
            }
        },
        stylus: {
            compile: {
                options: {
                    use: [
                        require('rupture')
                    ],
                },
                files: {
                    'assets/css/app.min.css': 'assets/css/app.styl'
                }
            }
        },
        watch: {
            js: {
                files: ['assets/lib/**/*.js', 'assets/js/**/!(app.min|app.concat).js'],
                tasks: ['javascript'],
                options: {
                    livereload: true,
                }
            },
            css: {
                files: ['assets/css/**/*.styl'],
                tasks: ['stylesheets'],
                options: {
                    livereload: true,
                }
            }
        },
        php: {
            test: {
                options: {
                    keepalive: true,
                    port: 5000,
                    open: true
                }
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-stylus');
    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('javascript', ['concat', 'uglify']);
    grunt.registerTask('stylesheets', ['stylus']);
    grunt.registerTask('test', ['php', 'mocha']);
    grunt.registerTask('default', ['javascript', 'stylesheets', 'watch', 'php']);
};