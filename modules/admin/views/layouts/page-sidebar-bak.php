<?php
/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/8/24
 * Time: 15:13
 */
use app\components\SysSidebar;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
	<div class="sidebar-collapse menu-scroll">
		<ul id="side-menu" class="nav" data-side-menu='<?php echo json_encode(SysSidebar::getList()); ?>' data-active-pathinfo="/<?php echo yii::$app->request->pathInfo; ?>">
			<li class="user-panel">
				<div class="thumb">
                    <?php echo Html::img($this->params['userinfo']['avatar']??'', ['class' => 'img-circle']) ?>
				</div>
				<div class="info">
					<p><?php echo $this->params['userinfo']['displayName'] ?></p>

					<ul class="list-inline list-unstyled">
						<li><a href="javascript:void(0)" data-bak-hover="tooltip" title="" data-original-title="Profile"><i class="fa fa-user"></i></a>
						</li>
						<li><a href="javascript:void(0)" data-bak-hover="tooltip" title="" data-original-title="Mail"><i class="fa fa-envelope"></i></a>
						</li>
						<li><a href="javascript:void(0)" data-bak-hover="tooltip" title="" data-toggle="modal" data-target="#modal-config" data-original-title="Setting"><i class="fa fa-cog"></i></a>
						</li>
						<li><a href="<?php echo Url::to(['@admin/user/logout']); ?>" data-hover="tooltip" title="退出"><i
										class="fa fa-sign-out"></i></a>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</li>
            <?php foreach (SysSidebar::getList() as $sidebar) {
                ; ?>
				<li>
					<a href="<?php echo $sidebar['target']; ?>"
					   data-pathinfo="<?php echo $sidebar['pathinfo']; ?>"
					   data-title="<?php echo $sidebar['title']; ?>"
					>
						<i class="<?php echo $sidebar['icon_class']; ?>">
							<div class="icon-bg bg-pink"></div>
						</i>
						<span class="menu-title"><?php echo $sidebar['title']; ?></span>
                        <?php if ($sidebar['type'] == 'category') { ?>
							<span class="fa arrow"></span>
                        <?php } ?>
					</a>

					<!--遍历下级菜单-->
                    <?php if (isset($sidebar['children'])) { ?>
						<ul class="nav nav-second-level collapse">
                            <?php foreach ($sidebar['children'] as $second_sidebar) {
                                ; ?>
								<li>
									<a href="<?php echo $second_sidebar['target']; ?>"
									   data-pathinfo="<?php echo $second_sidebar['pathinfo']; ?>"
									   data-title="<?php echo $second_sidebar['title']; ?>"
									   data-method="<?php echo isset($second_sidebar['title'])?$second_sidebar['title']:'default'; ?>"
									>
										<?php !isset($second_sidebar['icon_class']) && $second_sidebar['icon_class'] = 'fa fa-angle-right'; ?>
										<i class="<?php echo $second_sidebar['icon_class']; ?>"></i>

										<span class="menu-title"><?php echo $second_sidebar['title']; ?></span>
                                        <?php if ($second_sidebar['type'] == 'category') { ?>
											<span class="fa arrow"></span>
                                        <?php } ?>
									</a>

									<!--遍历下级菜单-->
                                    <?php if (isset($second_sidebar['children']) && $second_sidebar['type'] == 'category' ) { ?>
										<ul class="nav nav-third-level collapse">
                                            <?php foreach ($second_sidebar['children'] as $third_sidebar) {
                                            ; ?>
	                                            <li>
	                                            <a href="<?php echo $third_sidebar['target']; ?>"
	                                               data-pathinfo="<?php echo $third_sidebar['pathinfo']; ?>"
	                                               data-title="<?php echo $third_sidebar['title']; ?>"
	                                            >
		                                            <i class="fa fa-angle-double-right">
			                                            <div class="icon-bg bg-pink"></div>
		                                            </i>
		                                            <span class="menu-title"><?php echo $third_sidebar['title']; ?></span>
	                                            </a>
	                                            </li>
                                            <?php } ?>
										</ul>
                                    <?php } ?>

								</li>
                            <?php } ?>
						</ul>
                    <?php } ?>
				</li>
            <?php }; ?>
		</ul>
	</div>
</nav>

