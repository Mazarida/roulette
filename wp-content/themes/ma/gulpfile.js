var gulp = require('gulp');
var sass = require('gulp-sass');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
var pxtoviewport = require('postcss-px-to-viewport');
var inject = require('gulp-inject-string');
var rename = require('gulp-rename');

gulp.task('d1', function () {
    return gulp.src('public_html/assets/style_dev_dsk.css')
        .pipe(sourcemaps.init())
        .pipe(postcss([ autoprefixer() ]))
        .pipe(rename('style.css'))
        .pipe(gulp.dest('public_html/assets'));
});

gulp.task('d2', function () {
    return gulp.src('assets/style.css')
        .pipe(sourcemaps.init())
        .pipe(postcss([ autoprefixer() ]))
        .pipe(postcss([
            pxtoviewport({
                viewportWidth: 1600,
                viewportUnit: 'vw',
                selectorBlackList: [
                    // /\.b-progress-bar/,
                    // /\.b-progress-bar__smartline/,
                    // /\.b-progress-bar__smartline::after/,
                    // /\.b-progress-bar__info/,
                ],
            })
        ]))
        .pipe(inject.wrap('@media (min-width: 1021px) {\n', '\n}'))
        .pipe(rename('style_vw.css'))
        .pipe(gulp.dest('assets'));
});

gulp.task('d3', function () {
    return gulp.src('public_html/assets/style_dev_mob.css')
        .pipe(sourcemaps.init())
        .pipe(postcss([ autoprefixer() ]))
        .pipe(postcss([
            pxtoviewport({
                viewportWidth: 320,
                viewportUnit: 'vw',
                selectorBlackList: [
                    // /\.b-progress-bar/,
                    // /\.b-progress-bar__smartline/,
                    // /\.b-progress-bar__smartline::after/,
                    // /\.b-progress-bar__info/,
                ],
            })
        ]))
        .pipe(inject.wrap('@media (max-width: 1020px) {\n', '\n}'))
        .pipe(rename('style_mob.css'))
        .pipe(gulp.dest('public_html/assets'));
});

gulp.task('default', gulp.series('d1', 'd2', 'd3'));