var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    browserify = require('gulp-browserify');

// Compile overwrite styles for Laravel Administrator
gulp.task('sass', function() {
    return gulp.src([
        'app/assets/sass/**/*.scss'
    ])
        .pipe(plumber())
        .pipe(sass({errLogToConsole: true}))
        .pipe(concat('main.css'))
        .pipe(autoprefixer('last 10 version', 'safari 5', 'ie 9', 'ios 6', 'android 4'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss())
        .pipe(gulp.dest('public/styles'));
});

gulp.task('vendor_sass', function() {
    return gulp.src([
        'app/assets/vendor/bootstrap_variables.scss'
        //'bower_components/bootstrap-sass-official/vendor/assets/stylesheets/*.scss'
    ])
        .pipe(plumber())
        .pipe(sass({errLogToConsole: true}))
        .pipe(rename('vendor.min.css'))
        .pipe(minifycss())
        .pipe(gulp.dest('public/styles'));
});

gulp.task('js', function() {
    gulp.src('app/assets/js/main.js')
        .pipe(browserify({ debug: true }))
        .pipe(concat('bundle.js'))
        .pipe(gulp.dest('public/scripts'));
});

gulp.task('vendor_js', function() {
    gulp.src('app/assets/vendor/vendor.js')
        .pipe(browserify({ debug: true }))
        .pipe(concat('vendor_bundle.js'))
        .pipe(gulp.dest('public/scripts'));
});

// Watch for changes in assets
gulp.task('watch', function() {
    gulp.watch(['app/assets/sass/**/*.scss'], ['sass']);
    gulp.watch(['app/assets/vendor/**/*.scss'], ['vendor_sass']);
    gulp.watch(['app/assets/js/**/*.js'], ['js']);
    gulp.watch(['app/assets/vendor/**/*.js'], ['vendor_js']);
});

gulp.task('default', ['sass', 'vendor_sass', 'js', 'vendor_js','watch']);
