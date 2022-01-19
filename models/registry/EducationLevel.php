<?php

namespace app\models\registry;

use app\components\helpers\i18n\TranslatableModelTrait;
use yii\db\ActiveRecord;

/**
 * @property int         $id
 * @property string      $name_ru
 * @property string|null $name_kk
 * @property string|null $name_en
 */
class EducationLevel extends ActiveRecord
{
    use TranslatableModelTrait;

    public static function tableName(): string
    {
        return 'education_level';
    }

    public function rules(): array
    {
        return [
            [['name_ru'], 'required'],
            [['name_ru', 'name_kk', 'name_en'], 'string', 'max' => 255],
            [['name_ru'], 'unique'],
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

    public static function find(): EducationLevelQuery
    {
        return new EducationLevelQuery(static::class);
    }
}
