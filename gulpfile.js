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
  console.log("build              = css, js, & image, copies over scaffold and forms folders too".bold.green);
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
  del(['assets/build/**/**']).then(paths => {
    console.log('Deleted the following files:\n',paths.join('\n'));
    console.log('run gulp build to regenerate'.yellow);
  });
});


//=======PACKAGE==============================================================================

//general file moves
gulp.task('packageFAVICONS', function(){
  return gulp.src(['assets/dev/favicons/**/**'])
  .pipe(gulp.dest('assets/build/favicons'))
});

gulp.task('packageFORMS', function(){
  return gulp.src(['assets/dev/forms/**/**'])
  .pipe(gulp.dest('assets/build/forms'))
});

gulp.task('packageSCAFFOLD', function(){
  return gulp.src(['assets/dev/scaffold/**/**'])
  .pipe(gulp.dest('assets/build/scaffold'))
});

gulp.task('packageFONTS', function(){
  return gulp.src(['assets/dev/scss/lib/fontawesome/fonts/**/**'])
  .pipe(gulp.dest('assets/build/css/fonts'))
});

gulp.task('packageDEV', function(){
  return gulp.src(['assets/build/**/**'])
  .pipe(gulp.dest('package/assets/build'))
});

gulp.task('packageFILES', function(){
  return gulp.src(['*.php', '*.txt', '*.html'])
  .pipe(gulp.dest('package'))
});

gulp.task('package', ['packageDEV', 'packageFILES']);

//=======default task=========================================================================
gulp.task('default',['watch']);

//=======watch================================================================================
gulp.task('watch',function(){
  gulp.watch(css_src + '/**/**', ['css']);
  gulp.watch(js_src + js_file + '.js', ['jscheck']);
  gulp.watch(js_src + '/**/**', ['js']);
});

//=======BUILD================================================================================
//pass argument --production i.e. $ gulp build --production
gulp.task('build',['css', 'js', 'image', 'packageFAVICONS', 'packageFORMS', 'packageSCAFFOLD', 'packageFONTS']);
