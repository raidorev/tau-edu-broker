<?php

namespace app\models\entrant;

use app\components\helpers\i18n\TranslatableModelTrait;
use yii\db\ActiveRecord;

/**
 * @property int         $id
 * @property string      $name_ru
 * @property string|null $name_kk
 * @property string|null $name_en
 *
 * @property-read string $name
 */
class EntrantStatus extends ActiveRecord
{
    use TranslatableModelTrait;

    const REJECTED = 4;

    public static function tableName(): string
    {
        return 'entrant_status';
    }

    public function rules(): array
    {
        return [
            [['name_ru'], 'required'],
            [['name_ru', 'name_kk', 'name_en'], 'string', 'max' => 50],
        ];
    }

    public static function find(): EntrantStatusQuery
    {
        return new EntrantStatusQuery(static::class);
    }
}
