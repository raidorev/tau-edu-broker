<?php

namespace app\models\conflict;

use app\models\entrant\Entrant;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int           $conflict_id
 * @property int           $entrant_id
 *
 * @property-read Conflict $conflict
 * @property-read Entrant  $entrant
 */
class ConflictMember extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'conflict_member';
    }

    public function rules(): array
    {
        return [
            [['conflict_id', 'entrant_id'], 'required'],
            [['conflict_id', 'entrant_id'], 'integer'],
            [
                ['conflict_id', 'entrant_id'],
                'unique',
                'targetAttribute' => ['conflict_id', 'entrant_id'],
            ],
            [
                ['conflict_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Conflict::class,
                'targetAttribute' => ['conflict_id' => 'id'],
            ],
            [
                ['entrant_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Entrant::class,
                'targetAttribute' => ['entrant_id' => 'id'],
            ],
        ];
    }

    public function getConflict(): ActiveQuery
    {
        return $this->hasOne(Conflict::class, ['id' => 'conflict_id']);
    }

    public function getEntrant(): ActiveQuery
    {
        return $this->hasOne(Entrant::class, ['id' => 'entrant_id']);
    }

    public static function find(): ConflictMemberQuery
    {
        return new ConflictMemberQuery(static::class);
    }
}
