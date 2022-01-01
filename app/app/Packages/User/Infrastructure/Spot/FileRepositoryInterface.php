<?php


namespace App\Packages\User\Infrastructure\Spot;


interface FileRepositoryInterface
{
    /**
     * @param $file
     * @param $spotCode
     * @return string
     */
    public function saveProfileImg($file, $spotCode);

    /**
     * @param $file
     * @param $spotCode
     * @param $dirName
     * @return false|string|string[]
     */
    public function saveInBaseDir($file, $spotCode, $dirName);
}
