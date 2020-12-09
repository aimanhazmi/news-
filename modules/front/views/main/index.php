<?php
/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/8/24
 * Time: 13:49
 */
$defaultColumn = Yii::$app->params["defaultColumn"];
use yii\helpers\Url;

?>




<div class="hidden-xs row m-t-m">

    <!--  左边图片 -->
    <div class="hidden-xs col-xs-3 pos_left">
        <div class="row text-center">
            <?php foreach ($articlesd[0]['items'] as $keys=>$item) : ?>

            <?php  if ($keys <= 1) { ?>


            <div class="item">
                <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>" target="_blank">
                    <img src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>" />
                    <div class="i">
                        <div class="b">
                            <div class="c"><?=$item['categoryd_name']?></div>
                            <div class="t"><?=$item['art_title']?></div>
                        </div>
                    </div>
                </a>
            </div>


            <?php } ?>

            <?php endforeach; ?>
        </div>
    </div>

    <!--  左边图片 end-->

    <!--  滚动图片 -->
    <div class="col-md-6">
        <div class="row text-center p-lr-cmini pos_c">
            <div id="myNiceCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myNiceCarousel" data-slide-to="0" class="active"></li>

                    <?php for ($i=0; $i < 5 ; $i++) { ?>
                    <li data-target="#myNiceCarousel" data-slide-to="<?=$i?>"></li>
                    <?php } ?>

                </ol>
                <div class="carousel-inner">


                    <?php foreach ($articlesd[1]['items'] as $keys=>$item) : ?>

                    <?php  if ($keys<=5) { ?>
                    <?php  if ($keys==0) { ?>
                    <div class="item active">
                        <?php } else { ?>
                        <div class="item">
                            <?php } ?>

                            <img src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>" />
                            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>" target="_blank">

                                <div class="carousel-caption">
                                    <h4>
                                        <?=$item['art_title']?>
                                    </h4>
                                </div>
                            </a>
                        </div>

                        <?php } ?>

                        <?php endforeach; ?>



                    </div>
                    <a class="left carousel-control" href="#myNiceCarousel" data-slide="prev"><span
                            class="icon icon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#myNiceCarousel" data-slide="next"><span
                            class="icon icon-chevron-right"></span></a>
                </div>
            </div>

        </div> <!--  滚动图片 end-->


        <div class="hidden-xs col-xs-3 pos_right">
            <div class="row text-center">
                <?php foreach ($articlesd[2]['items'] as $keys=>$item) : ?>

                <?php  if ($keys <= 1) { ?>


                <div class="item">
                    <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>" target="_blank">
                        <img src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>" />
                        <div class="i">
                            <div class="b">
                                <div class="c"><?=$item['categoryd_name']?></div>
                                <div class="t"><?=$item['art_title']?></div>
                            </div>
                        </div>
                    </a>
                </div>


                <?php } ?>

                <?php endforeach; ?>
            </div>
        </div>


    </div>
    <!--  右边图片 end-->







    <!--

        <div class="visible-xs col-xs-12">
            <div class="row">
                <hr>
                <?php for ($i=0; $i < count($articlesd); $i++) { ?>



                <?php foreach ($articlesd[$i]['items'] as $keys=>$item) : ?>


                <div class="row p-tb-10">
                    <div class="col-xs-5">
                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                            <div class="sfimg">
                                <img class="media-object"
                                    src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                    alt="<?=$item['art_title']?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-7 carefullychosen">
                        <div>
                            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                                <div class="title"><?=$item['art_title']?></div>
                            </a>
                        </div>

                        <div class="mini-ps-type">
                            <div class="p-tb-10">
                                <div class="pull-left" style="padding-right:10px"><?=$item['categoryd_name']?></div>
                                <div style="color:#ccc" class="pull-left">|</div>
                                <div class="pull-left" style="padding-left:10px">
                                    <?php echo date('Y-m-d', $item['reltime']); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>

                <?php endforeach; ?>

                <?php } ?>


            </div>
        </div>

        -->



    <div class="clear"></div>





    <!-- 左边列表 -->
    <div class="hidden-xs row">


        <div class="col-xs-9">
            <div class="row p-r-10">
                <h3>
                    <span class=" label label-primary">
                        <i class="icon icon-heart"></i> 精选
                    </span>
                </h3>

                <hr>

                <!-- 精选 -->

                <?php foreach ($articlesdpv['items'] as $k=>$item) : ?>

                <div class="row p-tb-10">
                    <div class="col-xs-4">
                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                            <div class="link-title"><?=$item['art_title']?></div>
                            <div class="sfimg">
                                <img class="media-object"
                                    src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                    alt="<?=$item['art_title']?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-8 carefullychosen">
                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                            <h4 class=""><?=$item['art_title']?></h4>
                        </a>
                        <div class="p-tb-10"><?=$item['categoryd_name']?> |
                            <?php echo date('Y-m-d H:m:s', $item['reltime']); ?>
                        </div>
                        <div><?=$item['description']?></div>
                    </div>
                </div>


                <hr>



                <?php endforeach; ?>



                <div class="row p-tb-10">

                    <?php foreach ($articlesd[0]['items'] as $k=>$item) : ?>

                    <?php  if ($item['istop']==1 && $k<=16  && $k>8  ) { ?>


                    <div class="col-xs-4 imgtborder">
                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                            <div class="link-title"><?=$item['art_title']?></div>
                            <div class="sfimg">
                                <img class="media-object"
                                    src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                    alt="<?=$item['art_title']?>">
                            </div>
                        </a>

                        <div class="carefullychosen">
                            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                                <h4 class=""><?=$item['art_title']?></h4>
                            </a>
                            <div class="p-tb-10"><?=$item['categoryd_name']?> |
                                <?php echo date('Y-m-d H:m:s', $item['reltime']); ?>
                            </div>

                        </div>

                    </div>
                    <?php } ?>

                    <?php endforeach; ?>

                </div>





            </div>


            <div class="row">

                <nav class="navbar navbar-default" role="navigation">
                    <ul class="nav navbar-nav nav-justified">



                        <?php  $ctdatas=$this->params['items']; ?>

                        <?php   foreach ($ctdatas as $cark => $value) : ?>

                        <li>
                            <a data-tab href="#tabContent<?=$cark+1?>">
                                <?=$value['title'];?>
                            </a>
                        </li>

                        <?php endforeach; ?>



                    </ul>
                </nav>






                <div class="base_list_content tab-content">


                    <!--   选项卡     -->


                    <div class="tab-pane active" id="tabContent1">




                        <?php foreach ($articlesd[0]['items'] as $k=>$item) : ?>




                        <div class="row p-tb-10">
                            <div class="col-xs-4">
                                <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                                    <div class="sfimg">
                                        <img class="media-object"
                                            src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                            alt="<?=$item['art_title']?>">
                                        <div class="link-title"><?=$item['art_title']?></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-8 carefullychosen">
                                <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                                    <h4 class=""><?=$item['art_title']?></h4>
                                </a>
                                <div class="p-tb-10"><?=$item['categoryd_name']?> |
                                    <?php echo date('Y-m-d H:m:s', $item['reltime']); ?>
                                </div>
                                <div><?=$item['description']?></div>
                            </div>
                        </div>


                        <?php endforeach; ?>

                        <div id="moreBtn"><a
                                href="<?php echo Url::to('/category-' .  $ctdatas[0]['id'] . '.html'); ?>">浏览更多</a>
                        </div>

                    </div>



                    <?php  $sumx=count($articlesd); ?>

                    <?php for ($x=1; $x<$sumx; $x++) { ?>

                    <div class="tab-pane" id="tabContent<?=$x+1?>">
                        <?php foreach ($articlesd[$x]['items'] as $k=>$item) : ?>
                        <?php  if ($k<=16) { ?>

                        <div class="row p-tb-10">
                            <div class="col-xs-4">
                                <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                                    <div class="sfimg">
                                        <img class="media-object"
                                            src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                            alt="<?=$item['art_title']?>">
                                        <div class="link-title"><?=$item['art_title']?></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-8 carefullychosen">
                                <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>">
                                    <h4 class=""><?=$item['art_title']?></h4>
                                </a>
                                <div class="p-tb-10"><?=$item['categoryd_name']?> |
                                    <?php echo date('Y-m-d H:m:s', $item['reltime']); ?>
                                </div>
                                <div><?=$item['description']?></div>
                            </div>
                        </div>


                        <?php } ?>
                        <?php endforeach; ?>


                        <div id="moreBtn"><a
                                href="<?php echo Url::to('/category-' .  $ctdatas[$x]['id'] . '.html'); ?>">浏览更多</a>
                        </div>


                    </div>

                    <?php } ?>

                    <!--   选项卡 end    -->




                </div>





            </div>





        </div>


        <div class="hidden-xs col-xs-3">
            <div class="row">
                <h3>
                    <span class="label label-primary">
                        <i class="icon icon-random"></i> 快报
                    </span>
                    <span class="pull-right">
                        <h6>24小时滚动播报</h6>
                    </span>
                </h3>


            </div>


            <div class="row new_news_outborder">
                <div class="content new_news">
                    <div class="scrollbar">


                        <?php foreach ($articlesd[0]['items'] as $keys=>$item) : ?>

                        <?php  if (date('Y-m-d', $item['reltime'])<=date('Y-m-d', time()))  { ?>

                        <div class="item">
                            <div class="i"></div>
                            <div class="r">
                                <div class="t">
                                    <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>"
                                        target="_blank">
                                        <?=$item['art_title']?>
                                    </a>
                                </div>
                                <div class="d"><?=$item['categoryd_name']?></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                        <?php } ?>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>



            <div class="row">


                <div class="base_box">

                    <h3>
                        <span class="label label-primary">
                            <i class="icon icon-line-chart"></i> 热文榜单
                        </span>

                    </h3>

                    <hr>


                    <div class="new_news_outborder">
                        <div class="content new_news">
                            <div class="scrollbar">


                                <?php foreach ($articles_pv_top['items'] as $keys=>$item) : ?>

                                <?php  if (date('Y-m-d', $item['reltime'])<=date('Y-m-d', time()))  { ?>

                                <div class="item">
                                    <div class="i"></div>
                                    <div class="r">
                                        <div class="t">
                                            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>"
                                                target="_blank">
                                                <?=$item['art_title']?>
                                            </a>
                                        </div>
                                        <div class="d"><?=$item['categoryd_name']?></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>


                                <?php } ?>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>








                </div>

            </div>



        </div>


    </div>



    <hr class="hidden-xs row">


    <!--  合作伙伴 -->
    <div class="hidden-xs row  m-t-30">


        <div class="base_link">
            <h4 class="title">合作伙伴</h4>
            <div class="link_pic row col-xs-12">
                <div class="row">

                    <div class=" col-xs-2">
                        <a href="#"><img src="/web/assets/news/picture/link_logo3.jpg" alt="" /></a>
                    </div>
                    <div class="col-xs-2">
                        <a href="#"><img src="/web/assets/news/picture/link_logo4.jpg" alt="" /></a>
                    </div>
                    <div class="col-xs-2">
                        <a href="#"><img src="/web/assets/news/picture/link_logo5.jpg" alt="" /></a>
                    </div>
                    <div class="col-xs-2">
                        <a href="#"><img src="/web/assets/news/picture/link_logo6.jpg" alt="" /></a>
                    </div>
                    <div class="col-xs-2">
                        <a href="#"><img src="/web/assets/news/picture/link_logo7.jpg" alt="" /></a>
                    </div>
                    <div class="col-xs-2">
                        <a href="#"><img src="/web/assets/news/picture/link_logo8.jpg" alt="" /></a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

        </div>

    </div>

    <hr class="hidden-xs row">


    <div class="hidden-xs row  m-t-10 m-b-30 ">

        <h4 class="title">友情链接</h4>
        <div class="link_txt">


            <div class="col-xs-2">
                <a href="#" target="_blank">

                </a>
            </div>

        </div>
    </div>


</div>




<div class="visible-xs">

    <div id="mescroll" class="mescroll">
        <div class="container">
            <div class="row p-lr-cmini pos_c">
                <div id="myNiceCarouselm" class="carousel slide" data-ride="carousel">
                    <!-- 圆点指示器 -->
                    <ol class="carousel-indicators">
                        <li data-target="#myNiceCarouselm" data-slide-to="0" class="active"></li>
                        <li data-target="#myNiceCarouselm" data-slide-to="1"></li>
                        <li data-target="#myNiceCarouselm" data-slide-to="2"></li>
                        <li data-target="#myNiceCarouselm" data-slide-to="3"></li>
                        <li data-target="#myNiceCarouselm" data-slide-to="4"></li>
                    </ol>

                    <!-- 轮播项目 -->
                    <div class="carousel-inner">
                        <?php foreach ($articlesd[1]['items'] as $keys=>$item) : ?>
                        <?php  if ($keys<5) { ?>
                        <?php  if ($keys==0) { ?>
                        <div class="item active">
                            <?php } else { ?>
                            <div class="item">
                                <?php } ?>

                                <img src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>" />
                                <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>" target="_blank">

                                    <div class="carousel-caption">
                                        <h4>
                                            <?=$item['art_title']?>
                                        </h4>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                            <?php endforeach; ?>
                        </div>
                        <!-- 项目切换按钮 -->
                        <a class="left carousel-control" href="#myNiceCarouselm" data-slide="prev">
                            <span class="icon icon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#myNiceCarouselm" data-slide="next">
                            <span class="icon icon-chevron-right"></span>
                        </a>
                    </div>
                </div>








                <div id="spczsd">
                    <div id="more_page"></div>

                </div>
            </div>

        </div>


    </div>





    <script type="text/javascript">
    //上拉加载的回调 page = {num:1, size:10}; num:当前页 默认从1开始, size:每页数据条数,默认10
    function upCallback(page) {
        setTimeout(function() {
            $.ajax({
                type: "post",
                url: "front/main/index_post",
                data: {
                    num: page.num,
                    size: page.size,
                },
                ContentType: 'text/json;charset=utf-8',
                success: function(curPageData) {
                    var html = "";

                    html += '<div class="visible-xs col-xs-12">'
                    html += '<div class="row">';

                    $.each(curPageData.items, function(key, value) {

                        if (parseInt(key / 6) % 2 != 0) {

                            if (key == 9) {

                                html += '<div style="margin-bottom:15px">';
                                html += '<div>' + value.art_title + '</div>';
                                html += '<a href="/article-' + value.id + '.html">';
                                html += '<div class="link-title">' + value.art_title +
                                    '</div>';
                                html += '<div class="sfimg-m-one">';
                                html += '<img  src="' + value.img_thumb + '" alt="' + value
                                    .art_title + '">';
                                html += '</div>';
                                html += '</a>';
                                html += '</div>';

                            } else {

                                html += '<a href="/article-' + value.id + '.html">';
                                html += '<div class="link-title">' + value.art_title +
                                    '</div>';
                                html += '<div class="sfimg-m">';
                                html += '<img  imgurl="' + value.img_thumb +
                                    '" src="/web/assets/img/loading001.gif" alt="' + value
                                    .art_title + '">';
                                html += '</div>';
                                html += '</a>';
                            }


                        } else {



                            html += '<div class="row p-tb-10">';

                            html += '<div class="col-xs-5">';
                            html += '<a href="/article-' + value.id + '.html">';
                            html += '<div class="link-title">' + value.art_title + '</div>';
                            html += '<div class="sfimg">';
                            html += '<img class="media-object" imgurl="' + value.img_thumb +
                                '" src="/web/assets/img/loading001.gif" alt="' + value
                                .art_title + '">';
                            html += '</div>';
                            html += '</a>';
                            html += '</div>';


                            html += '<div class="col-xs-7 carefullychosen">';

                            html += '<div>';
                            html += '<a href="/article-' + value.id + '.html">';
                            html += '<div class="title">' + value.art_title + '</div>';
                            html += '</a>';
                            html += '</div>';


                            html += '<div class="mini-ps-type">';
                            html += '<div class="p-tb-10">';
                            html += '<div class="pull-left" style="padding-right:10px">' +
                                value
                                .category_name + '</div>';
                            html += '<div style="color:#ccc" class="pull-left">|</div>';
                            html += '<div class="pull-left" style="padding-left:10px">';
                            html += formatDate(value.reltime);
                            html += '</div>';
                            html += '</div>';

                            html += '</div>';
                            html += '</div>';
                            html += '</div>';



                        }


                    });


                    html += '</div>';
                    html += '</div>';

                    if (page.num == 1) {
                        $('#spczsd').children().empty();
                    }


                    if (page.num >= 2) {
                        $(".m-headers").hide(); //隐藏div
                        $(".mescroll").css("top", "35px");

                    } else {
                        $(".m-headers").show(); //隐藏div
                        $(".mescroll").css("top", "110px");

                    }



                    mescroll.lockUpScroll(false);
                    $("#more_page").before(html);

                    mescroll.endBySize(curPageData.items.length, curPageData
                        .total_items);
                    setListData(curPageData.items); //自行实现 TODO



                },
                error: function(e) {
                    //联网失败的回调,隐藏下拉刷新和上拉加载的状态
                    mescroll.endErr();
                }
            });

        }, 1); //这个时间可适当的改下

    }
    </script>