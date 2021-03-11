let gulp = require('gulp');
let phpunit = require('gulp-phpunit');

gulp.task('test', function() {

    const filter = 'testItCanAddComponentsWhenCreatingProduct ./tests/ProductsTest.php';
    return gulp.src('tests/**/*.php')
        .pipe(phpunit('./vendor/bin/phpunit', { notify: true, clear: true, filter: filter }));
});

gulp.task('watch', function() {
    gulp.series('test');
    gulp.watch(['tests/*.php', 'src/**/*.php'], gulp.series('test'));
});