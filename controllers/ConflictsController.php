<?php

namespace app\controllers;

use app\models\conflict\Conflict;
use app\models\conflict\ConflictSearch;
use yii\web\Controller;

class ConflictsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ConflictSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate()
    {
        foreach (Conflict::detectors() as $detector) {
            $detector->createConflicts();
        }

        return $this->redirect(['index']);
    }
}
