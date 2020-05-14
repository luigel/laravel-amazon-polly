<?php

namespace Luigel\AmazonPolly\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Luigel\AmazonPolly\Skeleton\SkeletonClass
 */
class AmazonPolly extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'amazon-polly';
    }
}
