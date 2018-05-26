const gulp         = require('gulp'),
  	  sass         = require('gulp-sass'),
	  browserSync  = require('browser-sync').create(),
  	  cssnano      = require('gulp-cssnano'),
	  rename       = require('gulp-rename'),
	  sourcemaps   = require('gulp-sourcemaps'),
	  concat       = require('gulp-concat'),
	  plumber 	   = require('gulp-plumber'),
	  notify 	   = require('gulp-notify'),
	  uglify       = require('gulp-uglifyjs');

const dirs = {
	sass: 'assets/sass',
	css: 'assets/css',
	js: 'assets/js',
	jsLibs: 'assets/libs/',
	es6: 'assets/es6'
};

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: 'v277',
        notify: false
    });
});

gulp.task('sass', function() {
	return gulp.src(dirs.sass + '/**/*.+(sass|scss)')
		.pipe(sourcemaps.init())
		.pipe(plumber({errorHandler: notify.onError((error) => {
			return {
				title: 'Error',
				message: error.message
			}
		})}))
		.pipe(sass())
		.pipe(cssnano())
		.pipe(rename({suffix: '.min'}))
		.pipe(sourcemaps.write('/maps'))
		.pipe(gulp.dest(dirs.css))
		.pipe(browserSync.stream({match: '**/*.css'}))
});

gulp.task('cssLibs', function() {
	return gulp.src(dirs.css + '/libs/**/*.css')
	.pipe(sourcemaps.init())
	.pipe(plumber({errorHandler: notify.onError((error) => {
		return {
			title: 'Error',
			message: error.message
		}
	})}))
	.pipe(concat('lib.min.css'))
	.pipe(cssnano())
	.pipe(sourcemaps.write('/maps'))
	.pipe(gulp.dest(dirs.css))
});

gulp.task('customScript', function(){
	return gulp.src(dirs.es6 + '/**/*.js')
	.pipe(plumber({errorHandler: notify.onError((error) => {
		return {
			title: 'Error',
			message: error.message
		}
	})}))
	.pipe(uglify())
	.pipe(rename({suffix: '.min'}))
	.pipe(gulp.dest(dirs.js))
});

gulp.task('scripts', function(){
	return gulp.src([
		dirs.jsLibs + 'bootstrap-3-3-7.js',
		dirs.jsLibs + 'slick-1-8-0.js',
		dirs.jsLibs + 'lightbox2.js',
	])
	.pipe(plumber({errorHandler: notify.onError((error) => {
		return {
			title: 'Error',
			message: error.message
		}
	})}))
	.pipe(concat('libs.min.js'))
	.pipe(uglify())
    .pipe(gulp.dest(dirs.js))

})

gulp.task('watch',['browser-sync', 'scripts', 'cssLibs'], function() {
	gulp.watch(dirs.sass + '/**/*.+(sass|scss)', ['sass']);
	gulp.watch(dirs.es6 + '/**/*.js', ['customScript']);
	gulp.watch(dirs.js + '/**/*.js', browserSync.reload);
});

gulp.task('default', ['watch']);
