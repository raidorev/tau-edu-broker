<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\registry\EducationalProgram */

$this->title = Yii::t('app', 'Изменить ОП: {name}', [
    'name' => "$model->code $model->name_ru",
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Образовательные программы'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = [
    'label' => $model->code,
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
