yii2-ajax-new
=============

This widget allows you to easily create a new related entity from within a form in Yii, in a bootstrap Modal view.

The basic usage is meant to be :
  - You have an ActiveForm for your model A
  - This form includes a dropDownList() linked to another entity B
  - You want to be able to create and add a new entry in the drop down, without leaving the A form


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```sh
php composer.phar require inspire-agency/yii2-ajax-new "*"
```

or add

```json
"inspire-agency/yii2-ajax-new": "*"
```

to the require section of your `composer.json` file.


Configuration
-------------

You need to configure your controller as follows:
```php
    public function actions()
    {
        return [
            'ajaxNew' => [
                'class'      => '\app\components\AjaxNewAction',
                'viewFile'   => '_form',
                'model'      => new Project(),
                'attr_id'    => 'id',
                'attr_label' => 'label',
            ]
        ];
    }
```


