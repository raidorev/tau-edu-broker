<?php

namespace app\models\entrant;

use yii\db\ActiveQuery;

/**
 * @see Entrant
 */
class EntrantQuery extends ActiveQuery
{
    public function filled(): EntrantQuery
    {
        $conditions = [];
        foreach (Entrant::STAGE_TWO_REQUIRED as $attribute) {
            $conditions[] = ['NOT', [$attribute => null]];
        }
        $conditions = array_merge(['AND'], $conditions);
        return $this->andOnCondition($conditions);
    }
}
