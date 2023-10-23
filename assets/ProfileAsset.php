<?php

namespace app\assets;

use yii\web\AssetBundle;

class ProfileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/profile.css',
        // 'css/login.css'
    ];
    public $js = [];
    public $depends = [
        LayoutAsset::class
    ];
}
