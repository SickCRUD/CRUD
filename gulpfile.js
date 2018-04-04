let autoprefixer = require('gulp-autoprefixer'),
    cleanCSS = require('gulp-clean-css'),
    concat = require('gulp-concat'),
    cssbeautify = require('gulp-cssbeautify'),
    del = require('del'),
    gulp = require('gulp'),
    gulpif = require('gulp-if'),
    rename = require('gulp-rename'),
    runSequence  = require('gulp4-run-sequence'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify');

// COMPILING VARIABLES
let production = false;

// GULP TO COMPILE SCSS
gulp.task('sass', function () {

    return gulp.src([
        'frontend/sass/SickCRUD.scss'
    ])
        .pipe(
            sass().on('error', sass.logError)
        )
        .pipe(
            autoprefixer({
                browsers: ['> 1%', 'last 2 versions', 'firefox >= 4', 'safari 7', 'safari 8', 'IE 8', 'IE 9', 'IE 10', 'IE 11'],
                cascade: true
            })
        )
        .pipe(
            gulpif(
                production,
                cssbeautify()
            )
        )
        .pipe(
            gulp.dest('publishes/public/css')
        );

});


// GULP CSS MINIFY TO MINIFY CSS
gulp.task('css', function () {

    return gulp.src([
        'publishes/public/css/*.css',
        '!publishes/public/css/*.min.css'
    ])
        .pipe(
            cleanCSS(
                {
                    compatibility: 'ie9'
                }
            )
        )
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(
            gulp.dest('publishes/public/css')
        );

});

// GULP JS MINIFY TO MINIFY JS
gulp.task('js', function () {

    return gulp.src([
        'frontend/js/*.js'
    ])
        .pipe(
            gulp.dest('publishes/public/js')
        )
        .pipe(
            uglify({
                mangle: true,
                compress: {
                    typeofs: false
                }
            }).on('error', function(uglify) {
                console.error(uglify.message);
            })
        )
        .pipe(
            rename({
                suffix: '.min'
            })
        )
        .pipe(
            gulp.dest('publishes/public/js')
        );

});

// DEFAULT GULP TASK
gulp.task('default', function() {
    return new Promise(function(resolve, reject) {
        runSequence(['sass', 'css', 'js']);
        resolve();
    });
});