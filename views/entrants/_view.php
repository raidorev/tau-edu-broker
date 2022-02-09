<?php
/**
 * @var View    $this
 * @var Entrant $entrant
 */

use app\models\entrant\Entrant;
use kartik\detail\DetailView;
use yii\web\View;
?>
<?= DetailView::widget([
    'model' => $entrant,
    'condensed' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    'enableEditMode' => false,
    'panel' => [
        'heading' => $entrant->fullName,
        'type' => DetailView::TYPE_PRIMARY,
    ],
    'attributes' => [
        'last_name',
        'first_name',
        'patronymic',
        [
            'attribute' => 'future_educational_program_id',
            'value' => $entrant->futureEducationalProgram->fullname,
        ],
        'phone_number',
        'email:email',
        [
            'attribute' => 'sex_id',
            'value' => $entrant->sex->name,
        ], // TODO: Русская и казахская локаль
        'birthdate:date',
        [
            'attribute' => 'organization_id',
            'value' => $entrant->organization->name ?? null,
        ],
        [
            'attribute' => 'level_id',
            'value' => $entrant->level->name,
        ],
        'iin',
        [
            'attribute' => 'created_by',
            'value' => $entrant->createdBy->shortNameWithEmail,
        ],
        'status_id', // TODO: Русская и казахская локаль
        'created_at:datetime',
    ],
]) ?>
