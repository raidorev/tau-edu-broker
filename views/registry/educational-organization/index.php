<?php
/**
 * @var View $this
 * @var EducationalOrganizationSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\models\registry\EducationalOrganizationSearch;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use yii\data\ActiveDataProvider;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Оргинизации образования');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a(
        Yii::t('app', 'Добавить ораганизацию'),
        ['create'],
        ['class' => 'btn btn-primary']
    ) ?>
</p>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => SerialColumn::class],
        'name_ru',
        'name_kk',
        'name_en',
        [
            'class' => ActionColumn::class,
            'dropdown' => true,
            'template' => '{update}{delete}',
        ],
    ],
]) ?>

<?php Pjax::end(); ?>
