<?php

/**
 * @var View            $this
 * @var ConflictResolve $conflictResolve
 */

use app\components\helpers\ListHelper;
use app\components\helpers\ViewHelper;
use app\models\conflict\ConflictResolve;
use kartik\detail\DetailView;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\web\View;

ViewHelper::addBreadcrumbs(Yii::t('app', 'Разрешение конфликта'));

$this->registerJsFile('/dist/js/conflict/resolve.js');
?>

<h2>Решение конфликта (<?= $conflictResolve->conflict->reason ?>)</h2>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-12 col-sm-6">
        <?= $form->field($conflictResolve, 'entrant')->widget(Select2::class, [
            'options' => [
                'placeholder' => Yii::t('app', 'Выберите абитуриента'),
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
            'data' => ListHelper::toSelectList(
                $conflictResolve->conflict->entrants,
                'id',
                'fullName'
            ),
        ]) ?>
    </div>

    <div class="col-12 col-sm-6">
        <?= $form->field($conflictResolve, 'broker')->widget(Select2::class, [
            'data' => ListHelper::toSelectList(
                $conflictResolve->conflict->brokers,
                'id',
                'shortNameWithEmail'
            ),
        ]) ?>
    </div>
</div>

<div class="row">
    <?php foreach ($conflictResolve->conflict->entrants as $entrant): ?>
        <div class="col-12 col-sm-6 col-md-4">
            <?= DetailView::widget([
                'id' => "card-$entrant->id",
                'model' => $entrant,
                'condensed' => true,
                'hover' => true,
                'mode' => DetailView::MODE_VIEW,
                'enableEditMode' => false,
                'panel' => [
                    'heading' => $entrant->fullName,
                    'type' => DetailView::TYPE_SECONDARY,
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
                    ],
                    'birthdate:date',
                    [
                        'attribute' => 'organization_id',
                        'value' => $entrant->organization->name,
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
                    'status_id',
                ],
            ]) ?>
        </div>
    <?php endforeach; ?>
</div>

<?= Html::submitButton(Yii::t('app', 'Разрешить конфликт'), [
    'class' => ['btn', 'btn-primary'],
]) ?>

<?php ActiveForm::end(); ?>
