<?php


namespace App\Packages\User\Infrastructure\User;

use Illuminate\Support\Facades\Storage;

class FileRepository implements FileRepositoryInterface
{
    /**
     * @param $file
     * @param $userCode
     * @return string
     */
    public function saveProfileImg($file, $userCode) :string {
        return $this->saveInBaseDir($file, $userCode, 'profile');
    }

    /**
     * @param $file
     * @param $userCode
     * @param $dirName
     * @return false|string|string[]
     */
    public function saveInBaseDir($file, $userCode, $dirName)
    {
        $orgFileName = $file->getClientOriginalName();
        $storedPath = Storage::putFileAs("public/user/${userCode}/${dirName}", $file, $orgFileName);
        $storagePath = str_replace('public', 'storage', $storedPath);
        return $storagePath;
    }
}
