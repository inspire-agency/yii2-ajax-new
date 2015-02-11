<?php

namespace inspire\widget;

use yii\web\AssetBundle;

/**
 * Class AjaxNewAsset
 *
 * @package inspire\widget
 */
class AjaxNewAsset extends AssetBundle
{
    public $js = [
        'jquery.ajaxnew.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../assets';
        parent::init();
    }
}
