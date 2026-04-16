<?php
/**
 * News list view
 */
use yii\helpers\Url;
?>

<div class="container">
    <div class="row category-cell article-list">
        <div class="col-md-3 hidden-xs">
            <?php echo $this->render('/layouts/category-tabs', [
                'data'      => $categorys ?? [],
                'category'  => $category ?? null,
                'linkPath'  => '/news',
            ]); ?>
        </div>

        <div class="col-md-9 col-xs-12">
            <?php echo $this->render('/layouts/article-images-list', [
                'data'     => $data ?? [],
                'category' => $category ?? [],
            ]); ?>
        </div>
    </div>
</div>

