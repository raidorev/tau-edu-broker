<?php
/**
 * @var View    $this
 * @var Entrant $model
 */

use app\components\helpers\ViewHelper;
use app\models\entrant\Entrant;
use yii\web\View;

$this->title = Yii::t('app', 'Просмотр абитуриента');
ViewHelper::addBreadcrumbs($this->title);
?>

<?= $this->render('_view', ['entrant' => $model]) ?>
