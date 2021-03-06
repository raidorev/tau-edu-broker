import autoprefixer from 'autoprefixer'
import del from 'del'
import gulp from 'gulp'
import cleanCss from 'gulp-clean-css'
import gulpIf from 'gulp-if'
import postcss from 'gulp-postcss'
import gulpSass from 'gulp-sass'
import sourcemaps from 'gulp-sourcemaps'
import ts from 'gulp-typescript'
import sassLib from 'sass'

const isDevelopment = process.env.NODE_ENV === 'development'
const isProduction = !isDevelopment

const sourceGlobs = {
  styles: './resources/styles/**/*.s[ac]ss',
  scripts: './resources/scripts/**/*.ts',
}

const sass = gulpSass(sassLib)

const clean = () => del(['./dist'])

const compileSass = () =>
  gulp
    .src(sourceGlobs.styles)
    .pipe(
      sass({
        includePaths: ['node_modules'],
      }).on('error', sass.logError)
    )
    .pipe(gulpIf(isDevelopment, sourcemaps.init()))
    .pipe(gulpIf(isProduction, postcss([autoprefixer()])))
    .pipe(gulpIf(isProduction, cleanCss()))
    .pipe(gulpIf(isDevelopment, sourcemaps.write('.')))
    .pipe(gulp.dest('./web/dist/css'))

const compileTypescript = () =>
  gulp
    .src(sourceGlobs.scripts)
    .pipe(ts())
    .pipe(gulpIf(isDevelopment, sourcemaps.init()))
    .pipe(gulpIf(isDevelopment, sourcemaps.write('.')))
    .pipe(gulp.dest('./web/dist/js'))

const build = gulp.series(
  clean,
  gulp.parallel([compileSass, compileTypescript])
)

gulp.task('default', build)
gulp.task('watch', () => gulp.watch(Object.values(sourceGlobs), build))
