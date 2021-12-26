<?php
/**
 * @var View $this
 * @var LoginForm $login
 */

use app\models\auth\LoginForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Вход');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>Please fill out the following fields to login:</p>

<div class="row">
    <div class="col-12 col-md-6">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

        <?= $form->field($login, 'email')->textInput(['autofocus' => true]) ?>
        <?= $form->field($login, 'password')->passwordInput() ?>
        <?= $form->field($login, 'rememberMe')->checkbox() ?>

        <?= Html::submitButton(Yii::t('app', 'Войти'), [
            'class' => 'btn btn-primary',
            'name' => 'login-button',
        ]) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
