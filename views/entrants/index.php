<?php

/**
 * @var View $this
 * @var EntrantSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\models\entrant\EntrantSearch;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
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
            'template' => '{update}{delete}',
        ],
    ],
]) ?>

<?php Pjax::end(); ?>
