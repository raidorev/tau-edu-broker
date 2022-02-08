<?php

namespace app\models\conflict;

use yii\base\Model;

class ConflictResolve extends Model
{
    /** @var Conflict */
    public $conflict;

    /** @var integer */
    public $entrant;
    /** @var integer */
    public $broker;

    public function rules(): array
    {
        return [
            [['entrant', 'broker'], 'required'],
            [['entrant', 'broker'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'entrant' => 'Выберите абитуриента',
            'broker' => 'Выберите маклера',
        ];
    }
}
