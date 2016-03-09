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

```php 
composer.phar require --prefer-dist WondersLabCorporation/yii2-flag-notes "*"
```

or add

```
"WondersLabCorporation/yii2-flag-notes": "*"
```

to the require section of your `composer.json` file.

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
echo FlagNotes::widget([
    'model' => $model,
    'form' => $form
]);
```