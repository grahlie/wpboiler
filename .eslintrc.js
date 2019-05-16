'use strict';

/* globals module */
module.exports = {
  plugins: [],
  env: {
    node: true,
    es6: true,
    amd: true,
    browser: true,
    jquery: true
  },

  /**
   * Default globals.
   *
   * These will get ignored automatically.
   *
   * @since  1.1
   */
  globals: {
    wp: true
  },

  /**
   * Make sure you have eslint-config-wordpress installed.
   *
   * Install using:
   *
   *     npm install -g eslint-config-wordpress
   *
   * @@since 1.1
   */
  extends: 'wordpress',

  /**
   * WDS & WordPress Coding Standards for JavaScript.
   *
   * These are the official WDS and WordPress coding standards
   * for JavaScript.
   *
   * The @standard tag tells you which one's are straight from
   * WordPress Core, and which one's are WDS's own.
   *
   * @since  1.1
   * @see    https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/
   */
  rules: {
    /**
     * Enforce one true brace style.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#blocks-and-curly-braces
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'brace-style': 'error',

    /**
     * Require camel case names.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#naming-conventions
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    camelcase: [
      'error',
      {
        properties: 'always'
      }
    ],

    /**
     * Disallow or enforce trailing commas.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#objects
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'comma-dangle': ['error', 'never'],

    /**
     * Enforce spacing before and after comma.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#objects
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'comma-spacing': 'error',

    /**
     * Enforce one true comma style.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'comma-style': ['error', 'last'],

    /**
     * Encourages use of dot notation whenever possible.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#objects
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'dot-notation': [
      'error',
      {
        allowKeywords: true,
        allowPattern: '^[a-z]+(_[a-z]+)+$'
      }
    ],

    /**
     * Enforce newline at the end of file, with no multiple empty lines.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'eol-last': 'error',

    /**
     * Require or disallow spacing between function identifiers and their invocations.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'func-call-spacing': 'off',

    /**
     * Enforces spacing between keys and values in object literal properties.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'key-spacing': [
      'error',
      {
        beforeColon: false,
        afterColon: true
      }
    ],

    /**
     * Enforce spacing before and after keywords.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'keyword-spacing': 'error',

    /**
     * Disallow mixed "LF" and "CRLF" as linebreaks.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'linebreak-style': ['error', 'unix'],

    /**
     * Enforces empty lines around comments.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'lines-around-comment': [
      'error',
      {
        beforeLineComment: true
      }
    ],

    /**
     * Disallow mixed spaces and tabs for indentation.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'no-mixed-spaces-and-tabs': 'error',

    /**
     * Disallow use of multiline strings.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'no-multi-str': 'error',

    /**
     * Disallow multiple empty lines.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'no-multiple-empty-lines': 'error',

    /**
     * Disallow use of the with statement.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'no-with': 'error',

    /**
     * Enforce operators to be placed before or after line breaks.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'operator-linebreak': ['error', 'after'],

    /**
     * Require or disallow use of semicolons instead of ASI.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#semicolons
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    semi: ['error', 'always'],

    /**
     * Require or disallow space before blocks.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'space-before-blocks': ['error', 'always'],

    /**
     * Require or disallow space before function opening parenthesis.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since 1.0
     */
    'space-before-function-paren': ['error', 'never'],

    /**
     * Require or disallow space before blocks.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since  1.1
     */
    'space-in-parens': ['error', 'always'],

    /**
     * Require spaces around operators.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#spacing
     *
     * @author Aubrey Portwood
     * @since 1.1
     */
    'space-infix-ops': 'error',

    /**
     * Require or disallow spaces before/after unary operators (words on by default, nonwords),
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since  1.1
     */
    'space-unary-ops': [
      'error',
      {
        overrides: { '!': true }
      }
    ],

    /**
     * Require or disallow Yoda conditions.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#yoda-conditions
     *
     * @since  1.0
     * @author Aubrey Portwood
     */
    yoda: ['error', 'always'],

    /**
     * Always show an error when a variable is created that is never used.
     *
     * @standard WP
     *
     * @author Aubrey Portwood
     * @since  1.1
     */
    'no-unused-vars': 'error',

    /**
     * Require == and !== where necessary.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#equality
     *
     * @author Aubrey Portwood
     * @since  1.1
     */
    eqeqeq: 'error',

    /**
     * Require that braces be used.
     *
     * @standard WP
     *
     * E.g.
     *
     *     if ( foo ) return;
     *
     * would be bad, but
     *
     *     if ( foo ) {
     *         return;
     *     }
     *
     * would pass.
     *
     * @author Aubrey Portwood
     * @since  1.1
     */
    curly: 'error',

    /**
     * Disallow null comparisons without type-checking operators.
     *
     * @standard WP
     *
     * @since  1.1
     * @author Aubrey Portwood
     */
    'no-eq-null': 'error',

    /**
     * Force undefined variables to be in globals.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#globals
     *
     * E.g.
     *
     *     function a() {
     *
     *         // Below jQuery is undefined as it's included as a library.
     *         return jQuery( '#id' );
     *     }
     *
     * To fix:
     *
     *     // globals jQuery;
     *
     *     function a() {
     *
     *         // Below jQuery is undefined as it's included as a library.
     *         return jQuery( '#id' );
     *     }
     *
     * @author Aubrey Portwood
     * @since 1.1
     */
    'no-undef': 'error',

    /**
     * camelCaseAllTheThings.
     *
     * @standard WP
     * @see      https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/#naming-conventions
     *
     * @author Aubrey Portwood
     * @since  1.1
     */
    camelcase: 'error'
  }
};
