<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\registry\EducationalProgram */

$this->title = Yii::t('app', 'Изменить организацию образования');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Оргнизации образования'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>


<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
