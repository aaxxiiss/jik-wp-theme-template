# JIK Wordpress Theme Template

This is a blanc wordpress theme template for developing new custom theme.
Template includes Bootstrap and FontAwesome. SASS and js compiled with Gulp.

## Set up for new theme development

- find and replace "JIK-WP-THEME" from all files with theme specific name-spaces / descriptions
- add webfont import: /src/scss/main.scss
- add theme specific styles to override Bootstrap defaults: /src/scss/bootstrap-modifications.scss
- edit and replace screenshot.png

Watch for changes and compile:
$ gulp watch
