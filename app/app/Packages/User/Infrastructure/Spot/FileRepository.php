<?php


namespace App\Packages\User\Infrastructure\Spot;


use Illuminate\Support\Facades\Storage;

class FileRepository implements FileRepositoryInterface
{
    /**
     * @param $file
     * @param $spotCode
     * @return string
     */
    public function saveProfileImg($file, $spotCode) :string {
        return $this->saveInBaseDir($file, $spotCode, 'main');
    }

    /**
     * @param $file
     * @param $spotCode
     * @param $dirName
     * @return false|string|string[]
     */
    public function saveInBaseDir($file, $spotCode, $dirName)
    {
        $orgFileName = $file->getClientOriginalName();
        $storedPath = Storage::putFileAs("public/spot/${spotCode}/${dirName}", $file, $orgFileName);
        $storagePath = str_replace('public', 'storage', $storedPath);
        return $storagePath;
    }
}
