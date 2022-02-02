<?php


namespace App\Http\Controllers\Admin;


class SpotController
{
    /**
     * 一覧
     * @return string
     */
    public function index()
    {
        $spots = [1,2,3,4,5];
        return view('admin.spot.index')->with(["spots" => $spots]);
    }

    /**
     * 有効化
     * @return string
     */
    public function activate()
    {
        return 'asdf';
    }

    /**
     * 無効化
     * @return string
     */
    public function inactivate()
    {
        return 'asdf';
    }
}
