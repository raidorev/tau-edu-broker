<?php

/**
 * Debug function
 * ```php
 * d($var1, $var2, ...);
 * ```
 */
function d()
{
    echo ' <pre>';
    for ($i = 0; $i < func_num_args(); $i++) {
        yii\helpers\VarDumper::dump(func_get_arg($i), 10, true);
    }
    echo '</pre>';
}

/**
 * Debug function with die() after
 * ```php
 * dd($var1, $var2, ...);
 * ```
 */
function dd()
{
    for ($i = 0; $i < func_num_args(); $i++) {
        d(func_get_arg($i));
    }
    die();
}
