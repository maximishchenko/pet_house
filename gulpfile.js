const { src, dest, series, watch } = require('gulp');

const srcFolder = './frontend/web/src';
const buildFolder = './frontend/web/build';

const paths = {
    srcScss: `${srcFolder}/scss/**/*.scss`,
    buildCssFolder: `${buildFolder}/css`,
    srcFullJs: `${srcFolder}/js/**/*.js`,
    srcMainJs: `${srcFolder}/js/main.js`,
    buildJsFolder: `${buildFolder}/js`,
};

const cleanCSS = require('gulp-clean-css');
const sass = require('sass');
const gulpSass = require('gulp-sass');
const gulpif = require('gulp-if');
const mainSass = gulpSass(sass);
const autoprefixer = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const webpackStream = require('webpack-stream');
const del = require('del');

let isProd = false; // dev by default

const clean = () => {
    return del([buildFolder])
}

const styles = () => {
    return src(paths.srcScss, { sourcemaps: !isProd })
        .pipe(plumber(
            notify.onError({
                title: "SCSS",
                message: "Error: <%= error.message %>"
            })
        ))
        .pipe(mainSass())
        .pipe(autoprefixer({
            cascade: false,
            grid: true,
            overrideBrowserslist: ["last 5 versions"]
        }))
        .pipe(gulpif(isProd, cleanCSS({
            level: 2
        })))
        .pipe(dest(paths.buildCssFolder, { sourcemaps: '.' }))
};

const scripts = () => {
    return src(paths.srcMainJs)
        .pipe(plumber(
            notify.onError({
                title: "JS",
                message: "Error: <%= error.message %>"
            })
        ))
        .pipe(webpackStream({
            mode: isProd ? 'production' : 'development',
            output: {
                filename: 'main.js',
            },
            module: {
                rules: [{
                    test: /\.m?js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                ['@babel/preset-env', {
                                    targets: "defaults"
                                }]
                            ]
                        }
                    }
                }]
            },
            devtool: !isProd ? 'source-map' : false
        }))
        .on('error', function (err) {
            console.error('WEBPACK ERROR', err);
            this.emit('end');
        })
        .pipe(dest(paths.buildJsFolder))
}



const watchFiles = () => {
    watch(paths.srcScss, styles);
    watch(paths.srcFullJs, scripts);
}

exports.clean = clean;

exports.default = series(clean, scripts, styles, watchFiles);
