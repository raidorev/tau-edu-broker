<?php

namespace app\models\auth;

use mdm\admin\components\UserStatus;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 */
class User extends \mdm\admin\models\User
{
    public static function findByEmail(string $email): ?User
    {
        return static::findOne([
            'email' => $email,
            'status' => UserStatus::ACTIVE,
        ]);
    }

    public static function findByUsername($username): ?User
    {
        return static::findOne([
            'email' => $username,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
