<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\service\Generator */

?>
<div class="module-form">
    <?php
    echo $form->field($generator, 'name');
    echo $form->field($generator, 'selfModel');
    echo $form->field($generator, 'originalService');
//    echo $form->field($generator, 'vendorName');
//    echo $form->field($generator, 'packageName');
//    echo $form->field($generator, 'namespace');
//    echo $form->field($generator, 'type')->dropDownList($generator->optsType());
//    echo $form->field($generator, 'keywords');
//    echo $form->field($generator, 'license')->dropDownList($generator->optsLicense(), ['prompt'=>'Choose...']);
//    echo $form->field($generator, 'title');
//    echo $form->field($generator, 'description');
////    echo $form->field($generator, 'authorName');
//    echo $form->field($generator, 'authorEmail');
    echo $form->field($generator, 'outputPath');
    ?>
</div>