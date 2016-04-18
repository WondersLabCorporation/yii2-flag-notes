<?php
namespace WondersLabCorporation\yii2\flagNotes;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class FlagNoteBehavior extends Behavior
{
    private $_model = null;

    public $formName = null;

    public $flagNoteModelClass = 'WondersLabCorporation\yii2\flagNotes\models\FlagNote';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }


    public function afterSave($event)
    {
        // TODO: Find out a better way to load params instead of direct access to post/get via application component
        $formName = $this->getFormName();
        $attributes = Yii::$app->request->post($formName, Yii::$app->request->get($formName, null));

        if ($attributes) {
            $model = $this->getModel();

            $attributes['model_id'] = $this->owner->id;
            $attributes['model']  = (new \ReflectionClass($this->owner))->getShortName();

            $model->attributes = $attributes;
            $model->save();
        }
    }


    public function afterDelete($event)
    {
        call_user_func([$this->flagNoteModelClass, 'deleteAll'], [
            'model_id' => $this->owner->id,
            'model'  => (new \ReflectionClass($this->owner))->getShortName()
        ]);
    }


    public function getModel()
    {
        if (!$this->_model) {
            $model = call_user_func([$this->flagNoteModelClass, 'findOne'], [
                'model_id' => $this->owner->id,
                'model' => (new \ReflectionClass($this->owner))->getShortName()
            ]);

            if ($model == null) {
                $model = new $this->flagNoteModelClass;
            }

            $this->_model = $model;
        }

        return $this->_model;
    }


    public function getType()
    {
        $model = $this->_model;
        if(!isset($model)) {
            $model = $this->getModel();
        }

        return isset($model) ? $model->flag_type : '';
    }

    public function getDescription()
    {
        $model = $this->_model;
        if(!isset($model)) {
            $model = $this->getModel();
        }

        return isset($model) ? $model->flag_description : '';
    }

    /**
     * Return provided form name via configs or get it from FlagNote model
     * @return string
     */
    public function getFormName()
    {
        return (!$this->formName) ? $this->getModel()->formName() : $this->formName;
    }
}
