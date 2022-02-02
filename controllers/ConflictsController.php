<?php

namespace app\controllers;

use app\models\entrant\Entrant;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ConflictsController extends Controller
{
    public function actionIndex()
    {
        $conflicts = [];
        foreach (Entrant::conflicts() as $conflict) {
            $entrantGroups = $conflict->getEntrants();
            foreach ($entrantGroups as $entrants) {
                $brokers = ArrayHelper::getColumn($entrants, 'createdBy');
                $uniqueBrokers = [];
                foreach ($brokers as $broker) {
                    $uniqueBrokers[$broker->id] = $broker;
                }
                $uniqueBrokers = array_values($uniqueBrokers);

                $conflicts[] = [
                    'reason' => $conflict->getReason(),
                    'entrants' => $entrants,
                    'brokers' => $uniqueBrokers,
                ];
            }
        }

        return $this->render('index', ['conflicts' => $conflicts]);
    }
}
