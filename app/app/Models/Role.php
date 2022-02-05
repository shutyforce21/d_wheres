<?php


namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\RoleType as RoleEnum;

class Role extends SpatieRole
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotSuperAdministrator($query)
    {
        return $query->where('name', '<>', RoleEnum::SuperAdministrator);
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute(): string
    {
        $name = $this->name;
        $description = RoleEnum::getDescription($name);

        return $description !== '' ? $description : $name;
    }

    /**
     * @return bool
     */
    public function isSystemDefined(): bool
    {
        return RoleEnum::hasValue($this->name);
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->name === RoleEnum::Administrator;
    }

    /**
     * @return bool
     */
    public function isSuperAdministrator(): bool
    {
        return $this->name === RoleEnum::SuperAdministrator;
    }
}
