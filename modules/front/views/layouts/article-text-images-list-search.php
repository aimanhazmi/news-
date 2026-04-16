<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025-12-05 22:20:02
 */

use yii\helpers\Url;

?>



<div class="row base_list_content search-bd">

    <?php if (!empty($data['items'])): ?>
    <?php foreach ($data['items'] as $key => $val): ?>



    <div class="hidden-xs row p-tb-10">
        <div class="col-xs-9">
            <?php if ($key>=1): ?>
            <hr>
            <?php endif; ?>
            <div class="row col-xs-4">
                <a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>">
                    <div class="link-title"><?=$val['art_title']?></div>
                    <div class="row sfimg">
                        <img class="media-object"
                            src="<?php echo $val['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                            alt="<?=$val['art_title']?>">
                    </div>
                </a>

            </div>
            <div class="col-xs-8 carefullychosen">
                <a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>">
                    <h4 class=""><?=$val['art_title']?></h4>
                </a>
                <div class="p-tb-10"><?=$val['categoryd_name']?> |
                    <?php echo date('Y-m-d H:m:s', $val['reltime']); ?>
                </div>
                <div><?=$val['description']?></div>

            </div>

        </div>
        <div class="col-xs-3">




        </div>


    </div>



    <div class="visible-xs row">
        <div class="col-xs-12">
            <?php if ($key>=1): ?>
            <hr>
            <?php endif; ?>

            <div class="row">
                <div class="col-xs-12">
                    <a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>">
                    <div class="link-title"><?=$val['art_title']?></div>
                        <div class="sfimg-m-one">
                            <img class="media-object"
                                src="<?php echo $val['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                alt="<?=$val['art_title']?>">
                        </div>
                    </a>

                </div>


                <div class="col-xs-12 carefullychosen">
                    <a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>">
                        <h4 class=""><?=$val['art_title']?></h4>
                    </a>
                    <div class="p-tb-10"><?=$val['categoryd_name']?> |
                        <?php echo date('Y-m-d H:m:s', $val['reltime']); ?>
                    </div>
                    <div><?=$val['description']?></div>

                </div>
            </div>

        </div>



    </div>




    <?php endforeach; ?>
    <?php else: ?>
    <p style="text-indent: 2em; margin-top: 10px;">没有更多<?php if (isset($_GET['wd']))
                        echo " <span style='color: red'>{$_GET['wd']}</span> 相关的"; ?>内容了</p>
    <?php endif; ?>


    <div class="hidden-xs row">
        <?php if (!isset($disabledPagination))
            echo $this->render('/layouts/green-pagination', ["data" => $data ?? []]); ?>
    </div>

    <div class="visible-xs">
        <?php if (!isset($disabledPagination))
            echo $this->render('/layouts/green-pagination', ["data" => $data ?? []]); ?>
    </div>



</div>






<!--

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $category->cate_name ?? '栏目名'; ?></h3>
    </div>
    <div class="panel-body">
        <ul class="media-list">
            <?php if (!empty($data['items'])): ?>
                <?php foreach ($data['items'] as $key => $val): ?>
                    <li class="media">
                        <div class="col-md-4">
                            <a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>">
                                <img class="media-object lazy" alt="" data-original="<?php echo $val["img_thumb"]; ?>">
                            </a>    
                        </div>
                        <div class="col-md-8">
                            <a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>">
                                <h4 class="media-heading"><?php echo $val["art_title"]; ?></h4>
                            </a>
                            <p><?php echo $val["description"]; ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-indent: 2em; margin-top: 10px;">没有更多<?php if (isset($_GET['wd']))
                        echo " <span style='color: red'>{$_GET['wd']}</span> 相关的"; ?>内容了</p>
            <?php endif; ?>
        </ul>
        <?php if (!isset($disabledPagination))
            echo $this->render('/layouts/green-pagination', ["data" => $data ?? []]); ?>
    </div>
</div>

-->