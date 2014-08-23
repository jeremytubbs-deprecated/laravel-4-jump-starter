'use strict';

var gulp = require('gulp');

var $ = require('gulp-load-plugins')();
var mainBowerFiles = require('main-bower-files');
var concat = require('gulp-concat');

gulp.task('styles', function () {
    var cssFilter = $.filter('**/*.css');
    return gulp.src('app/assets/sass/*.scss')
        .pipe($.rubySass({
            style: 'expanded',
            precision: 10
        }))
        .pipe(concat('main.css'))
        .pipe($.autoprefixer('last 1 version'))
        .pipe(cssFilter)
        .pipe($.csso())
        .pipe(cssFilter.restore())
        .pipe($.rename({ suffix: '.min' }))
        .pipe(gulp.dest('public/styles'))
        .pipe($.size());
});

gulp.task('scripts', function () {
    var jsFilter = $.filter('**/*.js');
    return gulp.src('app/assets/js/**/*.js')
        .pipe($.jshint())
        .pipe($.jshint.reporter(require('jshint-stylish')))
        .pipe(jsFilter)
        .pipe(jsFilter.restore())
        .pipe($.uglify())
        .pipe($.rename({ suffix: '.min' }))
        .pipe(gulp.dest('public/scripts'))
        .pipe($.size());
});

gulp.task('bootstrapJs', function(){
    var bootstrapPath = 'app/assets/bower_components/bootstrap-sass-official/assets/';
    var bootstrapJsSrc = bootstrapPath + 'javascripts/bootstrap.js';
    return gulp.src(bootstrapJsSrc)
        .pipe($.uglify())
        .pipe($.rename({ suffix: '.min' }))
        .pipe(gulp.dest('public/vendor'))
        .pipe($.size());
});

gulp.task('bootstrapSass', function(){
    var bootstrapSassSrc = 'app/assets/vendor/bootstrap_variables.scss';
    return gulp.src(bootstrapSassSrc)
        .pipe($.rubySass({
            style: 'expanded',
            precision: 10
        }))
        .pipe($.csso())
        .pipe($.rename('bootstrap.min.css'))
        .pipe(gulp.dest('public/vendor'))
        .pipe($.size());
});

gulp.task('moveAngular', function(){
    return gulp.src(['app/assets/bower_components/angular/angular.min.js', 'app/assets/bower_components/angular/angular.min.js.map'])
        .pipe(gulp.dest('public/vendor/angular'));
});

gulp.task('watch', function () {
    // watch for changes
    gulp.watch('app/assets/sass/*.scss', ['styles']);
    gulp.watch('app/assets/vendor/**/*.scss', ['bootstrapSass']);
});

gulp.task('default', ['bootstrapJs', 'bootstrapSass', 'styles', 'scripts', 'moveAngular', 'watch']);
