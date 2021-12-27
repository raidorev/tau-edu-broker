<?php

namespace app\controllers;

use yii\web\Controller;

class MaterialsController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
