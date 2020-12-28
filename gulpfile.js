

// Load Gulp...of course
const { src, dest, task, watch, series, parallel } = require('gulp');

// CSS related plugins
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var purgecss = require('gulp-purgecss');

// JS related plugins
var uglify = require('gulp-uglify');
var babelify = require('babelify');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var stripDebug = require('gulp-strip-debug');

// Utility plugins
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var options = require('gulp-options');
var gulpif = require('gulp-if');
var newer = require('gulp-newer');

// Browers related plugins
var browserSync = require('browser-sync').create();

// Project related variables
var styleSRC = './src/scss/main.scss';
var styleURL = './dist/css/';
var mapURL = './';

var jsSRC = './src/js/';
var jsFront = 'main.js';
var jsFiles = [jsFront];
var jsURL = './dist/js/';

var imgSRC = './src/images/**/*';
var imgURL = './dist/images/';

var fontsSRC = ['./src/fonts/**/*', '!./src/fonts/**/scss', '!./src/fonts/**/scss/*'];
var fontsURL = './dist/fonts/';

var phpSRC = './**/*.php';
var phpURL = './dist/';

var styleWatch = './src/scss/**/*.scss';
var jsWatch = './src/js/**/*.js';
var imgWatch = './src/images/**/*.*';
var fontsWatch = './src/fonts/**/*.*';
var phpWatch = './**/*.php';

// Tasks
function browser_sync() {
	browserSync.init({
		proxy: 'http://localhost:8888/JIK-WP-THEME/'
	});
}

function reload(done) {
	browserSync.reload();
	done();
}

function css(done) {
	src([styleSRC])
		.pipe(sourcemaps.init())
		.pipe(sass({
			errLogToConsole: true,
			outputStyle: 'compressed'   //'nested' (dev) or 'compressed' (prod)
		}))
		.on('error', console.error.bind(console))
		.pipe(autoprefixer({}))
		.pipe(rename({ suffix: '.min' }))
		.pipe(
			purgecss({
				content: ['./**/*.php']
			})
		) // only for prod
		.pipe(sourcemaps.write(mapURL))
		.pipe(dest(styleURL))
		.pipe(browserSync.stream());
	done();
};

function js(done) {
	jsFiles.map(function (entry) {
		return browserify({
			entries: [jsSRC + entry]
		})
			.transform(babelify, { presets: ['@babel/preset-env'] })
			.bundle()
			.pipe(source(entry))
			.pipe(rename({
				extname: '.min.js'
			}))
			.pipe(buffer())
			.pipe(gulpif(options.has('production'), stripDebug()))
			.pipe(sourcemaps.init({ loadMaps: true }))
			.pipe(uglify())
			.pipe(sourcemaps.write('.'))
			.pipe(dest(jsURL))
			.pipe(browserSync.stream());
	});
	done();
};

function triggerPlumber(src_file, dest_file) {
	return src(src_file)
		.pipe(plumber())
		.pipe(dest(dest_file));
}

function images() {
	return triggerPlumber(imgSRC, imgURL);
};

function fonts() {
	return triggerPlumber(fontsSRC, fontsURL);
};


function php() {
	return src(phpSRC)
		//  .pipe( newer( phpURL ) )
		//	.pipe( dest( phpURL ) )
		;
};


function watch_files() {
	watch(styleWatch, series(css, reload));
	watch(jsWatch, series(js, reload));
	watch(imgWatch, series(images, reload));
	watch(fontsWatch, series(fonts, reload));
	watch(phpWatch, series(php, reload));
	src(jsURL + 'main.min.js')
		.pipe(notify({ message: 'Gulp is Watching, Happy Coding!' }));
}

task("css", css);
task("js", js);
task("images", images);
task("fonts", fonts);
task("php", php);
task("default", parallel(css, js, images, fonts));
task("watch", parallel(browser_sync, watch_files));