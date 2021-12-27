<?php

/**
 * @var View               $this
 * @var EntrantSearch      $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\models\entrant\Entrant;
use app\models\entrant\EntrantSearch;
use kartik\grid\ActionColumn;
use kartik\grid\BooleanColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
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
            'value' => static function (Entrant $model) {
                return $model->isFilled;
            },
        ],
        'first_name',
        'last_name',
        'patronymic',
        [
            'attribute' => 'future_educational_program_id',
            'value' => 'futureEducationalProgram.code',
        ],
        [
            'attribute' => 'sex_id',
            'value' => 'sex.name_ru',
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
