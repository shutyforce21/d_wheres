<?php


namespace App\Packages\User\Domain\Spot\DataAccessInterface;


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
