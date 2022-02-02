<?php

namespace app\models\auth;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string   $item_name
 * @property string   $user_id
 * @property int|null $created_at
 */
class AuthAssignment extends ActiveRecord
{
    public const BROKER = 'Маклер';
    public const MANAGER = 'Менеджер';
    public const ADMIN = 'Админ';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [
                ['item_name', 'user_id'],
                'unique',
                'targetAttribute' => ['item_name', 'user_id'],
            ],
        ];
    }
}
