<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025-12-05 22:17:19
 */

use yii\helpers\Url;

?>



<?php if (!empty($data['items'])) : ?>
<?php foreach ($data['items'] as $keys=>$item) : ?>


<a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">

    <div class="row p-tb-10">
        <div class="col-xs-12 col-md-4">
            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                <div class="link-title"><?=$item['art_title']?></div>
                <div class="sfimg">
                    <img class="media-object"
                        src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                        alt="<?=$item['art_title']?>">
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-md-8 carefullychosen">
            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                <h4 class=""><?=$item['art_title']?></h4>
            </a>
            <div class="p-tb-10"><?=$item['category_name']?> |
                <?php echo date('Y-m-d H:m:s', $item['reltime']); ?>
            </div>
            <div><?=$item['description']?></div>
        </div>
    </div>
</a>
<hr>
<?php endforeach; ?>
<?php else: ?>
<p>暂无内容</p>
<?php endif; ?>


<?php if (!isset($disabledPagination))
   echo $this->render('/layouts/green-pagination', ["data" => $data ?? []]); 
 ?>