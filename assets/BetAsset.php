<?php

namespace app\assets;

use yii\web\AssetBundle;

class BetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [

    ];
    public $js = [];
    public $depends = [
        LayoutAsset::class
    ];
}
