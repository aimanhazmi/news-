<?php
/**
 * Created by 李垒(李雷) <leili@yoozoo.com>.
 * User: lilei
 * Date: 2018/1/22
 * Time: 21:29
 */
use app\assets\AdminAsset;
use app\assets\FormAsset;
use yii\helpers\Url;
use app\components\ModelForm;

FormAsset::register($this);
AdminAsset::set('toastr.bundle,bootstrap3-dialog.bundle,modify.bundle', $this);
?>
<?php echo AdminAsset::addCss($this, "/static/vendors/umeditor/1.2.2/themes/default/css/umeditor.css") ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading" data-default="title">loading...</div>
                <div class="panel-body pan">
                    <?php echo ModelForm::display($model, $model->getFormFields()); ?>
                </div>
            </div>
        </div>
    </div>
<?php echo AdminAsset::addJs($this, "/static/vendors/umeditor/1.2.2/umeditor.config.js"); ?>
<?php echo AdminAsset::addJs($this, "/static/vendors/umeditor/1.2.2/umeditor.min.js"); ?>
<?php echo AdminAsset::addJs($this, "/static/vendors/umeditor/1.2.2/lang/zh-cn/zh-cn.js"); ?>
<script type="text/javascript">
<?php $this->beginBlock('js');echo PHP_EOL;?>
var pagesConfig = {
    submitType: "<?php echo $model->isNewRecord ? 'POST' : 'PATCH' ?>",
    baseUrl: "<?php echo Url::to('/admin/article') ?>",
    manageUrl: "<?php echo Url::to('/admin/article/manage') ?>",
    uploadImageUrl: "<?php echo Url::to('/admin/file/image') ?>",
};
<?php $this->endBlock();?>
</script>
<?php $this->registerJs($this->blocks['js'], \yii\web\View::POS_HEAD); ?>

<script type="text/javascript">
    <?php $this->beginBlock('js');echo PHP_EOL;?>
    // var um = UM.getEditor('umeditor');
    var um = UM.getEditor('umeditor',{
        initialFrameWidth : 600,
        initialFrameHeight: 600,
        imageUrl: "<?php echo Url::to('/admin/file/image') ?>",
        // serverUrl: '/server/ueditor/controller.php'
    });
    <?php $this->endBlock();?>
</script>
<?php $this->registerJs($this->blocks['js'], \yii\web\View::POS_END); ?>

