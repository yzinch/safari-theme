const gulp = require('gulp');
const babel = require('gulp-babel');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const path = require('node:path');

gulp.task('scripts-main', (done) => {
    return gulp
		.src('src/scripts/app.js')
		.pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['@babel/env']
        }))
		.pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/js'));
});

gulp.task('scripts-blocks', (done) => {
    return gulp
		.src('src/scripts/blocks/**/*.js')
		.pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(rename( function(file){
			file.dirname = path.join(file.dirname, 'assets', 'js');
		}))
		.pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('blocks'))
});