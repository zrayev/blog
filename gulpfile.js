var gulp = require('gulp'),
    less = require('gulp-less'),
    concatJs = require('gulp-concat'),
    minifyJs = require('gulp-uglify');

gulp.task('less', function() {
    return gulp.src(['web-src/less/*.less'])
        .pipe(less({compress: true}))
        .pipe(gulp.dest('web/bundles/app/css/'));
});

gulp.task('css', function() {
    return gulp.src([
        'bower_components/jqcloud2/dist/jqcloud.min.css'
            //'web-src/css/*.css'
        ])
        //.pipe(less({compress: true}))
        .pipe(gulp.dest('web/bundles/app/css/'));
});
//
//gulp.task('fonts', function () {
//    return gulp.src([
//        'bower_components/bootstrap/fonts/*',
//        'web-src/fonts/*'
//    ])
//        .pipe(gulp.dest('web/bundles/app/fonts/'))
//});

gulp.task('images', function () {
    return gulp.src([
            'web-src/img/*'
        ])
        .pipe(gulp.dest('web/bundles/app/img/'))
});

gulp.task('lib-js', function() {
    return gulp.src([
            'bower_components/jquery/dist/jquery.js',
            'bower_components/bootstrap/dist/js/bootstrap.js'
        ])
        .pipe(concatJs('app.js'))
        .pipe(minifyJs())
        .pipe(gulp.dest('web/bundles/app/js/'));
});

gulp.task('pages-js', function() {
    return gulp.src([
            'web-src/js/*.js',
            'bower_components/jquery/dist/jquery.min.js',
            'bower_components/jscroll/jquery.jscroll.min.js'
            //'bower_components/jqcloud2/dist/jqcloud.min.js'
        ])
        .pipe(minifyJs())
        .pipe(gulp.dest('web/bundles/app/js/'));
});

gulp.task('default', function () {
    //var tasks = ['less', 'fonts', 'css', 'images', 'lib-js', 'pages-js'];
    var tasks = ['less', 'images', 'css', 'lib-js', 'pages-js'];
    tasks.forEach(function (val) {
        gulp.start(val);
    });
});

gulp.task('watch', function () {
    var less = gulp.watch('web-src/less/*.less', ['less']),
        js = gulp.watch('web-src/js/*.js', ['pages-js']);
});