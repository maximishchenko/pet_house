'use strict';
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const svgSprite = require('gulp-svg-sprite');
const webpack = require('webpack-stream');
const svgmin = require('gulp-svgmin');
const cheerio = require('gulp-cheerio');
const replace = require('gulp-replace');
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
// Sprite
gulp.task('sprite', function () {
    return gulp.src('./frontend/web/img/svg/*.svg')
    .pipe(
      svgmin({
        js2svg: {
          pretty: true,
        },
      })
    )
    .pipe(
      cheerio({
        run: function ($) {
          $('[fill]').removeAttr('fill');
          $('[stroke]').removeAttr('stroke');
          $('[style]').removeAttr('style');
        },
        parserOptions: {
          xmlMode: true
        },
      })
    )
    .pipe(replace('&gt;', '>'))
    .pipe(svgSprite({
      mode: {
        stack: {
          sprite: "../sprite.svg"
        }
      },
    }))
    .pipe(gulp.dest("./frontend/web/img/"));
});
// JS
gulp.task('scripts', function () {
  return gulp.src('./frontend/web/js/src/main.js')
    .pipe(webpack({
      output: {
        filename: 'main.js'
      }
    }))
    .pipe(gulp.dest('./frontend/web/js'))
});


// gulp.task('stl', ['sass', 'sprite']);
gulp.task('stl', gulp.parallel('sass', 'sprite'));
