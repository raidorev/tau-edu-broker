<?php

/**
 * @var View               $this
 * @var EntrantSearch      $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\models\auth\AuthAssignment;
use app\models\auth\User;
use app\models\entrant\Entrant;
use app\models\entrant\EntrantSearch;
use app\models\entrant\EntrantStatus;
use app\models\registry\EducationalProgram;
use app\models\registry\Sex;
use kartik\export\ExportMenu;
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

$gridColumns = [
    ['class' => SerialColumn::class],

    [
        'class' => BooleanColumn::class,
        'label' => Yii::t('app', 'Заполнен'),
        'attribute' => 'filled',
        'value' => 'isFilled',
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

    [
        'visible' => Yii::$app->user->can(AuthAssignment::MANAGER),
        'attribute' => 'created_by',
        'format' => 'raw',
        'value' => static function (Entrant $entrant) {
            return $entrant->createdBy->getShortNameWithEmail(true);
        },
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
            ],
        ],
    ],

    'first_name',

    'last_name',

    'patronymic',

    [
        'attribute' => 'future_educational_program_id',
        'value' => 'futureEducationalProgram.code',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => EducationalProgram::find()->selectList(),
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
        'value' => 'sex.name',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => Sex::find()->selectList(),
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
        // TODO: Фильтр по инревалу
        'attribute' => 'created_at',
        'label' => Yii::t('app', 'Создан'),
        'value' => static function (Entrant $entrant) {
            // TODO: Русская и казахская локаль
            return (new DateTime($entrant->created_at))->format('d M Y');
        },
    ],

    [
        'attribute' => 'status_id',
        'label' => Yii::t('app', 'Статус'),
        'value' => 'status.name',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => EntrantStatus::find()->selectList(
            Yii::t('app', 'Не подтвержен')
        ),
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
        'template' => '{fill}{update}{delete}{change-status}',
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
            'change-status' => static function (string $url, Entrant $model) {
                if (
                    !Yii::$app->user->can('Подтверждение абитуриентов') ||
                    !$model->isFilled
                ) {
                    return '';
                }

                return Html::a(
                    Icon::show('graduation-cap') .
                        Yii::t('app', 'Изменить статус'),
                    $url,
                    [
                        'class' => ['dropdown-item'],
                        'title' => Yii::t('app', 'Изменить статус'),
                        'aria' => [
                            'label' => Yii::t('app', 'Изменить статус'),
                        ],
                        'data' => [
                            'pjax' => 0,
                        ],
                    ]
                );
            },
        ],
    ],
];

$dropdownHeader = Yii::t('app', 'Выгрузить все данные');

$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'pjaxContainerId' => 'kv-pjax-container',
    'exportContainer' => [
        'class' => 'btn-group mr-2',
    ],
    'dropdownOptions' => [
        'label' => Yii::t('app', 'Выгрузить'),
        'class' => 'btn btn-outline-secondary btn-default',
        'itemsBefore' => ["<div class='dropdown-header'>$dropdownHeader</div>"],
    ],
    'exportConfig' => [
        ExportMenu::FORMAT_HTML => false,
        ExportMenu::FORMAT_CSV => false,
        ExportMenu::FORMAT_TEXT => false,
        ExportMenu::FORMAT_EXCEL => false,
        ExportMenu::FORMAT_PDF => [
            'label' => Yii::t('kvexport', 'PDF'),
            'icon' => 'far fa-file-pdf',
            'iconOptions' => ['class' => 'text-danger'],
            'linkOptions' => [],
            'options' => [
                'title' => Yii::t('kvexport', 'Portable Document Format'),
            ],
            'alertMsg' => false,
            'mime' => 'application/pdf',
            'extension' => 'pdf',
            'writer' => 'KrajeePdf', // custom Krajee PDF writer using MPdf library
            'useInlineCss' => true,
            'pdfConfig' => [],
        ],
        ExportMenu::FORMAT_EXCEL_X => [
            'label' => Yii::t('kvexport', 'Excel 2007+'),
            'icon' => 'fas fa-file-excel',
            'iconOptions' => ['class' => 'text-success'],
            'linkOptions' => [],
            'options' => [
                'title' => Yii::t('kvexport', 'Microsoft Excel 2007+ (xlsx)'),
            ],
            'alertMsg' => false,
            'mime' =>
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'extension' => 'xlsx',
            'writer' => ExportMenu::FORMAT_EXCEL_X,
        ],
    ],
]);
?>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'responsive' => true,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'panel' => [
        'heading' =>
            Icon::show('user') . ' ' . Yii::t('app', 'Список абитуриентов'),
        'type' => 'primary',
        'after' => false,
    ],
    'toolbar' => [
        $fullExportMenu,
        [
            'content' =>
                Html::a(
                    Icon::show('plus'),
                    ['create'],
                    [
                        'class' => 'btn btn-primary',
                        'title' => Yii::t('app', 'Добавить абитуриента'),
                    ]
                ) .
                Html::a(
                    '<i class="fas fa-redo"></i>',
                    ['grid-demo'],
                    [
                        'class' => 'btn btn-outline-secondary btn-default',
                        'title' => Yii::t('kvgrid', 'Reset Grid'),
                        'data-pjax' => 0,
                    ]
                ),
            'options' => ['class' => 'btn-group'],
        ],
    ],
    'toggleDataOptions' => ['minCount' => 10],
    'columns' => $gridColumns,
]) ?>

<?php Pjax::end(); ?>
