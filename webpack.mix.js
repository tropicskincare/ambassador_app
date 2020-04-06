const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.setResourceRoot('/mytropic.com/public/');

mix.styles([
	'resources/css/mobile.css',
	'resources/css/inter.css',
	'resources/css/desktop.css'
], 'public/css/all.css');

mix.copyDirectory('resources/images', 'public/images');

mix.version();
