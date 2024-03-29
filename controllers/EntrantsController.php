<?php

namespace app\controllers;

use app\models\entrant\Entrant;
use app\models\entrant\EntrantSearch;
use app\models\registry\EducationalOrganization;
use kartik\depdrop\DepDropAction;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * EntrantsController implements the CRUD actions for Entrant model.
 */
class EntrantsController extends Controller
{
    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    public function actions(): array
    {
        return ArrayHelper::merge(parent::actions(), [
            'organizations' => [
                'class' => DepDropAction::class,
                'outputCallback' => function ($selectedId, $params) {
                    return EducationalOrganization::find()
                        ->joinWith('educationalOrganizationLevels l')
                        ->where(['l.level_id' => $selectedId])
                        ->depDropList();
                },
            ],
        ]);
    }

    /**
     * Lists all Entrant models.
     */
    public function actionIndex()
    {
        $searchModel = new EntrantSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Entrant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Entrant();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionChangeStatus(int $id)
    {
        $entrant = $this->findModel($id);
        $entrant->scenario = Entrant::SCENARIO_STATUS_CHANGE;

        if ($entrant->load($this->request->post()) && $entrant->save()) {
            Yii::$app->session->addFlash(
                'success',
                Yii::t('app', 'Статус успешно изменен')
            );
            return $this->redirect('index');
        }

        return $this->render('approve', ['entrant' => $entrant]);
    }

    /**
     * @param int $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    /**
     * Updates an existing Entrant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id ID
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id, bool $fill = false)
    {
        $model = $this->findModel($id);
        $model->scenario = $fill
            ? Entrant::SCENARIO_STAGE_TWO
            : Entrant::SCENARIO_STAGE_ONE;

        if ($model->isFilled) {
            $model->scenario = Entrant::SCENARIO_STAGE_TWO;
        }

        if (
            $this->request->isPost &&
            $model->load($this->request->post()) &&
            $model->save()
        ) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionFill(int $id)
    {
        $this->redirect(['update', 'id' => $id, 'fill' => true]);
    }

    /**
     * Deletes an existing Entrant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id ID
     *
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Entrant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     *
     * @return Entrant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = Entrant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            Yii::t('app', 'The requested page does not exist.')
        );
    }
}
