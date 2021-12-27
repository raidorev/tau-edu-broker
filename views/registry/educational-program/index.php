<?php
/**
 * @var View $this
 * @var EducationalProgramSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\models\registry\EducationalProgramSearch;
use app\models\registry\EducationalStage;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use yii\data\ActiveDataProvider;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Образовательные программы');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a(
        Yii::t('app', 'Добавить образовательную программу'),
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
        'code',
        [
            'attribute' => 'educational_stage_id',
            'value' => 'educationalStage.name',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => EducationalStage::find()->selectList(),
            'filterWidgetOptions' => [
                'options' => [
                    'placeholder' => Yii::t('app', 'Все'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
        ],
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
