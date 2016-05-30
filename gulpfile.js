var gulp   = require('gulp'),
    sass   = require('gulp-sass'),
    jshint = require('gulp-jshint'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    pot    = require('gulp-wp-pot'),
    sort   = require('gulp-sort'),
    token  = require('gulp-token-replace');

var pluginTokens = require('./settings.json');

// Admin styles
gulp.task('admin-sass', function() {
  return gulp.src('./stylesheets/admin.scss')
    .pipe(sass())
    .pipe(rename({prefix: pluginTokens.plugin.slug + '-'}))
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug + '/assets/admin/css'));
});

// Frontend Styles
gulp.task('public-sass', function() {
  return gulp.src('./stylesheets/public.scss')
    .pipe(sass())
    .pipe(rename({prefix: pluginTokens.plugin.slug + '-'}))
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug + '/assets/public/css'));
});

// Combined Sass task
gulp.task('sass', ['admin-sass', 'public-sass']);

// Admin scripts
gulp.task('admin-js', function () {
  return gulp.src('./scripts/admin/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('fail'))
    .pipe(concat(pluginTokens.plugin.slug + '-admin-script.js'))
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug + '/assets/admin/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug + '/assets/admin/js'))
    ;
});

// Frontend scripts
gulp.task('public-js', function () {
  return gulp.src('./scripts/public/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('fail'))
    .pipe(concat(pluginTokens.plugin.slug + '-public-script.js'))
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug + '/assets/public/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug + '/assets/public/js'));
});

// Combined js task
gulp.task('js', ['admin-js', 'public-js']);

// Token replacements
gulp.task('tokens', function() {
  return gulp.src(['./src/**/*.php', './src/readme.*'], {base: "./src/"})
    .pipe(token({global:pluginTokens}))
    .pipe(rename(function(path) {
      if (path.dirname == 'classes') {
        path.basename = path.basename.replace('_PLUGIN', pluginTokens.plugin.package);
      }
      else {
        path.basename = path.basename.replace('_PLUGIN', pluginTokens.plugin.slug);
      }
    }))
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug));
});

// Create .pot file for translations
gulp.task('l18n', ['tokens'], function() {
  return gulp.src(['plugin-build/*.php', './plugin-build/**/*.php'])
  		.pipe(sort())
  		.pipe(pot({
  			domain:  pluginTokens.plugin.slug,
  			headers: false
  		}))
  		.pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug + '/languages'));
});

// Build Directory
gulp.task('src', function() {
  return gulp.src(['./src/**', '!./src/**/*_PLUGIN*'], {base: "./src/"})
    .pipe(gulp.dest('./plugin-build/' + pluginTokens.plugin.slug))
});

// Deploy to Dev
gulp.task('dev', ['src'], function() {
  return gulp.src('./plugin-build/' + pluginTokens.plugin.slug + '/**')
  .pipe(gulp.dest(pluginTokens.plugin.dev + pluginTokens.plugin.slug, {overwrite: true}));
});

gulp.task('default', ['sass', 'js', 'l18n', 'src', 'tokens', 'dev']);
