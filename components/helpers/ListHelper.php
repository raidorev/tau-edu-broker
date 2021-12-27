<?php

namespace app\components\helpers;

use Closure;
use yii\helpers\ArrayHelper;

/**
 * Вспомогательный класс для работы с листами
 *
 * @package app\components\helpers
 */
final class ListHelper
{
    /**
     * Преобразует лист в лист формата ['id' => 'value', ...]
     *
     * ```php
     * // In controller
     * $list = ListHelper::toSelectList(Model::findAll($condition), 'id', 'fullname');
     *
     * // In view
     * <?= $form->field($model, 'attribute')->widget(Select2::class, ['data' => $list]) ?>
     * ```
     *
     * @param array $list
     * @param string|Closure $id
     * @param string|Closure $value
     * @param string|Closure $group
     *
     * @return array
     */
    public static function toSelectList(
        array $list,
        $id,
        $value,
        $group = null
    ): array {
        return ArrayHelper::map($list, $id, $value, $group);
    }

    /**
     * Преобразует лист в лист формата [['id' => 20, 'name' => 'Value'], ...]
     *
     * ```php
     * // In view
     * <?= $form->field($model, 'attribute')->widget(DepDrop::class, [
     *   'pluginOptions' => ['url' => Url::to(['get-list'])],
     * ]) ?>
     *
     * // In actionGetList
     * return ListHelper::toDepDropList(Model::findAll($condition), 'id', 'fullname');
     * ```
     *
     * @param array $list
     * @param string|Closure $id
     * @param string|Closure $value
     *
     * @return array
     */
    public static function toDepDropList(array $list, $id, $value): array
    {
        return ArrayHelper::getColumn($list, static function ($e) use (
            $id,
            $value
        ) {
            return [
                'id' => ArrayHelper::getValue($e, $id),
                'name' => ArrayHelper::getValue($e, $value),
            ];
        });
    }

    /**
     * Создает ассоциативный массив с одинаковыми парами ключ-значение.
     *
     * ```php
     * <?php
     * $rangeMap = ListHelper::rangeMap(2, 6, 2); // [2 => 2, 4 => 4, 6 => 6]
     * ```
     *
     * @param string|int|float $from
     * @param string|int|float $to
     * @param int|float $step
     */
    public static function rangeMap($from, $to, $step = 1): array
    {
        $range = range($from, $to, $step);
        return array_combine($range, $range);
    }
}
