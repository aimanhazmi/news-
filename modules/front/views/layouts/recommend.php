<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:15:09
 */

use yii\helpers\Url;

?>
<div class="recommend">
    <div class="all-tips pull-left">
        <span class="lable">大家都在看：</span>
        <a href="<?php echo Url::to('/search.html'); ?>?wd=花">花</a>
        <a href="<?php echo Url::to('/search.html'); ?>?wd=松">松</a>
        <a href="<?php echo Url::to('/search.html'); ?>?wd=红玉兰">红玉兰</a>
        <a href="<?php echo Url::to('/search.html'); ?>?wd=紫叶情">紫叶情</a>
        <a href="<?php echo Url::to('/search.html'); ?>?wd=美人梅">美人梅</a>
    </div>
    <div class="input-group pull-right">
        <input type="text" class="form-control" name="wd" placeholder="请输入您要搜索的苗木名称">
        <span class="input-group-btn">
            <button class="btn btn-default search-btn" type="button">搜索</button>
        </span>
    </div>
</div>
