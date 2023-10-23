<?php

namespace app\assets;

use yii\web\AssetBundle;

class CloseLotAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/validation.css'
    ];
    public $js = [];
    public $depends = [
        LayoutAsset::class
    ];
}
