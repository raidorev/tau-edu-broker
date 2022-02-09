<?php

use app\components\helpers\ViewHelper;
use app\models\entrant\Entrant;
use app\models\entrant\EntrantStatus;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\web\View;

/**
 * @var View    $this
 * @var Entrant $entrant
 */

ViewHelper::addBreadcrumbs(Yii::t('app', 'Подтверждение абитуриента'));
?>

<?php $form = ActiveForm::begin(); ?>

<div class="mb-4">
    <?= $form->field($entrant, 'status_id')->widget(Select2::class, [
        'data' => EntrantStatus::find()->selectList(),
        'options' => [
            'placeholder' => Yii::t('app', 'Выберите статус'),
        ],
    ]) ?>

    <?= Html::submitButton(Yii::t('app', 'Сохранить'), [
        'class' => ['btn', 'btn-primary'],
    ]) ?>
</div>

<?php ActiveForm::end(); ?>

<?= $this->render('_view', ['entrant' => $entrant]) ?>
