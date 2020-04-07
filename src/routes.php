<?php

    $prefix = 'html-blocks.routes.prefix';
    $middle = 'html-blocks.routes.middlewares';

    Route::
        prefix(config($prefix, 'admin'))
        ->middleware(config($middle, []))
        ->namespace('ClaudiusNascimento\HtmlBlocks\Controllers')
            ->group(function() {

        Route::resource('html-blocks', 'HtmlBlocksController')
            ->only(['store', 'update', 'destroy']);

    });
