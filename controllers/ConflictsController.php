<?php

namespace app\controllers;

use app\models\conflict\Conflict;
use app\models\conflict\ConflictResolve;
use app\models\conflict\ConflictSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

    public function actionResolve(int $id)
    {
        $conflict = Conflict::findOne($id);
        if (!$conflict) {
            throw new NotFoundHttpException();
        }

        $conflictResolve = new ConflictResolve();
        $conflictResolve->conflict = $conflict;

        if (
            $conflictResolve->load($this->request->post()) &&
            $conflictResolve->validate()
        ) {
            $conflict->resolve(
                $conflictResolve->entrant,
                $conflictResolve->broker
            );
            return $this->redirect('index');
        }

        return $this->render('resolve', [
            'conflictResolve' => $conflictResolve,
        ]);
    }
}
