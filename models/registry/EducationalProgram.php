<?php

namespace app\models\registry;

use app\components\helpers\i18n\TranslatableModelTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $code
 * @property string $name_ru
 * @property string|null $name_kk
 * @property string|null $name_en
 *
 * @property-read string $name
 * @property-read string $fullname
 */
class EducationalProgram extends ActiveRecord
{
    use TranslatableModelTrait;

    public static function tableName(): string
    {
        return 'educational_program';
    }

    public static function find(): EducationalProgramQuery
    {
        return new EducationalProgramQuery(static::class);
    }

    public function rules(): array
    {
        return [
            [['code', 'name_ru'], 'required'],
            [['code'], 'string', 'max' => 20],
            [['name_ru', 'name_kk', 'name_en'], 'string', 'max' => 50],
            [['code'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'code' => Yii::t('app', 'Шифр'),
            'name_ru' => Yii::t('app', 'Наименование (рус.)'),
            'name_kk' => Yii::t('app', 'Наименование (каз.)'),
            'name_en' => Yii::t('app', 'Наименование (анг.)'),
        ];
    }

    public function getFullname()
    {
        return "$this->code «{$this->name}»";
    }
}
