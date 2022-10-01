const gulp = require('gulp');
const requireDir = require('require-dir');
requireDir('./.tasks');

// Run npm run buid
gulp.task('build', gulp.parallel(
		'styles-main',
		'styles-blocks',
		'scripts-main',
		'scripts-blocks',
		'icons'
	)
);