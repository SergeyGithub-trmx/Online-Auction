<?php

namespace app\assets;

use yii\web\AssetBundle;

class LotAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/lot_page-style.css'
    ];
    public $js = [];
    public $depends = [
        LayoutAsset::class
    ];
}
