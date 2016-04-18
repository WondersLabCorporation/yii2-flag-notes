<?php
use WondersLabCorporation\yii2\flagNotes\models\FlagNote;
use yii\bootstrap\Html;

?>

<?= $form->field($model, 'flag_type')->dropDownList(FlagNote::getFlagTypeTexts(), $flagRypeParams); ?>
<?= $form->field($model, 'flag_description')->textArea(); ?>