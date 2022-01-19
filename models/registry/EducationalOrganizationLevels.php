<?php

namespace app\models\registry;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int                     $organization_id
 * @property int                     $level_id
 *
 * @property EducationLevel          $level
 * @property EducationalOrganization $organization
 */
class EducationalOrganizationLevels extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'educational_organization_levels';
    }

    public function rules(): array
    {
        return [
            [['organization_id', 'level_id'], 'required'],
            [['organization_id', 'level_id'], 'integer'],
            [['level_id'], 'unique'],
            [
                ['level_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => EducationLevel::class,
                'targetAttribute' => ['level_id' => 'id'],
            ],
            [
                ['organization_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => EducationalOrganization::class,
                'targetAttribute' => ['organization_id' => 'id'],
            ],
        ];
    }

    public function getLevel(): ActiveQuery
    {
        return $this->hasOne(EducationLevel::class, ['id' => 'level_id']);
    }

    public function getOrganization(): ActiveQuery
    {
        return $this->hasOne(EducationalOrganization::class, [
            'id' => 'organization_id',
        ]);
    }
}
