<?php
/**
 * Created by PhpStorm.
 * User: whts
 * Date: 2020-05-08
 * Time: 10:17
 */
use yii\helpers\Url;
if($type == "cases"){
    $tags = [
        "教育" => "iicon icon__yaoguang",
        "金融" => "iicon icon__wuqu",
        "游戏" => "icon icon__baiju",
    ];
    $en = "CUSTOMERS";
}else{
    $tags = [
        "媒体报道" => "icon__refresh",
        "技术分享" => "icon__survey",
        "安全资讯" => "icon__usafe",
        "最新动态" => "icon__survey",
    ];
    $en = "Industry News";
}
?>
<div class="submain-navbg"></div>
<div class="main">
    <div class="sub-main ucases">
        <div class="nav-wrap">
            <h2><?php echo $category["title"]; ?><span class="en"><?php echo $en; ?></span></h2>
            <ul class="main-nav">
                <?php foreach($this->params[$type] as $key=>$item):?>
                    <li class="first-node">
                        <a href="<?php echo Url::to('/list-'.$item["id"].'-'.$key.'-'.$type.'.html'); ?>">
                            <span class="indus <?php  echo isset($tags[$item["title"]])?$tags[$item["title"]]:'iicon icon__wuqu';?>"></span> <?php echo $item["title"]; ?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php echo $this->render('/layouts/'.$type.'-content',['data'=>$data,'category'=>$category,'seq'=>$seq,'products'=>$products]);?>
    </div>
</div>
<?php echo $this->render('/layouts/script',['seq'=>$seq]);?>
<?php echo $this->render("../layouts/common");?>
