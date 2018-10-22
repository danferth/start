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
gulp.task('help', function(){
  console.log("**********************************************************************************************".bold.white.bgYellow);
  console.log("css                = sourcemaps | sass | prefix | minimize | filesize".cyan);
  console.log("checkjs            = jslint | filesize (only site.js)".yellow);
  console.log("js                 = concat | uglify | filesize".yellow);
  console.log("image              = optimize images and save to build dir".magenta);
  console.log("----------------------------------------------------------------------------------------------".america);
  console.log("watch (default)    = css, checkjs, js".bold.green);
  console.log("clear              = delete css & js from build/".bold.green);
  console.log("build              = css, js, & image".bold.green);
  console.log("package            = copies all relavent files to package/ (use build first)".bold.blue);
  console.log("**********************************************************************************************".bold.white.bgYellow);
});

//=======stylesheet===========================================================================
//sourcemaps | sass | prefix | minimize | filesize
gulp.task('css',function(){
  var processors = [autoprefixer({browsers:['last 2 versions', 'ie >= 9', 'android >= 4.4', 'ios >= 7']}),csswring];
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

//=======javascript check=====================================================================
//concat | jshint | filesize
//(--production) concat | sourcemaps | minimize | filesize
gulp.task('checkjs', function(){
  return gulp.src([js_src + '/site.js'])
  .pipe(jshint())
  .pipe(jshint.reporter('jshint-stylish'))
  .pipe(filesize());
});

//=======javascript===========================================================================
//concat | uglify | filesize
//(--production) concat | sourcemaps | minimize | filesize
gulp.task('js', function(){
  return gulp.src([js_src + '/lib/*.js', js_src + '/site.js'])
  .pipe(concat(js_file + '.js'))
  .pipe(sourcemaps.init())
  .pipe(uglify())
  .on('error', swallowError)
  .pipe(sourcemaps.write())
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

//=======delete files in buld css & js========================================================
gulp.task('clear', function(){
  del(['assets/build/css/*.css', 'assets/build/js/*', 'assets/build/images/*']).then(paths => {
    console.log('Deleted the following files:\n',paths.join('\n'));
    console.log('run gulp build to regenerate'.yellow);
  });
});



//=======watch================================================================================
gulp.task('watch',function(){
  gulp.watch(css_src + '/**/**', ['css']);
  gulp.watch(js_src + js_file + '.js', ['jscheck']);
  gulp.watch(js_src + '/**/**', ['js']);
});

//=======BUILD================================================================================
//pass argument --production i.e. $ gulp build --production
gulp.task('build',['css', 'js', 'image']);

//=======PACKAGE==============================================================================

gulp.task('packageDEV', function(){
  return gulp.src(['assets/build/**/**'])
  .pipe(gulp.dest('package/assets/build'))
});

gulp.task('packageFAVICONS', function(){
  return gulp.src(['assets/favicons/**/**'])
  .pipe(gulp.dest('package/assets/favicons'))
});

gulp.task('packageFORMS', function(){
  return gulp.src(['assets/forms/**/**'])
  .pipe(gulp.dest('package/assets/forms'))
});

gulp.task('packageFILES', function(){
  return gulp.src(['*.php', '*.txt', '*.html'])
  .pipe(gulp.dest('package'))
});

gulp.task('package', ['packageDEV', 'packageFAVICONS', 'packageFORMS', 'packageFILES']);

//=======default task=========================================================================
gulp.task('default',['watch']);
