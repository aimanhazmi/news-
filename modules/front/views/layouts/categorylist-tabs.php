<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 21:59:25
 */

use yii\helpers\Url;

$linkPath = $linkPath ?? '/categorylist';

?>




<div class="sub_left">
    <div class="sub_nav">
        <ul>
            <li class="now"><a href="<?php echo Url::to('/category-'.$categorys->id.'.html'); ?>"><i
                        class="icon icon-bar-chart"></i>
                    <?php echo $categorys->title ?? '栏目名'; ?></a></li>
            <?php if (!empty($data['items'])) : ?>
            <?php foreach ($data['items'] as $key=>$item) : ?>

            <a href="<?php echo Url::to($linkPath . '-' . $item['id'] . '.html'; ?>" class="list-group-item slcids">
                <?php echo $item["cate_name"]; ?>
                <input type="hidden" name="slcids" value="<?=$item['cate_name']?>">
            </a>
            </li>



            <?php endforeach; ?>
            <?php else: ?>
            <p>&nbsp;&nbsp;栏目列表未获取</p>
            <?php endif; ?>



        </ul>
    </div>
</div>