<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025-12-08 23:27:42
 */
?>
<div class="container">

    <div class="row category-cell article-list article-pic-content-list">

        <div class="col-md-12">
            <?php echo $this->render('/layouts/article-text-images-list-search', [
                'data'     => $data ?? [],
                'category' => json_decode(json_encode(['cate_name' => '搜索结果']))
            ]); ?>
        </div>
    </div>
</div>

