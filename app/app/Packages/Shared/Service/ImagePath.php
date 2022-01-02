<?php


namespace App\Packages\Shared\Service;


class ImagePath
{
    /**
     * @param $storagePath
     * @return string
     */
    public static function getAbsolutePath($storagePath)
    {
        $rootPath = config('app.url');
        return $rootPath . "/" . $storagePath;
    }

}
