<?php

namespace inspire\widget;

use Yii;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\Widget;
use yii\web\View;

class AjaxNew extends Modal {
    

    public $clientOptions = false;

    public $size = Modal::SIZE_SMALL;

    public $toggleButton = [
        'id'    => 'toggle-modal',
        'label' => '<i class="fa fa-plus"></i>',
        'tag'   => 'a',
        'class' => 'btn btn-xs btn-primary'
    ];

    public $header = 'Ajax new';

    public $url = null;

    public $selector = null;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        Widget::init();

        if (is_null($this->url)) {
            throw new InvalidConfigException('No url specified for AjaxNew Widget.');
        }

        if (is_null($this->selector)) {
            throw new InvalidConfigException('No url specified for AjaxNew Widget.');
        }

        $this->toggleButton['data-target'] = '#' . $this->id;
        $this->initOptions();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo $this->renderToggleButton() . "\n";

        Yii::$app->view->on(View::EVENT_END_BODY, function () {
            echo Html::beginTag('div', $this->options) . "\n";
            echo Html::beginTag('div', ['class' => 'modal-dialog ' . $this->size]) . "\n";
            echo Html::beginTag('div', ['class' => 'modal-content']) . "\n";
            echo $this->renderHeader() . "\n";
            echo $this->renderBodyBegin() . "\n";
            echo "\n" . $this->renderBodyEnd();
            echo "\n" . $this->renderFooter();
            echo "\n" . Html::endTag('div'); // modal-content
            echo "\n" . Html::endTag('div'); // modal-dialog
            echo "\n" . Html::endTag('div');
        });

        $this->registerPlugin('modal');

        $js = <<<JS

$("#{$this->id}").ajaxNew({
    selector: "{$this->selector}",
    url: "{$this->url}"
});

JS;
        $this->getView()->registerJs($js);


        AjaxNewAsset::register($this->getView());

    }

}