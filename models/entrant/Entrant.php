<?php

namespace app\models\entrant;

use app\models\registry\EducationalProgram;
use app\models\registry\EducationalStage;
use app\models\registry\Sex;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $patronymic
 * @property int $future_educational_stage_id
 * @property int $future_educational_program_id
 * @property string $phone_number
 * @property string|null $email
 * @property int|null $sex_id
 * @property string|null $birthdate
 */
class Entrant extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'entrant';
    }

    public function rules(): array
    {
        return [
            [
                [
                    'first_name',
                    'last_name',
                    'future_educational_stage_id',
                    'future_educational_program_id',
                    'phone_number',
                ],
                'required',
            ],
            [
                [
                    'future_educational_stage_id',
                    'future_educational_program_id',
                    'sex_id',
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
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'future_educational_stage_id' => Yii::t(
                'app',
                'Будущий уровень образования'
            ),
            'future_educational_program_id' => Yii::t('app', 'Будущая ОП'),
            'phone_number' => Yii::t('app', 'Контактный номер телефона'),
            'email' => Yii::t('app', 'Email'),
            'sex_id' => Yii::t('app', 'Пол'),
            'birthdate' => Yii::t('app', 'Дата рождения'),
        ];
    }

    public function getFutureEducatoinalStage(): ActiveQuery
    {
        return $this->hasOne(EducationalStage::class, [
            'id' => 'future_educational_stage_id',
        ]);
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
}
