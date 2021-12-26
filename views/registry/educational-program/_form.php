<?php
/**
 * @var View $this
 * @var EducationalProgram $model
 */

use app\models\registry\EducationalProgram;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'code')->textInput() ?>

<?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'name_kk')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

<?= Html::submitButton(Yii::t('app', 'Сохранить'), [
    'class' => 'btn btn-success',
]) ?>

<?php ActiveForm::end(); ?>
