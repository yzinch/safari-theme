const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const prefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const path = require('node:path');


gulp.task('styles-main', (done) => {
	return gulp
		.src('src/styles/{main,admin}.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
            precision: 8
        }).on('error', sass.logError))
		.pipe(prefixer())
		.pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/css/'));
});

gulp.task( 'styles-blocks', (done) => {
	return gulp
		.src('src/styles/blocks/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
            precision: 8
        }).on('error', sass.logError))
		.pipe(prefixer())
		.pipe(rename( function(file){
			file.dirname = path.join(file.dirname, 'assets', 'css');
		}))
		.pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('blocks/'));
});