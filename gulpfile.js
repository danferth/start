var Promise         = require('es6-promise').Promise,
    gulp            = require('gulp'),
    colors          = require('colors'),
    filesize        = require('gulp-filesize'),
    del             = require('del'),
    argv            = require('yargs').argv,
    gulpif          = require('gulp-if'),
    sourcemaps      = require('gulp-sourcemaps'),
    postcss         = require('gulp-postcss'),
    sass            = require('gulp-sass'),
    sasslint        = require('gulp-sass-lint'),
    autoprefixer    = require('autoprefixer'),
    csswring        = require('csswring'),
    concat          = require('gulp-concat'),
    uglify          = require('gulp-uglify'),
    jshint          = require('gulp-jshint'),
    imagemin        = require('gulp-imagemin'),
    pngquant        = require('imagemin-pngquant'),
    mkdirp          = require('mkdirp'),
    createFile      = require('create-file');
//=======options==============================================================================
var css_file    = "site",
    css_src     = "assets/scss",
    css_dest    = "assets/build/css",
    //js locations
    js_file     = "site",
    js_src      = "assets/js",
    js_dest     = "assets/build/js",
    //image locations
    image_src   = "assets/images",
    image_dest  = "assets/build/images";
//=======swallow error so doesn't stop watch=================================================

var swallowError = function(error){
  console.log(error.toString());
  this.emit('end');
};



//=======default task=========================================================================
gulp.task('default',['watch']);

//=======help=================================================================================
gulp.task('help', function(){
  console.log("=============================================================".bold.green);
  console.log("css                = sourcemaps | sass | prefix | minimize | filesize".cyan);
  console.log("js                 = concat | jshint | filesize".yellow);
  console.log("js --production    = concat | sourcemaps | minimize | filesize".yellow);
  console.log("image              = optimize images and save to build dir".magenta);
  console.log("watch (default)    = css && js".bold.green);
  console.log("build              = css, js --production & image".grey);
  console.log("build --production = css, js --production & image".inverse);
  console.log("=============================================================".bold.yellow);
});

//=======stylesheet===========================================================================
//sourcemaps | sass | prefix | minimize | filesize
gulp.task('css',function(){
  var processors = [autoprefixer({browsers:['last 2 version']}),csswring];
  return gulp.src(css_src + '/' +css_file + '.scss')
  .pipe(sasslint())
  .pipe(sasslint.format())
  .pipe(sourcemaps.init())
  .pipe(sass())
  .on('error', swallowError)
  .pipe(postcss(processors))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest(css_dest))
  .pipe(filesize());
});

//=======javascript===========================================================================
//concat | jshint | filesize
//(--production) concat | sourcemaps | minimize | filesize
gulp.task('js', function(){
  return gulp.src([js_src + '/lib/*.js', js_src + '/site.js'])
  .pipe(concat(js_file + '.js'))
  .pipe(filesize())
  .pipe(sourcemaps.init())
  .pipe(uglify())
  .pipe(sourcemaps.write())
  .pipe(jshint())
  .pipe(jshint.reporter('jshint-stylish'))
  .pipe(gulp.dest(js_dest))
  .pipe(filesize());
});

//=======images===============================================================================
gulp.task('image', function(){
  return gulp.src(image_src + '/**')
  .pipe(imagemin({
      progressive: true,
      svgPlugins: [{removeViewBox: false}],
      use: [pngquant()]
  }))
  .pipe(gulp.dest(image_dest));
});


//=======watch================================================================================
gulp.task('watch',function(){
  gulp.watch(css_src + '/**/**', ['css']);
  gulp.watch(js_src + '/**/**', ['js']);
});

//=======BUILD================================================================================
//pass argument --production i.e. $ gulp build --production
gulp.task('build',['css', 'js', 'image']);