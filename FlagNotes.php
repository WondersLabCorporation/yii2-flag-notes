<?php
namespace WondersLabCorporation\yii2\flagNotes;

use Yii;
use yii\base\Widget;

use WondersLabCorporation\yii2\flagNotes\models\FlagNote;


class FlagNotes extends Widget
{
    public $model;
    public $form;
    
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
}
