<?php

namespace app\models\conflict;

use app\components\helpers\i18n\TranslatableModelTrait;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int             $id
 * @property string          $name_ru
 * @property string|null     $name_kk
 * @property string|null     $name_en
 *
 * @property-read Conflict[] $conflicts
 */
class ConflictStatus extends ActiveRecord
{
    const OPEN = 1;
    const RESOLVED = 2;

    use TranslatableModelTrait;

    public static function tableName(): string
    {
        return 'conflict_status';
    }

    public function rules(): array
    {
        return [
            [['name_ru'], 'required'],
            [['name_ru', 'name_kk', 'name_en'], 'string', 'max' => 50],
        ];
    }

    public function getConflicts(): ActiveQuery
    {
        return $this->hasMany(Conflict::class, ['status_id' => 'id']);
    }

    public static function find(): ConflictStatusQuery
    {
        return new ConflictStatusQuery(static::class);
    }
}
