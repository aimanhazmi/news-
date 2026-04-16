<?php
/**
 * Created by aiman
 * User: whts
 * Date: 2025-05-09
 * Time: 11:16
 */
use yii\helpers\Url;
?>
<div class="submain-navbg"></div>
<div class="main">
    <div class="sub-main pos-rel">
        <div class="content-wrap news-detail">
            <div class="bread-crumbs">
                <a href="#"><?php echo $second_name; ?><i class="en">></i></a>
                <a href="#"> <?php echo $first_name; ?> <i class="en">></i></a>
            </div>
            <div class="news-detial-top">
                <div class="rili-wrap">
                    <div class="news-rili">
                        <span class="news-rili-y"><?php echo date("M",$data["reltime"]); ?></span>
                        <span class="news-rili-r"><?php echo date("d",$data["reltime"]);?></span>
                    </div>
                </div>
                <div class="news-list">
                    <div class="news-list-title">
                        <p class="title"><?php echo $data["art_title"]; ?></p>
                        <p class="time pull-left"><?php echo $data["art_author"]; ?></p>
                        <p class="time pc-none pull-right"><?php echo $data["reltime"]; ?></p>
                    </div>
                </div>
            </div>
            <div class="news-con">
                <?php echo $data["art_content"]; ?>
            </div>
            <div class="news-page">
                <?php if(isset($up_down[0]["id"])): ?>
                <div>
                    <h3><<上一篇</h3> <a href="<?php echo Url::to('detail-'.$up_down[0]["id"].'-'.$up_down[0]['category_id'].".html"); ?>"><?php echo $up_down[0]["art_title"]; ?></a>
                </div>
                <?php endif;?>
                <?php if(isset($up_down[1]["id"])): ?>
                <div>
                    <h3>下一篇>></h3>
                    <a href="<?php echo Url::to('detail-'.$up_down[1]["id"].'-'.$up_down[1]['category_id'].".html"); ?>"><?php echo $up_down[1]["art_title"]; ?></a>
                </div>
                <?php endif;?>
            </div>
        </div>
        <div class="nav-wrap top-news">
            <h2>热门文章<span class="en">TOP NEWS</span></h2>
            <ul class="main-nav">
                <?php foreach($tops as $item): ?>
                    <li class="first-node father active">
                        <a href="report.php">
                            <p class="top-news-title"><?php echo $item["art_title"];?></p>
                            <p class="time pull-left"><?php echo $item["reltime"]; ?></p>
                            <p class="more">阅读全文>></p>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>
<?php echo $this->render("../layouts/common");?>

