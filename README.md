# yii2-flag-notes
DB based model flag notes

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add to your composer.json file

```php 
"repositories": [
        {
            "url": "https://github.com/WondersLabCorporation/yii2-flag-notes.git",
            "type": "git"
        }
    ]
```

Either run

``` 
php composer.phar require --prefer-dist WondersLabCorporation/yii2-flag-notes "*"
```

or add

```
"WondersLabCorporation/yii2-flag-notes": "*"
```

to the require section of your `composer.json` file.

To create table in your DB run

```
./yii migrate --migrationPath="@vendor/WondersLabCorporation/yii2-flag-notes/migrations"
```

Usage
------------

Add `FlagNoteBehavior` to your model, and configure it.

```php

public function behaviors()
{
    return [
        'FlagNote' => [
            'class' => FlagNoteBehavior::className(),
        ],
    ];
}
```

Add `FlagNotes` somewhere in you application, for example in editing form.

```php
use WondersLabCorporation\yii2\flagNotes\FlagNotes;

<?= FlagNotes::widget([
    'model' => $model,
    'form' => $form,
    'headerOptions' => [
        'includeHeader' => true,    //if true render header for widget
        'tag' => 'h3',    //tag for header container
        'class' => 'your_class',    //class for header container
        'tag' => 'your_id',    //id for header container
        'content' => Yii::t('category', 'Flag Notes'),    //text for header container
    ],
    'options' => [
        'prompt' => Yii::t('category', 'Select Flag Type'),    //text for empty dropdown field `flag_type`
    ]
]) ?>
```