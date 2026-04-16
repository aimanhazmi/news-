<?php
/**
 * Created by aiman
 * User: whts
 * Date: 2025-05-08
 * Time: 10:45
 */
use yii\helpers\Url;
?>
<ul class="web-paging">
    <li class="other-btn"><a href="<?php echo Url::to('/list-'.$category['id'].'-'.$seq.'-news.html?page_no=1'); ?>">首页</li>
    <?php if($data["total_pages"] > 1 && $data["current"] > 1):?>
    <li class="other-btn"><a class="icon__pc-left" href="<?php echo Url::to('/list-'.$category['id'].'-'.$seq.'-news.html?page_no='.($data["current"]-1)); ?>"></a></li>
    <?php endif;?>
    <?php if($data["total_pages"] < 5):?>
    <?php for($i=1;$i<$data["total_pages"]+1;$i++): ?>
        <li class="<?php if($data["current"] == $i) echo 'active'; else echo 'nan-btn'?>"><a href="<?php echo Url::to('/list-'.$category['id'].'-'.$seq.'-news.html?page_no='.$i); ?>"><?php echo $i;?></a></li>
    <?php endfor;?>
    <?php endif;?>
    <?php if($data["total_pages"] > 4):?>
        <?php for($i=$data["current"]-2;$i<$data["current"]+3;$i++): ?>
            <li class="<?php if($data["current"] == $i) echo 'active'; else echo 'nan-btn'?>"><a href="<?php echo Url::to('/list-'.$category['id'].'-'.$seq.'-news.html?page_no='.$i); ?>"><?php echo $i;?></a></li>
        <?php endfor;?>
    <?php endif;?>
    <?php if($data["current"] < $data["total_pages"]): ?>
    <li class="other-btn"><a class="icon__pc-right" href="<?php echo Url::to('/list-'.$category['id'].'-'.$seq.'-news.html?page_no='.($data["current"]+1)); ?>"></a></li>
    <?php endif;?>
    <li class="other-btn"><a href="<?php echo Url::to('/list-'.$category['id'].'-'.$seq.'-news.html?page_no='.$data["total_pages"]); ?>">末页</a></li>
    <li><span class="pageinfo">共 <strong><?php echo $data["total_pages"]; ?></strong>页<strong><?php echo $data["total_items"]; ?></strong>条</span></li>
</ul>
