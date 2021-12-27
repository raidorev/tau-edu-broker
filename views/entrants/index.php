<?php

/**
 * @var View               $this
 * @var EntrantSearch      $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\models\entrant\Entrant;
use app\models\entrant\EntrantSearch;
use app\models\registry\EducationalProgram;
use app\models\registry\Sex;
use kartik\grid\ActionColumn;
use kartik\grid\BooleanColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Потенциальные абитуриенты');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a(
        Yii::t('app', 'Добавить абтуриента'),
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

        [
            'class' => BooleanColumn::class,
            'label' => Yii::t('app', 'Заполнен'),
            'attribute' => 'filled',
            'value' => static function (Entrant $model) {
                return $model->isFilled;
            },
            'trueLabel' => Yii::t('app', 'Да'),
            'falseLabel' => Yii::t('app', 'Нет'),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'options' => [
                    'placeholder' => Yii::t('app', 'Все'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'vAlign' => 'middle',
        ],
        'first_name',
        'last_name',
        'patronymic',
        [
            'attribute' => 'future_educational_program_id',
            'value' => 'futureEducationalProgram.code',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(
                EducationalProgram::find()->all(),
                'id',
                'code'
            ),
            'filterWidgetOptions' => [
                'options' => [
                    'placeholder' => Yii::t('app', 'Выберите ОП'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
        ],
        [
            'attribute' => 'sex_id',
            'value' => 'sex.name_ru',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Sex::find()->all(), 'id', 'name_ru'),
            'filterWidgetOptions' => [
                'options' => [
                    'placeholder' => Yii::t('app', 'Выберите пол'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
        ],

        [
            'class' => ActionColumn::class,
            'dropdown' => true,
            'template' => '{fill}{update}{delete}',
            'buttons' => [
                'fill' => static function (string $url, Entrant $model) {
                    if ($model->isFilled) {
                        return '';
                    }

                    return Html::a(
                        Icon::show('portrait') . Yii::t('app', 'Заполнить'),
                        $url,
                        [
                            'class' => ['dropdown-item'],
                            'title' => Yii::t('app', 'Заполнить'),
                            'aria' => [
                                'label' => Yii::t('app', 'Заполнить'),
                            ],
                            'data' => [
                                'pjax' => 0,
                            ],
                        ]
                    );
                },
            ],
        ],
    ],
]) ?>

<?php Pjax::end(); ?>
