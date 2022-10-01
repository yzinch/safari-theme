const gulp = require('gulp');


gulp.task('icons', (done) => {
    return gulp
		.src('node_modules/bootstrap-icons/font/fonts/*')
        .pipe(gulp.dest('assets/fonts'));
});