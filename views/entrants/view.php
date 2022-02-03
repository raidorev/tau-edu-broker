<?php
/**
 * @var View    $this
 * @var Entrant $model
 */

use app\components\helpers\ViewHelper;
use app\models\entrant\Entrant;
use kartik\detail\DetailView;
use yii\web\View;

$this->title = Yii::t('app', 'Просмотр абитуриента');
ViewHelper::addBreadcrumbs($this->title);
?>

<?= DetailView::widget([
    'model' => $model,
    'condensed' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    'enableEditMode' => false,
    'panel' => [
        'heading' => $model->fullName,
        'type' => DetailView::TYPE_PRIMARY,
    ],
    'attributes' => [
        'last_name',
        'first_name',
        'patronymic',
        [
            'attribute' => 'future_educational_program_id',
            'value' => $model->futureEducationalProgram->fullname,
        ],
        'phone_number',
        'email:email',
        [
            'attribute' => 'sex_id',
            'value' => $model->sex->name,
        ],
        'birthdate:date',
        [
            'attribute' => 'organization_id',
            'value' => $model->organization->name,
        ],
        [
            'attribute' => 'level_id',
            'value' => $model->level->name,
        ],
        'iin',
        [
            'attribute' => 'created_by',
            'value' => $model->createdBy->shortNameWithEmail,
        ],
        'status_id',
    ],
]) ?>
