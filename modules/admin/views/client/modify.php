<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/1/22
 * Time: 21:29
 */
use app\assets\AdminAsset;
use app\assets\FormAsset;
use yii\helpers\Url;
use app\components\ModelForm;

FormAsset::register($this);
AdminAsset::set('toastr.bundle,bootstrap3-dialog.bundle,modify.bundle', $this);
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading" data-default="title">loading...</div>
                <div class="panel-body pan">
                    <?php echo ModelForm::display($model, $model->getClientFormFields()); ?>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
<?php $this->beginBlock('js');echo PHP_EOL;?>
var pagesConfig = {
    submitType: "<?php echo $model->isNewRecord ? 'POST' : 'PATCH' ?>",
    baseUrl: "<?php echo Url::to(['/admin/client']) ?>",
    manageUrl: "<?php echo Url::to(['/admin/client/manage']) ?>",
    uploadImageUrl: "<?php echo Url::to(['file/image']) ?>",
};
<?php $this->endBlock();?>
</script>
<?php $this->registerJs($this->blocks['js'], \yii\web\View::POS_HEAD); ?>

