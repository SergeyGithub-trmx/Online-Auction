<?php

namespace app\assets;

use yii\web\AssetBundle;

class LayoutAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/normalize.css',
        'css/style.css',
        'css/main-header.css',
    ];
    public $js = [];
    public $depends = [];
}
