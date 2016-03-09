<?php
namespace WondersLabCorporation\yii2\flagNotes;

use Yii;
use yii\base\Widget;
use yii\base\Exception;
use WondersLabCorporation\yii2\flagNotes\models\FlagNote;


class FlagNotes extends Widget
{
    public $model;
    public $form;
    
    /**
     * @var array the options for Widget.
     * @see self::availableHeaderOptions() for list of available options.
     */
    public $headerOptions = [];
    /**
     * @var array the options for Widget.
     * @see self::availableOptions() for list of available options.
     */
    public $options = [];
    
    private static function availableHeaderOptions()
    {
        return ['includeHeader', 'headerTag', 'headerClass', 'headerId', 'headerContent'];
    }
    
    private static function availableOptions()
    {
        return ['prompt'];
    }
    
    private function checkAvailabilityProperties()
    {
        foreach (array_keys($this->headerOptions) as $headerOption) {
            if (!in_array($headerOption, self::availableHeaderOptions())) {
                throw new Exception('HeaderOption ' . $headerOption . ' is not available');
            }
        }
        foreach (array_keys($this->options) as $option) {
            if (!in_array($option, self::availableOptions())) {
                throw new Exception('Option ' . $option . ' is not available');
            }
        }
    }

    public function run()
    {
        $this->checkAvailabilityProperties();
        
        $model = new FlagNote;

        if(!$this->model->isNewRecord)
        {
            $flag_note = FlagNote::findOne([
                'model_id' => $this->model->id,
                'model'  => (new \ReflectionClass($this->model))->getShortName()
            ]);

            if(isset($flag_note)) {
                $model = $flag_note;
            }
        }

        $model->refillModelAttributes($this->headerOptions, $this->options);
        
        return $this->render('FlagNotes', [
            'model' => $model,
            'form' => $this->form,
        ]);
    }
}
