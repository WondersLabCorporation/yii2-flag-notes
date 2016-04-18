<?php
namespace WondersLabCorporation\yii2\flagNotes;

use Yii;
use yii\base\Widget;
use yii\base\Exception;
use WondersLabCorporation\yii2\flagNotes\models\FlagNote;

// TODO: Add possibility to update data from a separate page without embedding it to another form
class FlagNotes extends Widget
{
    public $model;
    public $form;

    public $flagNoteModelClass = 'WondersLabCorporation\yii2\flagNotes\models\FlagNote';

    /**
     * @var boolean Whether to show header
     */
    public $includeHeader = true;
    /**
     * @var string
     * tag for header container
     */
    public $headerTag = 'h3';
    /**
     * @var string
     * class for header container
     */
//    public $headerClass = "";
    /**
     * @var string
     * id for header container
     */
//    public $headerId = "";
    /**
     * @var string
     * text for header container
     */
//    public $headerContent;
    /**
     * @var string
     * text for empty dropdown field `flag_type`
     */
    public $prompt;
    
    /**
     * @var array options for the Widget.
     * @see self::availableHeaderOptions() for list of available options.
     */
    public $headerOptions = [];
    /**
     * @var array the options for Widget.
     * @see self::availableOptions() for list of available options.
     */
    public $options = [];

    public function run()
    {
        $model = new $this->flagNoteModelClass;

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
        
        return $this->render('flag', [
            'model' => $model,
            'form' => $this->form,
        ]);
    }
}
