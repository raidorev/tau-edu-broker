<?php
/**
 * @var View $this
 * @var EducationalProgram $model
 */

use app\models\registry\EducationalProgram;
use yii\helpers\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Добавить организацию образования');
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
