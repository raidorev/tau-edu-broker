<?php
/**
 * @var View $this
 */

use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Материалы маклера');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p class="lead">Тут должны быть материалы маклера</p>
