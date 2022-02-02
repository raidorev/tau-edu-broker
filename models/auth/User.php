<?php

namespace app\models\auth;

use app\models\entrant\Entrant;
use mdm\admin\components\UserStatus;
use yii\bootstrap4\Html;
use yii\db\ActiveQuery;

/**
 * @property string                $first_name
 * @property string                $last_name
 * @property string                $patronymic
 *
 * @property-read string           $shortName
 * @property-read string           $shortNameWithEmail
 * @property-read AuthAssignment[] $authAssignments
 * @property-read Entrant[]        $entrants
 */
class User extends \mdm\admin\models\User
{
    public static function find(): UserQuery
    {
        return new UserQuery(static::class);
    }

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

    public function getAuthAssignments(): ActiveQuery
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

    public function getEntrants(): ActiveQuery
    {
        return $this->hasMany(Entrant::class, ['created_by' => 'id']);
    }

    public function getShortName(): string
    {
        $shortName = "$this->last_name ";
        $shortName .= mb_substr($this->first_name, 0, 1) . '.';

        if ($this->patronymic) {
            $shortName .= mb_substr($this->patronymic, 0, 1) . '.';
        }

        return $shortName;
    }

    public function getShortNameWithEmail(bool $mailto = false): string
    {
        if ($mailto) {
            $email = Html::mailto($this->email);
        } else {
            $email = $this->email;
        }

        return "$this->shortName ($email)";
    }
}
