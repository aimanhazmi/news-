<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:17:19
 */

use yii\helpers\Url;

?>




<?php if (!empty($data['items'])) : ?>
<?php foreach ($data['items'] as $item) : ?>



<a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">


    <div class="item">
        <div class="p">
            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>" target="_blank">
                <div class="link-title"><?=$item['art_title']?></div>
                <img class="lazy"
                    data-original="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                    alt="<?php echo $item['art_title'] ?? ''; ?>">
            </a>
        </div>
        <div class="r">
            <div class="t"><a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>"
                    target="_blank"><?php echo $item['art_title'] ?? ''; ?></a></div>
            <div class="c">资讯 / · 2019-04-12 07:12</div>
            <div class="d">
                <?php echo $item['description'] ?? ''; ?>
            </div>
        </div>
    </div>
</a>

<?php endforeach; ?>
<?php else: ?>
<p>暂无内容</p>
<?php endif; ?>


<?php if (!isset($disabledPagination))
            echo $this->render('/layouts/green-pagination', ["data" => $data ?? []]); ?>
</div>