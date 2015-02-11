yii2-ajax-new
=============

This widget allow you to easily create a new related entity instance from within a form in Yii, in a bootstrap Modal view.

Let's suppose for instance that you have an Article model with a manyToOne relation with a Category model (article.category_id = category.id)

When creating a new Article, you realize that you didn't create the target Category yet. You would normally cancel the Article creation, create the Category, and then go back to the Article creation.

yii2-ajax-new will allow you to avoid that hassle by creating the new Category right away from the Article form.

A complete sample if provided below.

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

Assuming you have created both Article and Category models with the relation Article.category_id = Category.id, you will need to:

1. Configure your CategoryController as follows:
```php
    public function actions()
    {
        return [
            'ajaxNew' => [
                'class'      => '\inspire\action\AjaxNewAction',
                'viewFile'   => '_form',
                'model'      => new Category(),
                'attr_id'    => 'id',
                'attr_label' => 'label',
            ]
        ];
    }
```

2. Add the AjaxNew widget in your article/_form view:
```php
$newCategory = AjaxNew::widget([
    'url' => Url::toRoute(['/category/ajaxNew']),
    'header' => '<strong>' . Yii::t('app', 'Create new category') . '</strong>',
    'selector' => '#article-category',
]);

// ...

<?= $form->field($model, 'category', [
'template' => "{label} " . $newCategory . " \n{input}\n{hint}\n{error}",

```
