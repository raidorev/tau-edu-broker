<?php
/**
 * @var View $this
 * @var Entrant $model
 */

use app\models\entrant\Entrant;
use app\models\registry\EducationalProgram;
use app\models\registry\EducationalStage;
use app\models\registry\Sex;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-row">
    <div class="col-12 col-md-4">
        <?= $form
            ->field($model, 'last_name')
            ->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12 col-md-4">
        <?= $form
            ->field($model, 'first_name')
            ->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12 col-md-4">
        <?= $form
            ->field($model, 'patronymic')
            ->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $form
            ->field($model, 'future_educational_stage_id')
            ->widget(Select2::class, [
                'data' => ArrayHelper::map(
                    EducationalStage::find()->all(),
                    'id',
                    'name_ru'
                ),
            ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $form
            ->field($model, 'future_educational_program_id')
            ->widget(Select2::class, [
                'data' => ArrayHelper::map(
                    EducationalProgram::find()->all(),
                    'id',
                    static function (EducationalProgram $ep) {
                        return "$ep->code $ep->name_ru";
                    }
                ),
            ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $form
            ->field($model, 'phone_number')
            ->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $form->field($model, 'sex_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Sex::find()->all(), 'id', 'name_ru'),
        ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $form->field($model, 'birthdate')->widget(DatePicker::class,) ?>
    </div>

    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), [
                'class' => 'btn btn-success',
            ]) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
