<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 21:59:25
 */

use yii\helpers\Url;

$linkPath = $linkPath ?? '/categorylist';

?>



<div class="row">

    <div class="list-group">
        <?php if(isset($categorys)) {?>
        <a class="list-group-item category-title" href="<?php echo "category-".$categorys->id.".html"; ?>">
            <?php } else { ?>
            <a class="list-group-item category-title" href="<?php echo "category-".$category->id.".html"; ?>">
                <?php } ?>
                <i class="icon icon-bar-chart"></i>
                <?php
            if(isset($categorys)){
                echo $categorys->title ?? '栏目名';
             }else{
                echo $category->cate_name ?? '栏目名'; 
            }

             ?>
            </a>


            <?php if (!empty($data['items'])) : ?>
            <?php foreach ($data['items'] as $key=>$item) : ?>

                <a class="list-group-item  slcids"
                    href="<?php echo Url::to($linkPath . '-' . $item['id'] . '.html'); ?>">
                    <?php echo $item["cate_name"]; ?>
                    <input type="hidden" name="slcids" value="<?=$item['id']?>">
                    <input type="hidden" name="slcids" value="<?=$item['cate_name']?>">
  
                </a>

                <?php endforeach; ?>
                <?php else: ?>
                <p>&nbsp;&nbsp;栏目列表未获取</p>
                <?php endif; ?>

    </div>

</div>