<?php
/**
 * @var View $this
 * @var EducationalProgram $model
 */

use app\models\registry\EducationalProgram;
use yii\helpers\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Добавить образовательную программу');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Образовательные программы'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
