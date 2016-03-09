<?php
namespace WondersLabCorporation\yii2\flagNotes;

use Yii;
use yii\base\Widget;

use WondersLabCorporation\yii2\flagNotes\models\FlagNote;


class FlagNotes extends Widget
{
    public $model;
    public $form;


    public function init()
    {
        parent::init();
        self::registerTranslations();
    }


    public static function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['metaTags/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'sys',
            'basePath' => '@vendor/WondersLabCorporation/yii2-flag-notes/messages',
            'fileMap' => [
                'flagNotes/messages' => 'messages.php',
            ],
        ];
    }


    public function run()
    {
        $model = new FlagNote;

        if(!$this->model->isNewRecord)
        {
            $flag_note = FlagNote::findOne([
                'model_id' => $this->model->id,
                'model'  => (new \ReflectionClass($this->model))->getShortName()
            ]);

            if(isset($flag_note))
                $model = $flag_note;
        }

        return $this->render('FlagNotes', [
            'model' => $model,
            'form' => $this->form,
        ]);
    }


    public static function t($category, $message, $params = [], $language = null)
    {
        self::registerTranslations();

        return Yii::t('flagNotes/' . $category, $message, $params, $language);
    }
}
