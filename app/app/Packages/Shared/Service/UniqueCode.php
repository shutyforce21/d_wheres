<?php


namespace App\Packages\Shared\Service;


use Illuminate\Support\Facades\DB;

class UniqueCode
{
    private function __construct(){}

    /**
     * @param $tableName
     * @param $fieldName
     * @return string
     * @throws \Exception
     */
    public static function create($tableName, $fieldName)
    {
        $self = new self();
        return $self->generateCode($tableName, $fieldName);
    }

    /**
     * @param $tableName
     * @param $fieldName
     * @return string
     * @throws \Exception
     */
    private function generateCode($tableName, $fieldName)
    {
        $code = uniqid();

        try {
            $result = DB::table("{$tableName}")->where($fieldName, $code)->exists();

        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage());
        }

        if ($result) {
            $this->generateCode($tableName, $fieldName);
        } else {
            return $code;
        }
    }
}
