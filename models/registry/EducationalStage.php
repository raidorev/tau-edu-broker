<?php

namespace app\models\registry;

use app\components\helpers\i18n\TranslatableModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "educational_stage".
 *
 * @property int $id
 * @property string $name_ru
 * @property string|null $name_kk
 * @property string|null $name_en
 */
class EducationalStage extends ActiveRecord
{
    use TranslatableModelTrait;

    public static function tableName(): string
    {
        return 'educational_stage';
    }

    public static function find(): EducationalStageQuery
    {
        return new EducationalStageQuery(static::class);
    }

    public function rules(): array
    {
        return [
            [['name_ru'], 'required'],
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
