<?php


namespace App\Packages\User\Infrastructure\User;


interface FileRepositoryInterface
{
    /**
     * @param $file
     * @param $userCode
     * @return string
     */
    public function saveProfileImg($file, $userCode);

    /**
     * @param $file
     * @param $userCode
     * @param $dirName
     * @return false|string|string[]
     */
    public function saveInBaseDir($file, $userCode, $dirName);
}
