<?php


namespace App\Services\Interfaces;


interface RedisService
{
    public function __construct();

    public function setKey1($value);

    public function getKey1();
}
