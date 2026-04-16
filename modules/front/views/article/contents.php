<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025-12-05 23:01:09
 */
use yii\helpers\Url;
?>



<div class="row">


    <div class="hidden-xs col-md-2">


        <div class="row sub_left" style="padding-top:30px;">
            <script type="text/javascript">
            $(window).scroll(function() {
                var h_num = $(window).scrollTop();
                if (h_num > 310) {
                    $('.show_tool').addClass('show_fixer');
                } else {
                    $('.show_tool').removeClass('show_fixer');
                }
            });
            </script>




            <div class="show_tool" style="position:relative;z-index:1;margin-bottom:150px">
                <a href="categorylist-<?=$article['category_id'];?>.html"
                    class="show_cat"><?=$article['category_names'] ;?></a>
                <div class="show_time_y"><b class="name"><?php echo date('Y', $article['reltime']); ?></b></div>
                <div class="show_time_m"><?php echo date('m/d', $article['reltime']); ?></div>
                <div class="show_time_i"><?php echo date('H:i:s', $article['reltime']); ?></div>
                <div class="show_topview"></div>



                <div class="show_line_t"><b class="name">分享</b></div>
                <div class="show_share">
                    <div class="bdsharebuttonbox"> <a class="bds_weixin icon-wechat" data-cmd="weixin"></a><a
                            class="bds_tsina icon-weibo" data-cmd="tsina"></a><a class="bds_sqq icon-qq"
                            data-cmd="sqq"></a><a class="bds_qzone icon-star" data-cmd="qzone"></a> </div>
                </div>

                <script>
                window._bd_share_config = {
                    "common": {
                        "bdSnsKey": {},
                        "bdText": "",
                        "bdMini": "2",
                        "bdMiniList": false,
                        "bdPic": "",
                        "bdStyle": "0",
                        "bdSize": "16"
                    },
                    "share": {}
                };
                with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script'))
                    .src =
                    'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-
                        new Date() / 36e5)];
                </script>

                <!--
                <div class="show_line_t"><b class="name">评论</b></div>
                <div class="comment_count">
                    <a href="/"><i class="icon-comments-alt"></i><span id="comment_count"></span></a>
                </div>
                -->




            </div>



            <?php if($article['advs_info']) { ?>

            <?php foreach ($article['advs_info'] as $keys=>$item) : ?>


            <div class="item m-t-25">
                <a href=" <?=$item['adv_url']?>" rel="nofollow" target="_blank">
                    <div class="sfimg-pc-one">
                        <img src="<?=$item['adv_banner']?>" />
                    </div>
                </a>
            </div>

            <?php endforeach; ?>


            <?php } ?>


        </div>

    </div>



    <div class="col-md-7">


        <article class="row article p-t-5">
            <header>
                <h3 class="text-center"><?php echo $article['art_title'] ?? ''; ?></h3>

                <dl class="dl-inline">
                    <dt>来源：</dt>
                    <dd><?php echo $article['art_source'] ?? ''; ?></dd>

                    <dt>作者：</dt>
                    <dd><?php echo $article['art_author'] ?? ''; ?></dd>

                    <br class="visible-xs">

                    <dt>时间：</dt>
                    <dd><?php echo date('Y-m-d', $article['reltime']); ?></dd>


                    <dt>阅读：</dt>
                    <dd><?php echo $article['pv'] ?? ''; ?></dd>

                </dl>

            </header>


            <section class="content">


                <div class="sfimg-p-one">
                    <img class="media-object"
                        src="<?php echo $article['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                        alt="<?=$article['art_title']?>">
                </div>


                <p style="text-indent:2em;" id="content_id">
                    <?php echo $article['art_content'] ?? ''; ?>
                </p>

            </section>
            <footer class="p-t-30">

                <p class="text-important">
                    免责声明：本文系转载，版权归原作者所有；旨在传递信息，不代表本站的观点和立场。
                </p>


                <div class="pull-right">
                    <?php if($article['tags']) {?>
                    <span>标签：
                        <a href="<?php echo Url::to('/tag.html?wd='.$article['tags']); ?>">
                            <?php echo $article['tags'] ?? ''; ?>
                        </a>
                    </span>
                    <?php } ?>

                </div>

                <div class="show_line_t" style="margin-top:10px;">
                    <b class="name">THE END</b>
                </div>

                <div class="visible-xs">


                    <?php if($article['advs_info'][0]['adv_banner']) { ?>

                    <div class="item"><a href=" <?=$article['advs_info'][0]['adv_url']?>" rel="nofollow"
                            target="_blank">
                            <img src="<?=$article['advs_info'][0]['adv_banner']?>" />
                        </a>
                    </div>

                    <?php } ?>

                </div>



            </footer>


            <div class="">
                <h3>
                    <span class="">
                        相关热点
                    </span>
                </h3>

                <hr>

                <!-- 相关热点 -->

                <?php foreach ($articles_top_pv['items'] as $k=>$item) : ?>



                <div class="row p-tb-10">
                    <div class="col-md-4">
                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                            <div class="sfimg-m-one">
                                <img class="media-object"
                                    src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                    alt="<?=$item['art_title']?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-8 carefullychosen">
                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                            <h4 class=""><?=$item['art_title']?></h4>
                        </a>
                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                            <div><?=$item['description']?></div>
                        </a>
                        <div class="p-tb-10">

                            <div class="col-xs-3">
                                <div class="row">
                                    <a
                                        href="<?php echo Url::to('/categorylist-' . $item['category_id'] . '.html?catename='.$item['category_names']); ?>">
                                        <?=$article['category_names']?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <?php echo date('Y-m-d H:m:s', $item['reltime']); ?>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="row">
                                    浏览：<?=$item['pv']?>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <hr>

                <div class="visible-xs">
                <?php if($article['advs_info'][$k]['adv_banner']) { ?>

                <div class="item"><a href=" <?=$article['advs_info'][$k+1]['adv_url']?>" rel="nofollow" target="_blank">
                        <img src="<?=$article['advs_info'][$k+1]['adv_banner']?>" />
                        <!-- <div class="adv_title"><?=$article['advs_info'][$k+1]['adv_title']?></div>-->
                    </a>
                </div>

                <?php } ?>
                </div>



                <hr>

                <?php endforeach; ?>






            </div>




        </article>



    </div>




    <div class="hidden-xs col-md-3">


        <div class="row sub_right">
            <div class="show_user">

                <div class="labels">
                    <i class="icon icon-bell-alt"></i> 最新文章
                </div>


                <?php if($article['advs_info'][0]['adv_banner']) { ?>

                <div class="item"><a href=" <?=$article['advs_info'][0]['adv_url']?>" rel="nofollow" target="_blank">
                        <img src="<?=$article['advs_info'][0]['adv_banner']?>" />
                        <!-- <div class="adv_title"><?=$article['advs_info'][0]['adv_title']?></div>-->
                    </a>
                </div>

                <?php } ?>

                <div class="lists text-bg-color">
                    <ol class="list-unstyled">

                        <?php foreach ($articles_top_times['items'] as $keys=>$item) : ?>

                        <?php  if ($keys <= 5) { ?>


                        <li class="list-hr  title-two">
                            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>" target="_blank">
                                <i class="icon icon-caret-right"></i> <?php echo $item['art_title'] ?? ''; ?>
                            </a>
                        </li>


                        <hr class="m-all-10">

                        <?php } ?>

                        <?php endforeach; ?>



                    </ol>
                </div>
            </div>
            <div style="padding:30px 0px;">

            </div>
            <div class="line_title">
                <h3>
                    <div class="labels">
                        <i class="icon icon-star"></i> 相关推荐
                    </div>
                </h3>
            </div>
            <div class="right_pic_list">



                <?php foreach ($articles['items'] as $keys=>$item) : ?>

                <?php  if ($keys <= 16) { ?>
                <div class="sfimg-pc-one"><a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>"
                        target="_blank">
                        <img class="media-object"
                            src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>" />
                        <div class="title-two">
                            <h5 class="t"><?php echo $item['art_title'] ?? ''; ?></h5>
                        </div>
                    </a>
                </div>
                <?php  } ?>

                <?php endforeach; ?>



            </div>
        </div>

    </div>


</div>




<script>
$(function() {
    $('.article-content a').each(function(i, a) {
        var $a = $(a);
        if (!$a.attr('target')) {
            $a.attr('target', '_blank');
        }
    });
    $('#zeroclipboard').attr('data-clipboard-text', location.href)
});
</script>