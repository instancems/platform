<?php

namespace InstanCeMS\Medialib\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for Media Uploader.
 * @author Sean Fraser <sean@plankdesign.com>
 */
class MediaUploader extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mediable.uploader';
    }
}
