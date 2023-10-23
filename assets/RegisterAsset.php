<?php

namespace app\assets;

use yii\web\AssetBundle;

class RegisterAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/login-registration.css',
        'css/register.css'
    ];
    public $js = [];
    public $depends = [
        LayoutAsset::class
    ];
}
