<?php
/**
 * Created by aiman
 * User: whts
 * Date: 2025-05-07
 * Time: 17:32
 */
$icons = [
    0 => 'icon__uhost',
    1 => 'icon__uphost',
    2 => 'icon__unet',
    3 => 'icon__udb',
    4 => 'icon__ufile',
    5 => 'icon__ucdn',
    6 => 'icon__ulb'
];

?>
<div class="content-wrap">
    <?php foreach ($data['items'] as $item) : ?>
    <div class="case-wrap">
        <a href="#">
            <div class="logo-wrap">
                <img src="<?php echo $item['img_thumb']; ?>">
            </div>
        </a>
        <div class="content">
            <a href="#"><h2><?php echo $item["art_title"]; ?></h2></a>
            <p class="c-company">
                <span class="c-company-title">厂商：</span>
                <?php echo $item["keywords"]; ?>
                <span class="c-company-name"></span>
            </p>
        </div>
        <div class="cases-used">
            <div class="intro">
                <?php echo $item["description"]; ?>
            </div>
            <p class="used-title">使用产品：</p>
            <ul class="proud">
                <?php foreach(explode(";",$item["product"]) as $v):?>
                <a href="#">
                    <li>
                        <i class="prod <?php echo $icons[$v]; ?>"></i>
                        <?php echo $products[$v];?>
                    </li>
                </a>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <?php endforeach;?>
</div>
