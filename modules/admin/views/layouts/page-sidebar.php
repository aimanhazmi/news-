<?php
/**
 * Created by aiman
 * Author: aiman
 * Date: 2025/8/24
 * Time: 15:13
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu;
use app\modules\admin\service\SysResourcesService;

$items           = SysResourcesService::getLeftSidebar(['init-third-level' => true]);
$breadcrumbsPath = Yii::$app->params['breadcrumbs-path'] ?? '';
?>
<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
    <div class="sidebar-collapse menu-scroll" data-active-pathinfo="/<?php echo yii::$app->request->pathInfo; ?>"
         data-breadcrumbs-path="<?php echo $breadcrumbsPath; ?>">
        <?php $userPanel = '
            <li class="user-panel">
                <div class="thumb">
                    ' . Html::img($this->params['userinfo']['avatar'] ?? '', ['class' => 'img-circle']) . '
                </div>
                <div class="info">
                
                    <p>' . ($this->params['userinfo']->nickname ?? '') . '</p>
                    <ul class="list-inline list-unstyled">
                        <li><a href="javascript:void(0)" data-bak-hover="tooltip" title=""
                               data-original-title="Profile"><i class="fa fa-user"></i></a>
                        </li>
                        <li><a href="javascript:void(0)" data-bak-hover="tooltip" title="" data-original-title="Mail"><i
                                        class="fa fa-envelope"></i></a>
                        </li>
                        <li><a href="javascript:void(0)" data-bak-hover="tooltip" title="" data-toggle="modal"
                               data-target="#modal-config" data-original-title="Setting"><i class="fa fa-cog"></i></a>
                        </li>
                        <li><a href="' . Url::to([Yii::$app->params['adminLogoutUrl']]) . '" data-hover="tooltip" title="退出"><i
                                        class="fa fa-sign-out"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </li>';

        $menu = Menu::widget([
            'encodeLabels'    => false,
            'hideEmptyItems'  => true,
            'activateParents' => 'active',
            'activeCssClass'  => 'active',
            'activateItems'   => true,
            'options'         => [
                'class' => 'nav',
                'id'    => 'side-menu',
            ],
            'items'           => $items,
        ]);

        $ulBegin = '<ul id="side-menu" class="nav">';
        echo str_replace($ulBegin, $ulBegin . $userPanel, $menu);
        ?>
    </div>
</nav>

