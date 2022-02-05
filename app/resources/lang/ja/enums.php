<?php

use App\Enums\RoleType;
use \App\Enums\PermissionType;

return [

    RoleType::class => [
        RoleType::Administrator => '管理者',
        RoleType::SuperAdministrator => '総合管理者',
    ],

    PermissionType::class => [
        // Spots
        PermissionType::ReadSpots => 'スポットの閲覧',
        PermissionType::EditSpots => 'スポットの作成・編集',
        PermissionType::ActivateSpots => 'スポットの有効化',
        PermissionType::InActivateSpots => 'スポットの無効化',
        PermissionType::DeleteSpots => 'スポットの削除',

        // Users
        PermissionType::ReadUsers => 'ユーザーの閲覧',
        PermissionType::EditUsers => 'ユーザーの編集',
        PermissionType::DeleteUsers => 'ユーザーの削除',
    ],
];
