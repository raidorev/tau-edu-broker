<?php
/**
 * @var View                    $this
 * @var EducationalOrganization $model
 */

use app\models\registry\EducationalOrganization;
use app\models\registry\EducationLevel;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-row">
    <div class="col-12">
        <?= $form->field($model, 'levels')->widget(Select2::class, [
            'data' => EducationLevel::find()->selectList(),
            'theme' => Select2::THEME_BOOTSTRAP,
            'pluginOptions' => [
                'multiple' => true,
            ],
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
