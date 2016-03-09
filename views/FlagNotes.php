<?php
use WondersLabCorporation\yii2\flagNotes\models\FlagNote;
use yii\bootstrap\Html;

if ($model->includeHeader) {
    echo Html::tag($model->headerTag, $model->headerContent, ['class' => $model->headerClass, 'id' => $model->headerId]);
}

$flagRypeParams = [];
if ($prompt = $model->prompt) {
    $flagRypeParams['prompt'] = $prompt;
}
echo $form->field($model, 'flag_type')->dropDownList(FlagNote::getFlagTypeTexts(), $flagRypeParams);
echo $form->field($model, 'flag_description')->textArea();
