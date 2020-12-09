<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:17:19
 */

use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i><?php echo $category->cate_name ?? '栏目名'; ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($data['items'])) : ?>
                <?php foreach ($data['items'] as $item) : ?>
                <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                    <div class="link-title"><?=$item['art_title']?></div>
                    <div class="thumbnail" style="width:18%">
                        <img class="lazy"
                            data-original="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                            alt="<?php echo $item['art_title'] ?? ''; ?>">
                        <?php if ($item['category_id']==10) : ?>
                        <div class="caption captionc">
                            <?php else: ?>
                            <div class="caption">
                                <?php endif; ?>
                                <p class="text-center"><?php echo $item['art_title'] ?? '-'; ?></p>
                                <!--                                    <p class="pull-left">--><?php //echo $item['art_title'] ?? '-'; ?>
                                <!--</p>-->
                                <!--                                    <p class="pull-right">价格暂无</p>-->
                            </div>
                        </div>
                </a>
                <?php endforeach; ?>
                <?php else: ?>
                <p>暂无内容</p>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!isset($disabledPagination))
            echo $this->render('/layouts/green-pagination', ["data" => $data ?? []]); ?>
    </div>
</div>