<?php

namespace app\packages;

class Tmp {

    protected $nameList = ['巨人', '阪神', '中日', 'ヤクルト', 'DNA', '広島'];

    public function __construct()
    {
        $this->nameList[] = $nameList;
        $this->winner = $this->nameList[mt_rand(0, 5)];
        $this->looser = $this->nameList[mt_rand(0, 5)];
    }

    public function pennant()
    {
        echo "今年のペナントレースの順位は？\n";

        echo "1位は" . $this->winner . "\n";

        echo "最下位は" . $this->looser . "\n";
    }
}

?>