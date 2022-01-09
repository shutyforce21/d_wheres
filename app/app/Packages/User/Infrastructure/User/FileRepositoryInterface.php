<?php


namespace App\Packages\User\Infrastructure\User;


interface FileRepositoryInterface
{
    /**
     * @param $file
     * @param $userCode
     * @return string
     */
    public function updateImage($file, $userCode);

    /**
     * @param $file
     * @param $userCode
     * @return string
     */
    public function updateBackgroundImage($file, $userCode);

    /**
     * @param $file
     * @param $userCode
     * @param $dirName
     * @return false|string|string[]
     */
    public function saveInBaseDir($file, $userCode, $dirName);
}
