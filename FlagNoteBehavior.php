<?php
namespace WondersLabCorporation\yii2\flagNotes;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

use WondersLabCorporation\yii2\flagNotes\models\FlagNote;

class FlagNoteBehavior extends Behavior
{
    private $_model = null;


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
        $attributes = Yii::$app->request->post('FlagNote', Yii::$app->request->get('FlagNote', null) );

        if($attributes)
        {
            $model = $this->getModel();

            if(!isset($model))
                $model = new FlagNote();

            $attributes['model_id'] = $this->owner->id;
            $attributes['model']  = (new \ReflectionClass($this->owner))->getShortName();

            $model->attributes = $attributes;
            $model->save();
        }
    }


    public function afterDelete($event)
    {
        FlagNote::deleteAll([
            'model_id' => $this->owner->id,
            'model'  => (new \ReflectionClass($this->owner))->getShortName()
        ]);
    }


    public function getModel()
    {
        $model = FlagNote::findOne([
            'model_id' => $this->owner->id,
            'model'  => (new \ReflectionClass($this->owner))->getShortName()
        ]);

        if($model == null) {
            $model = new FlagNote();
        }

        $this->_model = $model;

        return $model;
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
}
