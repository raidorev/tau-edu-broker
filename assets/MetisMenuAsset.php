<?php

namespace app\assets;

use yii\web\AssetBundle;

class MetisMenuAsset extends AssetBundle
{
    public $css = ['metisMenu.min.css'];
    public $js = ['metisMenu.min.js'];
    public $sourcePath = '@npm/metismenu/dist';
}
