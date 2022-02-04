<?php

namespace app\models\conflict\detectors;

use app\models\entrant\Entrant;
use Yii;

class FullNameAndBirthdate extends BaseDetector
{
    public function getReason(): string
    {
        return Yii::t('app', 'Совпадение ФИО и даты рождения');
    }

    /**
     * @return Entrant[][]
     */
    public function getIntersections(): array
    {
        static $fields = ['first_name', 'last_name', 'patronymic', 'birthdate'];

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
