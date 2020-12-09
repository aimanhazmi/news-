<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:18:46
 */
use yii\helpers\Url;
?>

<div class="category-nav-tabs">
    <ul class="nav nav-tabs" role="tablist">
        <?php if (!empty($tabsData['items'])): ?>
            <?php foreach ($tabsData['items'] as $key => $item) : ?>
                <li role="presentation" <?php if ($key == 0)
                    echo ' class="active"'; ?>>
                    <a href="#tab-<?php echo $item["id"]; ?>" data-toggle="tab">
                        <?php echo $item["cate_name"]; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li role="presentation">
                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">暂无分类</a>
            </li>
        <?php endif; ?>
    </ul>
    <a href="/news.html" class="more">更多>></a>
</div>

<div class="tab-content category-nav-tabs-contents">
    <?php if (!empty($tabsData['items'])): ?>
        <?php foreach ($tabsData['items'] as $key => $item) : ?>
            <div role="tabpanel" class="tab-pane <?php if ($key == 0)
                echo 'active'; ?>" id="tab-<?php echo $item["id"]; ?>">
                <div class="row">
                    <?php if (!empty($item['contents'])): ?>
                        <div class="col-md-6">
                            <div class="list-group">
                                <?php foreach ($item['contents'] as $index => $article) : ?>
                                    <?php if (($index + 1) % 2 == 1):?>
                                        <a href="<?php echo Url::to('/article-' . $article['id'] . '.html'); ?>" class="list-group-item"><?php echo $article['art_title'];?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-group">
                                <?php foreach ($item['contents'] as $index => $article) : ?>
                                <?php if (($index + 1) % 2 == 0): ?>
                                        <a href="<?php echo Url::to('/article-' . $article['id'] . '.html'); ?>" class="list-group-item"><?php echo $article['art_title'];?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>暂无分类内容</p>
    <?php endif; ?>
</div>
