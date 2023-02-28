'use strict';
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));;
const concat = require('gulp-concat');
sass.compiler = require('node-sass');

// SCSS
gulp.task('sass', function () {
    const main_css = gulp.src('./frontend/web/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./frontend/web/scss/'));
    const vendor_css = gulp.src('./frontend/web/scss/vendor.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./frontend/web/scss/'));
    return main_css, vendor_css;
});
// JS
const webpack = require('webpack-stream')

gulp.task('scripts', function () {
  return gulp.src('./frontend/web/js/src/main.js')
    .pipe(webpack({
      output: {
        filename: 'main.js'
      }
    }))
    .pipe(gulp.dest('./frontend/web/js'))
})
