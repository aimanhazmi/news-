<?php
/**
 * Created by aiman
 * Author: aiman
 * Date: 2025/8/24
 * Time: 15:11
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="header-topbar-option-demo" class="page-header-topbar">
    <nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 11;"
         class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span
                        class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a id="logo" href="<?php echo Url::to(['@admin/index.html']); ?>" class="navbar-brand">
                <span class="fa fa-rocket"></span>
                <span style="display: none" class="logo-text-icon">
					<?php echo Html::img(($this->params['userinfo']['avatar'] ?? false)?:Yii::$app->params['defaultAvatar'], ['class' => 'img-responsive img-circle']) ?>
				</span>
            </a>
        </div>
        <div class="topbar-main">

            <ul class="nav navbar navbar-top-links navbar-right mbn">
                <li class="dropdown">
                    <a data-hover="dropdown" href="javascript:void(0)" class="dropdown-toggle"><i
                                class="fa fa-bell fa-fw"></i></a>
                </li>

                <li class="dropdown topbar-user">
                    <a data-hover="dropdown" href="javascript:void(0)" class="dropdown-toggle">
                        <?php echo Html::img(($this->params['userinfo']['avatar'] ?? false)?:Yii::$app->params['defaultAvatar'], ['class' => 'img-responsive img-circle']) ?>
                        &nbsp;<span
                                class="hidden-xs"><?php echo $this->params['userinfo']['nickname'] ?? ''; ?></span>&nbsp;<span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user pull-right">
                        <li><a href="<?php echo Url::to([Yii::$app->params['adminLogoutUrl']]); ?>"><i class="fa fa-key"></i>退出</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

