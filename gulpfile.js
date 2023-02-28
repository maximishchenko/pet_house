'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));;
var concat = require('gulp-concat');
sass.compiler = require('node-sass');

// SCSS
gulp.task('sass', function () {
    var main_css = gulp.src('./frontend/web/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./frontend/web/scss/'));
    var vendor_css = gulp.src('./frontend/web/scss/vendor.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./frontend/web/scss/'));
    return main_css, vendor_css;
});
// JS
var webpack = require('webpack-stream')

gulp.task('scripts', function () {
  return gulp.src('./frontend/web/js/src/main.js')
    .pipe(webpack({
      output: {
        filename: 'main.js'
      }
    }))
    .pipe(gulp.dest('./frontend/web/js'))
})