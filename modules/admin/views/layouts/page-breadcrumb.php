<?php
/**
 * Created by aiman
 * Author: aiman
 * Date: 2025/8/24
 * Time: 15:16
 */

use yii\helpers\Url;

?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title" breadcrumbs-title="title">loading...</div>
    </div>
    <ol class="breadcrumb page-breadcrumb">
        <li breadcrumbs-posion="posion"><i class="fa fa-home"></i>&nbsp;<a href="<?php echo Url::to(['@admin/']); ?>">管理首页</a>&nbsp;&nbsp;<i
                    class="fa fa-angle-right"></i>&nbsp;&nbsp;
        </li>
    </ol>
    <div class="clearfix"></div>
</div>