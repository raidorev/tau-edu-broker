<?php
/**
 * @var View               $this
 * @var ConflictSearch     $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\components\helpers\ListHelper;
use app\models\auth\User;
use app\models\conflict\Conflict;
use app\models\conflict\ConflictSearch;
use app\models\conflict\ConflictStatus;
use app\models\entrant\Entrant;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'responsive' => true,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'panel' => [
        'heading' => Icon::show('gavel') . ' ' . Yii::t('app', 'Конфликты'),
        'type' => 'primary',
        'footer' => false,
        'after' => false,
    ],
    'toolbar' => [
        [
            'content' => Html::a(Icon::show('sync-alt'), Url::to(['update']), [
                'class' => ['btn', 'btn-outline-primary'],
                'title' => Yii::t('app', 'Обновить список конфликтов'),
                'aria' => [
                    'label' => Yii::t('app', 'Обновить список конфликтов'),
                ],
            ]),
            'options' => ['class' => 'btn-group mr-2'],
        ],
        '{toggleData}',
    ],
    'toggleDataOptions' => ['minCount' => 10],
    'columns' => [
        ['class' => SerialColumn::class],

        [
            'attribute' => 'membersIds',
            'label' => Yii::t('app', 'Абитуриенты'),
            'value' => static function (Conflict $conflict) {
                $content = Html::beginTag('div', ['class' => ['list-group']]);
                foreach ($conflict->entrants as $entrant) {
                    $content .= Html::tag('div', $entrant->shortName, [
                        'class' => ['list-group-item'],
                    ]);
                }
                $content .= Html::endTag('div');

                return $content;
            },
            'format' => 'raw',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ListHelper::toSelectList(
                Entrant::find()->all(),
                'id',
                'fullName'
            ),
            'filterWidgetOptions' => [
                'options' => [
                    'placeholder' => Yii::t('app', 'Выберите маклера'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
        ],

        [
            'attribute' => 'brokerIds',
            'label' => Yii::t('app', 'Маклеры'),
            'value' => static function (Conflict $conflict) {
                $brokers = ArrayHelper::getColumn(
                    $conflict->entrants,
                    'createdBy'
                );

                /** @var User[] $uniqueBrokers */
                $uniqueBrokers = [];
                foreach ($brokers as $broker) {
                    $uniqueBrokers[$broker->id] = $broker;
                }
                $uniqueBrokers = array_values($uniqueBrokers);

                $content = Html::beginTag('div', ['class' => ['list-group']]);
                foreach ($uniqueBrokers as $broker) {
                    $content .= Html::tag('div', $broker->shortNameWithEmail, [
                        'class' => ['list-group-item'],
                    ]);
                }
                $content .= Html::endTag('div');

                return $content;
            },
            'format' => 'raw',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => User::find()
                ->innerJoinWith('entrants')
                ->selectList(),
            'filterWidgetOptions' => [
                'options' => [
                    'placeholder' => Yii::t('app', 'Выберите маклера'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    // 'multiple' => true,
                ],
            ],
        ],

        [
            'attribute' => 'status_id',
            'label' => Yii::t('app', 'Статус'),
            'value' => 'status.name',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ConflictStatus::find()->selectList(),
            'filterWidgetOptions' => [
                'options' => [
                    'placeholder' => Yii::t('app', 'Выберите статус'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
        ],

        [
            'class' => ActionColumn::class,
            'dropdown' => true,
            'template' => '{resolve}',
            'buttons' => [
                'resolve' => static function (string $url, Conflict $model) {
                    if ($model->status_id === ConflictStatus::RESOLVED) {
                        return '';
                    }

                    return Html::a(
                        Icon::show('gavel') . Yii::t('app', 'Решить'),
                        $url,
                        [
                            'class' => ['dropdown-item'],
                            'title' => Yii::t('app', 'Решить'),
                            'aria' => [
                                'label' => Yii::t('app', 'Решить'),
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
