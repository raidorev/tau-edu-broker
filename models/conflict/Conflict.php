<?php

namespace app\models\conflict;

use app\models\auth\User;
use app\models\conflict\detectors\ConflictDetector;
use app\models\conflict\detectors\FullNameAndBirthdate;
use app\models\conflict\detectors\Iin;
use app\models\entrant\Entrant;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int                 $id
 * @property int                 $status_id
 * @property string              $reason
 *
 * @property-read Entrant[]      $entrants
 * @property-read ConflictMember $members
 * @property-read ConflictStatus $status
 */
class Conflict extends ActiveRecord
{
    /**
     * @return ConflictDetector[]
     */
    public static function detectors(): array
    {
        return [new Iin(), new FullNameAndBirthdate()];
    }

    public static function tableName(): string
    {
        return 'conflict';
    }

    public function rules(): array
    {
        return [
            [['status_id', 'reason'], 'required'],
            [['status_id'], 'integer'],
            [['reason'], 'string', 'max' => 255],
            [
                ['status_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ConflictStatus::class,
                'targetAttribute' => ['status_id' => 'id'],
            ],
        ];
    }

    public function getMembers(): ActiveQuery
    {
        return $this->hasMany(ConflictMember::class, ['conflict_id' => 'id']);
    }

    public function getEntrants(): ActiveQuery
    {
        return $this->hasMany(Entrant::class, ['id' => 'entrant_id'])->via(
            'members'
        );
    }

    public function getBrokers(): ActiveQuery
    {
        return $this->hasMany(User::class, ['id' => 'created_by'])->via(
            'entrants'
        );
    }

    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(ConflictStatus::class, [
            'id' => 'status_id',
        ]);
    }

    public static function find(): ConflictQuery
    {
        return new ConflictQuery(static::class);
    }
}
