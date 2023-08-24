const gulp = require('gulp');
const exec = require('child_process').exec;

gulp.task('default', function() {
    gulp.watch(['app/**/*.php', 'resources/**/*.php'], function() {
        exec('php artisan migrate:refresh --seed', function(err, stdout, stderr) {
            console.log(stdout);
            console.log(stderr);
        });
    });
});
