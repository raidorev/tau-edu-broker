<?php
/**
 * @var View $this
 * @var EducationalProgram $model
 */

use app\models\registry\EducationalProgram;
use app\models\registry\EducationalStage;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-row">
    <div class="col-12 col-md-6">
        <?= $form->field($model, 'code')->textInput() ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $form
            ->field($model, 'educational_stage_id')
            ->widget(Select2::class, [
                'data' => EducationalStage::find()->selectList(),
            ]) ?>
    </div>
    <div class="col-12">
        <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12">
        <?= $form->field($model, 'name_kk')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12">
        <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), [
            'class' => 'btn btn-success',
        ]) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
