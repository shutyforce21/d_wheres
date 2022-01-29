<?php

namespace App\Packages\User\Infrastructure\User;

use App\Packages\User\Domain\User\DataAccessInterface\FileRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class FileRepository implements FileRepositoryInterface
{
    const BASE_DIR_NAME = "public/user/";

    /**
     * @param $file
     * @param $userCode
     * @return string|null
     */
    public function updateImage($file, $userCode)
    {
        $dirName = 'profile/image';
        return $this->saveInBaseDir($file, $userCode,$dirName);
    }

    /**
     * @param $file
     * @param $userCode
     * @return string|null
     */
    public function updateBackgroundImage($file, $userCode)
    {
        $dirName = 'profile/background';
        return $this->saveInBaseDir($file, $userCode,$dirName);
    }


    /**
     * @param $userCode
     * @param $dirName
     * @return bool
     */
    protected function exists($userCode, $dirName)
    {
        //ディレクトリ下にファイルが存在するか
        $fileExists = Storage::files(self::BASE_DIR_NAME."{$userCode}/$dirName") ? true: false;
        return $fileExists;
    }

    /**
     * @param $userCode
     * @param $dirName
     */
    protected function delete($userCode, $dirName)
    {
        //　既存ファイルが存在すれば削除or無ければスルー
        if ($this->exists($userCode, $dirName)) {
            Storage::deleteDirectory(self::BASE_DIR_NAME."{$userCode}/$dirName");
        }
    }

    /**
     * @param $file
     * @param $userCode
     * @param $dirName
     * @return string|null
     */
    public function saveInBaseDir($file, $userCode, $dirName)
    {
        //nullで既存ファイルが存在すれば削除
        if ($file === null) {
            $this->delete($userCode, $dirName);
            return null;

            //objectであれば更新
        } else {
            $this->delete($userCode, $dirName);
            $orgFileName = $file->getClientOriginalName();
            $storedPath = Storage::putFileAs(self::BASE_DIR_NAME."${userCode}/${dirName}", $file, $orgFileName);
            $storagePath = str_replace('public', 'storage', $storedPath);
            return $storagePath;
        }
    }
}
