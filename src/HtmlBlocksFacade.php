<?php

namespace ClaudiusNascimento\HtmlBlocks;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ClaudiusNascimento\HtmlBlocks\Skeleton\SkeletonClass
 */
class HtmlBlocksFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'html-blocks';
    }
}
