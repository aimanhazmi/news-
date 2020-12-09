<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-06 22:29:24
 */
use yii\helpers\Url;




?>




<div class="hidden-xs  container  categorypage">
    <div class="row">
        <div class="col-xs-1">

            <div class="row">
                <?php echo $this->render('/layouts/category-tabs', [
                'data'     => $tabsData??[],
                'category' => $tabsCategory,
                'categorys' => $categorys,
            ]); ?>

            </div>
        </div>
        <div class="col-xs-8">

            <div class="col-xs-12">
                <div class="row myNiceCarouselcss">
                    <div id="myNiceCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myNiceCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myNiceCarousel" data-slide-to="1"></li>
                            <li data-target="#myNiceCarousel" data-slide-to="2"></li>
                            <li data-target="#myNiceCarousel" data-slide-to="3"></li>
                            <li data-target="#myNiceCarousel" data-slide-to="4"></li>
                        </ol>
                        <div class="carousel-inner">

                            <?php foreach ($data['items'] as $keys=>$item) : ?>

                            <?php if($keys<5) { ?>

                            <?php if($keys==0) { ?>

                            <div class="item active " style="padding-top: 0px;">

                                <?php } else { ?>

                                <div class="item" style="padding-top: 0px;">

                                    <?php } ?>


                                    <img style="border-radius:0"
                                        src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                        alt="<?php echo $item['art_title'] ?? ''; ?>" />
                                    <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>"
                                        target="_blank">
                                        <div class="b"></div>
                                        <div class="carousel-caption">
                                            <h3 style="color:#fff"><?=$item['art_title']?></h3>
                                        </div>
                                    </a>

                                </div>

                                <?php } ?>

                                <?php endforeach; ?>



                            </div>
                            <a class="left carousel-control carousel-control_left" href="#myNiceCarousel"
                                data-slide="prev"><span class="icon icon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#myNiceCarousel" data-slide="next"><span
                                    class="icon icon-chevron-right"></span></a>
                        </div>
                    </div>



                    <div class="m-tb-30">

                        <h4><i class="icon icon-th-list"></i> 快讯</h4>
                        <hr>
                    </div>

                    <div class="base_list_content" style="padding-top:0px;">

                        <?php echo $this->render('/layouts/article-images-list', [
                           'data'     => $data ?? [],
                           'category' => $category ?? [],
                            ]); 
                     ?>


                    </div>


                </div>


            </div>


            <div class="col-xs-3">
                <div class="sub_right">
                    <div class="bases_box">
                        <div class="labelst">
                            <i class="icon icon-heart"></i> 热文榜单
                        </div>
                        <div class="content txt_hot">

                            <?php foreach ($top_pv_data['items'] as $keys=>$item) : ?>
                            <?php if($keys<5) { ?>


                            <div class="item">
                                <div class="i"></div>
                                <div class="r">
                                    <div class="t">
                                        <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>"
                                            target="_blank"><?php echo $item['art_title'] ?? ''; ?></a>
                                    </div>
                                    <div class="d"><?=$item['category_name'];?> |
                                        <?php echo date('Y-m-d H:m:s', $item['reltime']); ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>


                            <?php } ?>
                            <?php endforeach; ?>

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

                        <?php foreach ($top_pv_data['items'] as $keys=>$item) : ?>
                        <?php if($keys>10 && $keys<25) { ?>

                        <div class="item">
                            <a href="<?php echo Url::to('/article-' . $item['id'] . '.html'); ?>" target="_blank">
                                <div class="sfimg">
                                    <img src="<?php echo $item['img_thumb'] ?? '/web/assets/img/show-thumbnail.jpg'; ?>"
                                        alt="<?php echo $item['art_title'] ?? ''; ?>">
                                </div>
                                <h5 class="t"><?php echo $item['art_title'] ?? ''; ?></h5>
                            </a>
                        </div>

                        <?php } ?>
                        <?php endforeach; ?>


                    </div>


                </div>




            </div>

        </div>
    </div>
</div>



<div class="visible-xs">
    <div id="mescroll" class="mescroll">

        <div class="col-xs-10" style="margin-left:60px" id="spczsd">
            <div id="more_page"></div>

        </div>

    </div>
</div>



<div class="visible-xs col-xs-2" style="margin-left:15px;position:fixed;z-index:999999;overflow:auto;height:100%">

    <?php echo $this->render('/layouts/category-tabs', [
                'data'     => $tabsData??[],
                'category' => $tabsCategory,
                'categorys' => $categorys,
            ]); ?>

</div>
 
<script src="/web/assets/js/jquery.min.js"></script>

<script type="text/javascript">
              
    var url = window.location.href;
    var reg = /[categorylist-][1-9][0-9]*/g;
    var urls = url.match(reg);
    var ids = Math.abs(urls);
    var idsget = localStorage.getItem("category_post_ids__pull");

    if (ids) {
        $(".slcids").each(function() {
            var id_vs = $(this).children().val();
            if (ids == id_vs) {
                $(this).addClass('on');
            }
        });
    }




    if (idsget!=ids) {
         localStorage.setItem("category_post_ids__pull", ids);         
    }


$(document).ready(function() {

    $(".slcids").click(function() {

        var ids = $(this).children().val();
        if (!ids) {
            var ids = $(this).children().next().val();
        }

        var catename = $(this).text();
        localStorage.setItem("category_jval", catename);

        localStorage.setItem("category_post_ids__pull", ids);

    });
});


var ids = localStorage.getItem("category_post_ids__pull");


//上拉加载的回调 page = {num:1, size:10}; num:当前页 默认从1开始, size:每页数据条数,默认10
function upCallback(page) {
    setTimeout(function() {
        $.ajax({
            type: "post",
            url: "front/main/category_post",
            data: {
                num: page.num,
                size: page.size,
                id: ids,
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
                            html += '<div class="link-title">'+value.art_title+'</div>';
                            html += '<div class="sfimg-one">';
                            html += '<img  src="' + value.img_thumb + '" alt="' + value.art_title + '">';
                            html += '</div>';
                            html += '</a>';
                            html += '</div>';

                        } else {

                            html += '<a href="/article-' + value.id + '.html">';
                            html += '<div class="link-title">'+value.art_title+'</div>';  
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
                        html += '<div class="link-title">'+value.art_title+'</div>';
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