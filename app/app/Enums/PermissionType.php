<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

class PermissionType extends Enum
{
    // Spots
    public const ReadSpots = 'read_spots';
    public const EditSpots = 'edit_spots';
    public const ActivateSpots = 'activate_spots';
    public const InActivateSpots = 'inactivate_spots';
    public const DeleteSpots = 'delete_spots';

    // Users
    public const ReadUsers = 'read_users';
    public const EditUsers = 'edit_users';
    public const DeleteUsers = 'delete_users';

}
