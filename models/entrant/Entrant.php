<?php

namespace app\models\entrant;

use app\models\auth\User;
use app\models\registry\EducationalOrganization;
use app\models\registry\EducationalProgram;
use app\models\registry\EducationalStage;
use app\models\registry\EducationLevel;
use app\models\registry\Sex;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int                          $id
 * @property string                       $first_name
 * @property string                       $last_name
 * @property string|null                  $patronymic
 * @property int                          $future_educational_program_id
 * @property string                       $phone_number
 * @property string|null                  $email
 * @property int|null                     $sex_id
 * @property string|null                  $birthdate
 * @property int|null                     $level_id
 * @property int|null                     $organization_id
 * @property string|null                  $iin
 * @property int                          $created_by
 *
 * @property-read EducationalStage        $futureEducationalStage
 * @property-read Sex                     $sex
 * @property-read bool                    $isFilled
 * @property-read EducationalProgram      $futureEducationalProgram
 * @property-read EducationLevel          $level
 * @property-read EducationalOrganization $organization
 * @property-read User                    $createdBy
 */
class Entrant extends ActiveRecord
{
    public const SCENARIO_STAGE_ONE = 'STAGE_ONE';
    public const SCENARIO_STAGE_TWO = 'STAGE_TWO';

    public const STAGE_ONE_REQUIRED = [
        'first_name',
        'last_name',
        'future_educational_program_id',
        'phone_number',
    ];
    public const STAGE_TWO_REQUIRED = [
        'first_name',
        'last_name',
        'future_educational_program_id',
        'phone_number',
        'email',
        'sex_id',
        'birthdate',
        'organization_id',
        'level_id',
        'iin',
    ];

    public function scenarios(): array
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_STAGE_ONE] = array_keys($this->attributes);
        $scenarios[self::SCENARIO_STAGE_TWO] = array_keys($this->attributes);

        return $scenarios;
    }

    public static function tableName(): string
    {
        return 'entrant';
    }

    public function rules(): array
    {
        return [
            [self::STAGE_ONE_REQUIRED, 'required'],
            [
                self::STAGE_TWO_REQUIRED,
                'required',
                'on' => self::SCENARIO_STAGE_TWO,
            ],
            [
                [
                    'future_educational_program_id',
                    'sex_id',
                    'level_id',
                    'organization_id',
                    'created_by',
                ],
                'integer',
            ],
            [['birthdate'], 'safe'],
            [
                ['first_name', 'last_name', 'patronymic', 'email'],
                'string',
                'max' => 50,
            ],
            [['phone_number'], 'string', 'max' => 20],
            [['iin'], 'string', 'max' => 25],
        ];
    }

    public function beforeSave($insert): bool
    {
        if ($insert) {
            $this->created_by = Yii::$app->user->id;
        }

        return parent::beforeSave($insert);
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'future_educational_program_id' => Yii::t('app', 'Будущая ОП'),
            'phone_number' => Yii::t('app', 'Контактный номер телефона'),
            'email' => Yii::t('app', 'Email'),
            'sex_id' => Yii::t('app', 'Пол'),
            'birthdate' => Yii::t('app', 'Дата рождения'),
            'organization_id' => Yii::t('app', 'Организация образования'),
            'level_id' => Yii::t('app', 'Последний уровень образования'),
            'iin' => Yii::t('app', 'ИИН'),
            'created_by' => Yii::t('app', 'Маклер'),
        ];
    }

    public function getFutureEducationalStage(): ActiveQuery
    {
        return $this->hasOne(EducationalStage::class, [
            'id' => 'future_educational_stage_id',
        ])->via('futureEducationalProgram');
    }

    public function getFutureEducationalProgram(): ActiveQuery
    {
        return $this->hasOne(EducationalProgram::class, [
            'id' => 'future_educational_program_id',
        ]);
    }

    public function getSex(): ActiveQuery
    {
        return $this->hasOne(Sex::class, ['id' => 'sex_id']);
    }

    public function getOrganization(): ActiveQuery
    {
        return $this->hasOne(EducationalOrganization::class, [
            'id' => 'organization_id',
        ]);
    }

    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getIsFilled(): bool
    {
        $oldScenario = $this->scenario;
        $this->scenario = self::SCENARIO_STAGE_TWO;
        $isValid = $this->validate();
        $this->clearErrors();
        $this->scenario = $oldScenario;

        return $isValid;
    }
}
