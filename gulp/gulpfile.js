// Let's rock and roll
var gulp          = require('gulp'),
    sass          = require('gulp-ruby-sass'),
    autoprefixer  = require('gulp-autoprefixer'),
    minifycss     = require('gulp-minify-css'),
    jshint        = require('gulp-jshint'),
    uglify        = require('gulp-uglify'),
    imagemin      = require('gulp-imagemin'),
    rename        = require('gulp-rename'),
    concat        = require('gulp-concat'),
    notify        = require('gulp-notify'),
    cache         = require('gulp-cache'),
    livereload    = require('gulp-livereload'),
    del           = require('del');

// Css 
gulp.task('styles', function() {
  return sass('../css/sass/style.scss', { style: 'expanded' })
    .pipe(autoprefixer('last 2 version'))
    //.pipe(concat('../css/dist/style.css'))
    .pipe(gulp.dest('../css/dist/'))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('../css/dist/'))
    .pipe(livereload())
    .pipe(notify({ message: 'Styles task complete' }));
});

// Js
gulp.task('scripts', function() {
  return gulp.src(['../js/plugins/*.js', '../js/app.js'])
    // .pipe(jshint('.jshintrc'))
    // .pipe(jshint.reporter('default'))
    .pipe(concat('../dist/script.js'))
    .pipe(gulp.dest('../js/dist/'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('../js/dist/'))
    .pipe(livereload())
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Img
// gulp.task('images', function() {
//   return gulp.src('src/images/**/*')
//     .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
//     .pipe(gulp.dest('dist/assets/img'))
//     .pipe(notify({ message: 'Images task complete' }));
// });

// Clean dist
gulp.task('clean', function(cb) {
    del(['../js/dist/', '../css/dist/'], cb)
});

// Task
gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('../css/sass/*.scss', ['styles']);
  // Watch .js files
  gulp.watch('../js/plugins/*.js', ['scripts']);
  gulp.watch('../js/app.js', ['scripts']);

  // Watch image files
  // gulp.watch('src/images/**/*', ['images']);

  // Watch any files in dist/, reload on change
  livereload.listen();
  gulp.watch(['../js/dist/**']).on('change', livereload.changed);
  gulp.watch(['../css/**/*.*']).on('change', livereload.changed);
  gulp.watch(['../**/*.twig']).on('change', livereload.changed);
  gulp.watch(['../**/*.php']).on('change', livereload.changed);

});
