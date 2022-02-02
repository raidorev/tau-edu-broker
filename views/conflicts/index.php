<?php
/**
 * @var View  $this
 * @var array $conflicts
 */

use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\View;
?>

<table class="table">
    <thead>
    <tr>
        <td>Абитуриенты</td>
        <td>Маклеры</td>
        <td>Причина</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($conflicts as $conflict): ?>
        <tr>
            <td>
                <!-- <div class="btn-group-vertical w-100">-->
                <div class="list-group">
                    <?php foreach ($conflict['entrants'] as $entrant): ?>
                        <div class="list-group-item">
                            <?= Html::a(
                                $entrant->shortName,
                                Url::to([
                                    'entrants/update',
                                    'id' => $entrant->id,
                                ])
                                // ['class' => ['btn', 'btn-secondary', 'btn-block']]
                            ) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </td>
            <td>
                <div class="list-group">
                    <?php foreach ($conflict['brokers'] as $broker): ?>
                        <div class="list-group-item">
                            <?= $broker->getShortNameWithEmail(true) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </td>
            <td>
                <?= $conflict['reason'] ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
