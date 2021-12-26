<?php

namespace app\models\registry;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name_ru
 * @property string $name_kk
 * @property string $name_en
 */
class Sex extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'sex';
    }

    public function rules(): array
    {
        return [
            [['name_ru', 'name_kk', 'name_en'], 'required'],
            [['name_ru', 'name_kk', 'name_en'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name_ru' => 'Name Ru',
            'name_kk' => 'Name Kk',
            'name_en' => 'Name En',
        ];
    }
}
