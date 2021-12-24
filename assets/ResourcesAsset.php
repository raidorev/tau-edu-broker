<?php

namespace app\assets;

use yii\web\AssetBundle;

class ResourcesAsset extends AssetBundle
{
    public $sourcePath = '@dist';
    public $js = [];
    public $css = ['css/main.css'];
}
