<?php

namespace app\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/login-registration.css',
        'css/login.css'
    ];
    public $js = [];
    public $depends = [
        LayoutAsset::class
    ];
}
