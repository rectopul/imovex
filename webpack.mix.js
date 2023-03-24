const mix = require('laravel-mix')
var path = require('path')

mix
    // .js('resources/js/site.js', 'public/js')
    // .vue()
    // .sass('resources/sass/site.scss', 'public/css')

    // .js('resources/js/admin.js', 'public/js')
    // .sass('resources/sass/admin.scss', 'public/css')

    .js('resources/js/web.js', 'public/js')
    .js('resources/js/dashboard.js', 'public/js')
    .vue()
    
    .sass('resources/sass/web.scss', 'public/css')
    .sass('resources/sass/dashboard.scss', 'public/css')
    .sass('resources/sass/plugins/summernote.scss', 'public/css')

    .autoload({
        jquery: ['$', 'window.jQuery']
    })

    .alias({
        '@': path.join(__dirname, 'resources/js'),
        'plugins': path.join(__dirname, 'resources/js/plugins')
    })

    .options({
        processCssUrls: false
    })
