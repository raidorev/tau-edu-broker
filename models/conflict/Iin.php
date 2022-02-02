<?php

namespace app\models\conflict;

use app\models\entrant\Entrant;
use Yii;

class Iin implements Conflict
{
    public function getReason(): string
    {
        return Yii::t('app', 'Совпадение ИИН');
    }

    /**
     * @return Entrant[]
     */
    public function getEntrants(): array
    {
        $fields = ['iin'];

        $intersections = Entrant::find()
            ->filled()
            ->select($fields)
            ->groupBy($fields)
            ->having('COUNT(*) > 1')
            ->asArray()
            ->all();

        if (empty($intersections)) {
            return [];
        }

        $entrants = [];
        foreach ($intersections as $intersection) {
            $condition = [];
            foreach ($fields as $field) {
                $condition[$field][] = $intersection[$field];
            }

            $entrants[] = Entrant::findAll($condition);
        }

        return $entrants;
    }
}
