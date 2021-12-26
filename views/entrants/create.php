<?php
/**
 * @var View $this
 * @var Entrant $model
 */

use app\models\entrant\Entrant;
use yii\helpers\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Добавить абитуриента');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Потенциальные абитуриенты'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
