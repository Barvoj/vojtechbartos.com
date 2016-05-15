// ====== Imports of dependencies (installed via npm) =======
var gulp = require('gulp');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
var less = require('gulp-less');
var path = require('path');
var merge = require('merge-stream');
var uglify = require('gulp-uglify');
var expect = require('gulp-expect-file');
var exec = require('gulp-exec');

// ====== Configuration =======

var paths = {
    // Scripts in JS to be compiled into one file, order matters!
    scripts: [
        'vendor/frontend/jquery/dist/jquery.min.js',
        'vendor/frontend/bootstrap/dist/js/bootstrap.min.js',
        // Internal files
        'resources/js/*.js',
    ],
    stylesCore: [
        'vendor/frontend/bootstrap/dist/css/bootstrap.min.css',
    ],
    lessStyles: [
        'resources/css/*.less',
    ],
    // Font files to be copied.
    fonts: [
        'vendor/frontend/bootstrap/dist/fonts/*'
    ]
};

// Multiple destinations -- each of them should be git ignored.
var destinations = {
    scripts: 'www/js/',
    styles: 'www/styles/',
    fonts: 'www/fonts/'
};

// ====== General tasks =======
gulp.task('clean', function () {
    var arr=[];
    for( var i in destinations ) {
        if (destinations.hasOwnProperty(i)){
            arr.push(destinations[i]);
        }
    }
    return gulp.src(arr, {read: false})
        .pipe(clean());
});

gulp.task('default', ['styles', 'scripts']);

// ====== Stylesheet preparation ======
gulp.task('styles', function() {
    var cssStream = gulp.src(paths.stylesCore)
        .pipe(expect(paths.stylesCore));
    var lessStream = gulp.src(paths.lessStyles)
        .pipe(expect(paths.lessStyles))
        .pipe(less({
            paths: [ path.join(__dirname) ]
        }));

    return mergedStream = merge(cssStream, lessStream)
        .pipe(concat('style.css'))
        .pipe(gulp.dest(destinations.styles));
});

// ====== Fonts =======
gulp.task('fonts', function() {
    return gulp.src(paths.fonts)
        .pipe(expect(paths.fonts))
        .pipe(gulp.dest(destinations.fonts));
});

// ====== Javascript =======
gulp.task('scripts', function() {
    return gulp.src(paths.scripts)
        .pipe(expect(paths.scripts))
        .pipe(concat('script.js'))
        .pipe(gulp.dest(destinations.scripts));
});