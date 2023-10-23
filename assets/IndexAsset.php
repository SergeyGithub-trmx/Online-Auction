<?php

namespace app\assets;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/lot-list.css'
    ];
    public $js = [];
    public $depends = [
        LayoutAsset::class
    ];
}
