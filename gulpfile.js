var Promise         = require('es6-promise').Promise,
    gulp            = require('gulp'),
    colors          = require('colors'),
    del             = require('del'),
    argv            = require('yargs').argv,
    gulpif          = require('gulp-if'),
    sourcemaps      = require('gulp-sourcemaps'),
    postcss         = require('gulp-postcss'),
    sass            = require('gulp-sass'),
    sasslint        = require('gulp-sass-lint'),
    autoprefixer    = require('autoprefixer'),
    cssnano        = require('cssnano'),
    concat          = require('gulp-concat'),
    uglify          = require('gulp-uglify'),
    jshint          = require('gulp-jshint'),
    imagemin        = require('gulp-imagemin'),
    pngquant        = require('imagemin-pngquant'),
    mkdirp          = require('mkdirp'),
    createFile      = require('create-file');
//=======options==============================================================================
var css_file    = "site",
    css_src     = "assets/dev/scss",
    css_dest    = "assets/build/css",
    //js locations
    js_file     = "site",
    js_src      = "assets/dev/js",
    js_dest     = "assets/build/js",
    //image locations
    image_src   = "assets/dev/images",
    image_dest  = "assets/build/images";

//=======swallow error so doesn't stop watch=================================================

var swallowError = function(error){
  console.log(error.toString());
  this.emit('end');
};

//=======help=================================================================================
function helpTask(cb){
  console.log("**********************************************************************************************".bold.white.bgYellow);
  console.log("css                = sourcemaps | sass | prefix | minimize | filesize".cyan);
  console.log("checkjs            = jslint | filesize (only site.js)".yellow);
  console.log("js                 = concat | uglify | filesize".yellow);
  console.log("image              = optimize images and save to build dir".magenta);
  console.log("----------------------------------------------------------------------------------------------".america);
  console.log("watch (default)    = css, checkjs, js".bold.green);
  console.log("build              = css, js, & image".bold.green);
  console.log("package            = assets/build/**/** + all *.txt & *.php files in root copied to package/".bold.blue);
  console.log("**********************************************************************************************".bold.white.bgYellow);
  cb();
};
exports.help = helpTask;

//=======stylesheet===========================================================================
//sourcemaps | sass | prefix | minimize
function cssTask(){
  var processors = [autoprefixer({browsers:['last 2 versions', 'ie >= 9', 'android >= 4.4', 'ios >= 7']}),cssnano];
  return gulp.src(css_src + '/' +css_file + '.scss')
  .pipe(sasslint())
  .pipe(sasslint.format())
  .pipe(sourcemaps.init())
  .pipe(sass())
  .on('error', swallowError)
  .pipe(postcss(processors))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest(css_dest));
};
exports.css = cssTask;

//=======javascript check=====================================================================
//concat | jshint
//(--production) concat | sourcemaps | minimize
function checkjsTask (){
  return gulp.src([js_src + '/site.js'])
  .pipe(jshint())
  .pipe(jshint.reporter('jshint-stylish'));
};
exports.checkjs = checkjsTask;

//=======javascript===========================================================================
//concat | uglify
//(--production) concat | sourcemaps | minimize
function jsTask(){
  return gulp.src([js_src + '/lib/*.js', js_src + '/site.js'])
  .pipe(concat(js_file + '.js'))
  .pipe(sourcemaps.init())
  .pipe(uglify())
  .on('error', swallowError)
  .pipe(sourcemaps.write())
  .pipe(gulp.dest(js_dest));
};
exports.js = jsTask;

//=======images===============================================================================
function imageTask(){
  return gulp.src(image_src + '/**')
  .pipe(imagemin({
      progressive: true,
      svgPlugins: [{removeViewBox: false}],
      use: [pngquant()]
  }))
  .pipe(gulp.dest(image_dest));
};
exports.image = imageTask;

//=======watch================================================================================
function watchTask(){
  gulp.watch(css_src + '/**/**', cssTask);
  gulp.watch(js_src + js_file + '.js', checkjsTask);
  gulp.watch(js_src + '/**/**', jsTask);
};
exports.watch = watchTask;

//=======BUILD================================================================================

exports.build = gulp.parallel(cssTask, jsTask, imageTask);

//=======PACKAGE==============================================================================

function packageDEVtask(){
  return gulp.src(['assets/build/**/**'])
  .pipe(gulp.dest('package/assets/build'))
};
exports.packageDEV = packageDEVtask;

function packageFAVICONStask(){
  return gulp.src(['assets/favicons/**/**'])
  .pipe(gulp.dest('package/assets/favicons'))
};
exports.packageFAVICONS = packageFAVICONStask;

function packageFORMStask(){
  return gulp.src(['assets/forms/**/**'])
  .pipe(gulp.dest('package/assets/forms'))
};
exports.packageFORMS = packageFORMStask;

function packageFILEStask(){
  return gulp.src(['*.php', '*.txt'])
  .pipe(gulp.dest('package'))
};
exports.packageFILES = packageFILEStask;

exports.package = gulp.parallel(packageDEVtask, packageFAVICONStask, packageFORMStask, packageFILEStask);

//default Task
exports.default = watchTask;
