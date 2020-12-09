<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:20:02
 */

use yii\helpers\Url;

?>



<div class="base_list_content" style="padding-top:0px;">

    <?php if (!empty($data['items'])): ?>
    <?php foreach ($data['items'] as $key => $val): ?>


    <div class="item">
        <div class="p">
            <a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>">
                <div class="link-title"><?=$val['art_title']?></div>
                <img class="media-object lazy" alt="" data-original="<?php echo $val["img_thumb"]; ?>">
            </a>
        </div>
        <div class="r">
            <div class="t"><a href="<?php echo Url::to('/article-' . $val['id'] . '.html'); ?>"
                    target="_blank"><?php echo $val["art_title"]; ?></a></div>
            <div class="c"><?php echo $val['category_name']; ?> / · <?php echo date('Y-m-d', $val['reltime']); ?></div>
            <div class="d">
                <?php echo $val["description"]; ?>
            </div>
        </div>
    </div>




    <?php endforeach; ?>
    <?php else: ?>
    <p style="text-indent: 2em; margin-top: 10px;">没有更多<?php if (isset($_GET['wd']))
                        echo " <span style='color: red'>{$_GET['wd']}</span> 相关的"; ?>内容了</p>
    <?php endif; ?>



    <?php if (!isset($disabledPagination))
            echo $this->render('/layouts/green-pagination', ["data" => $data ?? []]); ?>




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