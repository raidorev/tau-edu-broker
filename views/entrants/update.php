<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\entrant\Entrant */

$this->title = Yii::t('app', 'Редактирование абитуриента: {name}', [
    'name' => "$model->last_name $model->first_name",
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Потенциальные абитуриенты'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = [
    'label' => $model->id,
    'url' => ['view', 'id' => $model->id],
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
