<?php
/**
 * @var View $this
 * @var RegisterForm $register
 * @var LoginForm $login
 */

use app\models\auth\LoginForm;
use app\models\auth\RegisterForm;
use kartik\icons\Icon;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Универсистет Туран-Астана');
$this->registerCssFile('/dist/css/views/site/index.css');

Yii::$app->params['landing-nav-items'] = [
    '#offer' => Yii::t('app', 'Публичная оферта'),
    '#registration' => Yii::t('app', 'Регистрация'),
    '#login' => Yii::t('app', 'Вход'),
    '#contacts' => Yii::t('app', 'Контакты'),
];
?>

<section class="section-intro d-flex justify-content-center align-items-center">
    <div class="container-fluid py-3 section-intro__text">
        <div class="container px-0">
            <h1>
                <?= Yii::t('app', 'Маклер TAU') ?>
            </h1>
            <div class="lead">
                <?= Yii::t(
                    'app',
                    'Привлекая образование - инвестируй в свое будущее!'
                ) ?>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark text-light py-5">
    <div class="container">
        <h2 id="offer" class="title">
            <?= Yii::t('app', 'Публичная оферта') ?>
        </h2>

        <p class="text-center">
            Тут должна быть публичная офета
        </p>
        <div class="text-center">
            <div class="btn btn-primary"><?= Yii::t(
                'app',
                'Публичная оферта'
            ) ?></div>
        </div>
    </div>
</section>

<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <h2 id="registration" class="title">
                    <?= Yii::t('app', 'Регистрация') ?>
                </h2>

                <?php $form = ActiveForm::begin(['action' => ['site/register']]); ?>
                <?= $form->field($register, 'last_name', [
                    'inputOptions' => [
                        'placeholder' => Yii::t('app', 'Иванов'),
                    ],
                ]) ?>
                <?= $form->field($register, 'first_name', [
                    'inputOptions' => ['placeholder' => Yii::t('app', 'Иван')],
                ]) ?>
                <?= $form->field($register, 'patronymic', [
                    'inputOptions' => [
                        'placeholder' => Yii::t('app', 'Иванович'),
                    ],
                ]) ?>
                <?= $form->field($register, 'email', [
                    'inputOptions' => [
                        'placeholder' => Yii::t('app', 'me@domain.tld'),
                    ],
                ]) ?>
                <?= $form->field($register, 'password')->passwordInput() ?>
                <?= $form
                    ->field($register, 'retypePassword')
                    ->passwordInput() ?>

                <?= Html::submitButton(Yii::t('app', 'Зарегистрироваться'), [
                    'class' => ['btn', 'btn-primary'],
                ]) ?>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="col-12 d-md-none">
                <hr>
            </div>

            <div class="col-12 col-md-6">
                <h2 id="login" class="title">
                    <?= Yii::t('app', 'Вход') ?>
                </h2>

                <?php $form = ActiveForm::begin(['action' => ['site/login']]); ?>
                <?= $form->field($login, 'email', [
                    'inputOptions' => [
                        'placeholder' => 'me@domain.tld',
                    ],
                ]) ?>
                <?= $form->field($login, 'password')->passwordInput() ?>
                <?= $form->field($login, 'rememberMe')->checkbox() ?>
                
                <?= Html::submitButton(Yii::t('app', 'Войти'), ['class' => ['btn', 'btn-primary']]) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark text-light py-5">
    <div class="container">
        <h2 id="contacts" class="title"><?= Yii::t('app', 'Контакты') ?></h2>

        <div class="row">
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <p>
                    <?= Icon::show('map-marker-alt') ?>
                    <?= Yii::t('app', 'ул.') ?> Ықылас Дүкенұлы, 29
                </p>
                <p>
                    <?= Icon::show('envelope') ?>
                    <?= Html::mailto('info@tau-edu.kz') ?>
                </p>
                <p>
                    <?= Icon::show('phone') ?>
                    <a href="tel:+77182398118">
                        +7 (7182) 39 81 18
                    </a>
                </p>
                <p>
                    <?= Yii::t(
                        'app',
                        'Контактная почта отдела маркетинга и приемной комиссии'
                    ) ?>:
                    <?= Html::mailto('admissions@tau-edu.kz') ?>
                </p>
            </div>
            <div class="col-12 col-md-8">
                <iframe id="map_485874913"
                        sandbox="allow-modals allow-forms allow-scripts allow-same-origin allow-popups allow-top-navigation-by-user-activation"
                        width="100%" height="300px" frameborder="0"></iframe>
                <script type="text/javascript">(function (e, t) {
                        var r = document.getElementById(e);
                        r.contentWindow.document.open(), r.contentWindow.document.write(atob(t)), r.contentWindow.document.close()
                    })("map_485874913", "PGJvZHk+PHN0eWxlPgogICAgICAgIGh0bWwsIGJvZHkgewogICAgICAgICAgICBtYXJnaW46IDA7CiAgICAgICAgICAgIHBhZGRpbmc6IDA7CiAgICAgICAgfQogICAgICAgIGh0bWwsIGJvZHksICNtYXAgewogICAgICAgICAgICB3aWR0aDogMTAwJTsKICAgICAgICAgICAgaGVpZ2h0OiAxMDAlOwogICAgICAgIH0KICAgICAgICAuYnVsbGV0LW1hcmtlciB7CiAgICAgICAgICAgIHdpZHRoOiAyMHB4OwogICAgICAgICAgICBoZWlnaHQ6IDIwcHg7CiAgICAgICAgICAgIGJveC1zaXppbmc6IGJvcmRlci1ib3g7CiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7CiAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMXB4IDNweCAwIHJnYmEoMCwgMCwgMCwgMC4yKTsKICAgICAgICAgICAgYm9yZGVyOiA0cHggc29saWQgIzAyODFmMjsKICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTAlOwogICAgICAgIH0KICAgICAgICAucGVybWFuZW50LXRvb2x0aXAgewogICAgICAgICAgICBiYWNrZ3JvdW5kOiBub25lOwogICAgICAgICAgICBib3gtc2hhZG93OiBub25lOwogICAgICAgICAgICBib3JkZXI6IG5vbmU7CiAgICAgICAgICAgIHBhZGRpbmc6IDZweCAxMnB4OwogICAgICAgICAgICBjb2xvcjogIzI2MjYyNjsKICAgICAgICB9CiAgICAgICAgLnBlcm1hbmVudC10b29sdGlwOmJlZm9yZSB7CiAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7CiAgICAgICAgfQogICAgICAgIC5kZy1wb3B1cF9oaWRkZW5fdHJ1ZSB7CiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrOwogICAgICAgIH0KICAgICAgICAubGVhZmxldC1jb250YWluZXIgLmxlYWZsZXQtcG9wdXAgLmxlYWZsZXQtcG9wdXAtY2xvc2UtYnV0dG9uIHsKICAgICAgICAgICAgdG9wOiAwOwogICAgICAgICAgICByaWdodDogMDsKICAgICAgICAgICAgd2lkdGg6IDIwcHg7CiAgICAgICAgICAgIGhlaWdodDogMjBweDsKICAgICAgICAgICAgZm9udC1zaXplOiAyMHB4OwogICAgICAgICAgICBsaW5lLWhlaWdodDogMTsKICAgICAgICB9CiAgICA8L3N0eWxlPjxkaXYgaWQ9Im1hcCI+PC9kaXY+PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cHM6Ly9tYXBzLmFwaS4yZ2lzLnJ1LzIuMC9sb2FkZXIuanM/cGtnPWZ1bGwmYW1wO3NraW49bGlnaHQiPjwvc2NyaXB0PjxzY3JpcHQ+KGZ1bmN0aW9uKGUsdCl7dmFyIHI9SlNPTi5wYXJzZShlKSxuPUpTT04ucGFyc2UodCk7ZnVuY3Rpb24gYShlKXtyZXR1cm4gZGVjb2RlVVJJQ29tcG9uZW50KGF0b2IoZSkuc3BsaXQoIiIpLm1hcChmdW5jdGlvbihlKXtyZXR1cm4iJSIrKCIwMCIrZS5jaGFyQ29kZUF0KDApLnRvU3RyaW5nKDE2KSkuc2xpY2UoLTIpfSkuam9pbigiIikpfURHLnRoZW4oZnVuY3Rpb24oKXt2YXIgZT1ERy5tYXAoIm1hcCIse2NlbnRlcjpbbi5sYXQsbi5sb25dLHpvb206bi56b29tfSk7REcuZ2VvSlNPTihyLHtzdHlsZTpmdW5jdGlvbihlKXt2YXIgdCxyLG4sYSxvO3JldHVybntmaWxsQ29sb3I6bnVsbD09PSh0PWUpfHx2b2lkIDA9PT10P3ZvaWQgMDp0LnByb3BlcnRpZXMuZmlsbENvbG9yLGZpbGxPcGFjaXR5Om51bGw9PT0ocj1lKXx8dm9pZCAwPT09cj92b2lkIDA6ci5wcm9wZXJ0aWVzLmZpbGxPcGFjaXR5LGNvbG9yOm51bGw9PT0obj1lKXx8dm9pZCAwPT09bj92b2lkIDA6bi5wcm9wZXJ0aWVzLnN0cm9rZUNvbG9yLHdlaWdodDpudWxsPT09KGE9ZSl8fHZvaWQgMD09PWE/dm9pZCAwOmEucHJvcGVydGllcy5zdHJva2VXaWR0aCxvcGFjaXR5Om51bGw9PT0obz1lKXx8dm9pZCAwPT09bz92b2lkIDA6by5wcm9wZXJ0aWVzLnN0cm9rZU9wYWNpdHl9fSxwb2ludFRvTGF5ZXI6ZnVuY3Rpb24oZSx0KXtyZXR1cm4icmFkaXVzImluIGUucHJvcGVydGllcz9ERy5jaXJjbGUodCxlLnByb3BlcnRpZXMucmFkaXVzKTpERy5tYXJrZXIodCx7aWNvbjpmdW5jdGlvbihlKXtyZXR1cm4gREcuZGl2SWNvbih7aHRtbDoiPGRpdiBjbGFzcz0nYnVsbGV0LW1hcmtlcicgc3R5bGU9J2JvcmRlci1jb2xvcjogIitlKyI7Jz48L2Rpdj4iLGNsYXNzTmFtZToib3ZlcnJpZGUtZGVmYXVsdCIsaWNvblNpemU6WzIwLDIwXSxpY29uQW5jaG9yOlsxMCwxMF19KX0oZS5wcm9wZXJ0aWVzLmNvbG9yKX0pfSxvbkVhY2hGZWF0dXJlOmZ1bmN0aW9uKGUsdCl7ZS5wcm9wZXJ0aWVzLmRlc2NyaXB0aW9uJiZ0LmJpbmRQb3B1cChhKGUucHJvcGVydGllcy5kZXNjcmlwdGlvbikse2Nsb3NlQnV0dG9uOiEwLGNsb3NlT25Fc2NhcGVLZXk6ITB9KSxlLnByb3BlcnRpZXMudGl0bGUmJnQuYmluZFRvb2x0aXAoYShlLnByb3BlcnRpZXMudGl0bGUpLHtwZXJtYW5lbnQ6ITAsb3BhY2l0eToxLGNsYXNzTmFtZToicGVybWFuZW50LXRvb2x0aXAifSl9fSkuYWRkVG8oZSl9KX0pKCdbeyJ0eXBlIjoiRmVhdHVyZSIsInByb3BlcnRpZXMiOnsiY29sb3IiOiIjMDI4MWYyIiwidGl0bGUiOiIiLCJkZXNjcmlwdGlvbiI6IiIsInpJbmRleCI6MTAwMDAwMDAwMH0sImdlb21ldHJ5Ijp7InR5cGUiOiJQb2ludCIsImNvb3JkaW5hdGVzIjpbNzEuNDMyMzA5LDUxLjE4MTU5MV19LCJpZCI6NjIzfV0nLCd7ImxhdCI6NTEuMTgwOTk3NDgyNTQ2MjQ2LCJsb24iOjcxLjQzMjc5NDMzMjUwNDI5LCJ6b29tIjoxNn0nKTwvc2NyaXB0PjxzY3JpcHQgYXN5bmM9IiIgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBzcmM9Imh0dHBzOi8vd3d3Lmdvb2dsZXRhZ21hbmFnZXIuY29tL2d0YWcvanM/aWQ9VUEtMTU4ODY2MTY4LTEiPjwvc2NyaXB0PjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0Ij4oZnVuY3Rpb24oZSl7ZnVuY3Rpb24gdCgpe2RhdGFMYXllci5wdXNoKGFyZ3VtZW50cyl9d2luZG93LmRhdGFMYXllcj13aW5kb3cuZGF0YUxheWVyfHxbXSx0KCJqcyIsbmV3IERhdGUpLHQoImNvbmZpZyIsZSksd2luZG93Lmd0YWc9dH0pKCdVQS0xNTg4NjYxNjgtMScpPC9zY3JpcHQ+PC9ib2R5Pg==")</script>
            </div>
        </div>
    </div>
</section>