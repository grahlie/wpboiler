/* eslint-disable no-undef */
/* eslint-disable-next-line no-undef */
module.exports = function( grunt ) {
  require( 'load-grunt-tasks' )( grunt );

  grunt.initConfig( {
    pkg: grunt.file.readJSON( 'package.json' ),
    config: grunt.file.readJSON( 'config.json' ),
    name: '<%= config.name %>',
    deploy: process.cwd() + '/<%= config.deploy %>/wp/wp-content/themes/<%= name %>',

    clean: {
      build: [ '<%= deploy %>/*', '<%= config.deploy %>/composer.json', '<%= config.deploy %>/license.txt', '<%= config.deploy %>/readme.html' ]
    },

    /*
     * SCSS
     *
     * Check rules
     * Build css from scss
     * autoprefix (2 latest versions)
     */
    stylelint: {
      options: {
        configFile: './.stylelintrc.js'
      },
      src: [ './theme/sass/**/*.{css,scss}' ]
    },
    sass: {
      production: {
        options: {
          style: 'compressed'
        },
        files: {
          '<%= deploy %>/style.css': 'theme/sass/style.scss'
        }
      },
      dev: {
        option: {
          style: 'expanded'
        },
        files: {
          '<%= deploy %>/style.css': 'theme/sass/style.scss'
        }
      }
    },
    autoprefixer: {
      dist: {
        browsers: [ 'last 2 versions', 'ie 8', 'ie 9' ],
        files: {
          '<%= deploy %>/style.css': '<%= deploy %>/style.css'
        }
      }
    },

    /*
     * Javascript
     *
     * Check rules
     * Minify/Uglify
     */
    eslint: {
      options: {
        configFile: './.eslintrc.js'
      },
      target: [ './theme/js/development/**/*.js' ]
    },

    uglify: {
      production: {
        files: {
          '<%= deploy %>/js/scripts.min.js': [ 'theme/js/development/**/*.js' ]
        }
      }
    },

    /*
     * PHP
     *
     * Check rules
     * Copy to deploy
     */
    phpcs: {
      application: {
        src: 'theme/**/*.php'
      },
      options: {
        bin: 'vendor/bin/phpcs',
        standard: 'WordPress'
      }
    },
    copy: {
      php: {
        files: [
          {
            expand: true,
            cwd: 'theme/',
            src: [ '**/*.php', 'framework/**/*' ],
            dest: '<%= deploy %>'
          }
        ]
      }
    },

    watch: {
      options: {
        livereload: true
      },
      php: {
        files: [ 'theme/**/*.php' ],
        tasks: [ 'phpDev' ]
      },
      css: {
        files: [ 'theme/sass/**/*.scss' ],
        tasks: [ 'stylesheet' ]
      },
      js: {
        files: [ 'theme/js/development/**/*.js' ],
        tasks: [ 'javascript' ]
      }
    }
  } );

  // Grunt language collection
  grunt.registerTask( 'phpDev', [ 'copy:php' ] );
  grunt.registerTask( 'phpProduction', [ 'phpcs', 'copy:php' ] );
  grunt.registerTask( 'javascript', [ 'eslint', 'uglify' ] );
  grunt.registerTask( 'stylesheet', [ 'stylelint', 'sass', 'autoprefixer' ] );

  // Grunt triggers
  grunt.registerTask( 'dev', [ 'phpDev', 'javascript', 'stylesheet' ] );
  grunt.registerTask( 'production', [ 'clean', 'phpProduction', 'javscript', 'stylesheet' ] );
};
