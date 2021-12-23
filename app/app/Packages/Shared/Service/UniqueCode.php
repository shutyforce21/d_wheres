<?php


namespace App\Packages\Shared\Service;


use Illuminate\Support\Facades\DB;

class UniqueCode
{
    private function __construct(){}

    /**
     * @param $tableName
     * @return string
     */
    public static function create($tableName)
    {
        $self = new self();
        return $self->generateCode($tableName);
    }

    /**
     * @param $tableName
     * @return string
     */
    private function generateCode($tableName)
    {
        $code = uniqid();

        try {
            $result = DB::table("{$tableName}")->where('code', $code)->exists();

        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage());
        }

        if ($result) {
            $this->generateCode($tableName);
        } else {
            return $code;
        }
    }
}
