<?php

namespace app\models\registry;

use app\components\helpers\i18n\TranslatableModelTrait;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int                                  $id
 * @property string                               $name_ru
 * @property string|null                          $name_kk
 * @property string|null                          $name_en
 *
 * @property-read string                          $name
 *
 * @property-read EducationLevel[]                $levels
 * @property-read EducationalOrganizationLevels[] $educationalOrganizationLevels
 */
class EducationalOrganization extends ActiveRecord
{
    use TranslatableModelTrait;

    public static function tableName(): string
    {
        return 'educational_organization';
    }

    const SCENARIO_CREATE = 'create';

    public function scenarios(): array
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = ['name_ru', 'levels'];

        return $scenarios;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->levels = array_unique(
            ArrayHelper::getColumn(
                $this->educationalOrganizationLevels,
                'level_id'
            )
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        EducationalOrganizationLevels::deleteAll([
            'organization_id' => $this->id,
        ]);

        foreach ($this->levels as $levelId) {
            $organizationLevel = new EducationalOrganizationLevels();
            $organizationLevel->organization_id = $this->id;
            $organizationLevel->level_id = $levelId;
            if (!$organizationLevel->save()) {
                dd($organizationLevel->errors);
            }
        }
    }

    /** @var null|array */
    public $levels = null;

    public function rules(): array
    {
        return [
            [['name_ru'], 'required'],
            [['levels'], 'required', 'on' => self::SCENARIO_CREATE],
            [['name_ru', 'name_kk', 'name_en'], 'string', 'max' => 255],
            [['name_ru'], 'unique'],
            [['levels'], 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name_ru' => Yii::t('app', 'Наименование (рус.)'),
            'name_kk' => Yii::t('app', 'Наименование (каз.)'),
            'name_en' => Yii::t('app', 'Наименование (анг.)'),
            'levels' => Yii::t('app', 'Уровни образования'),
        ];
    }

    public function getEducationalOrganizationLevels(): ActiveQuery
    {
        return $this->hasMany(EducationalOrganizationLevels::class, [
            'organization_id' => 'id',
        ]);
    }

    public static function find(): EducationalOrganizationQuery
    {
        return new EducationalOrganizationQuery(static::class);
    }
}
