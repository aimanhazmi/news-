<?php

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>

<!DOCTYPE HTML>
<!--[if lt IE 7 ]> 
<html lang="zh-CN" class="ie6 ielt8"> 
<![endif]-->
<!--[if IE 7 ]>    
<html lang="zh-CN" class="ie7 ielt8"> 
<![endif]-->
<!--[if IE 8 ]>    
<html lang="zh-CN" class="ie8"> 
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="zh-CN">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <?= Html::csrfMetaTags() ?>
    <title><?php echo $this->params['title'] ?? ''; ?> - <?php echo $this->params['site_name'] ?? ''; ?></title>

    <meta name="keywords" content="<?php echo $this->params['keywords'] ?? ''; ?>">
    <meta name="description" content="<?php echo $this->params['description'] ?? ''; ?>">
    <link rel="icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/web/assets/news/css/zui.min.css">
    <script type="text/javascript" src="/web/assets/news/js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/web/assets/bootstrap/css/bootstrap.min.css" />
    <script src="/web/assets/news/js/zui.min.js"></script>
    <script type="text/javascript" src="/web/assets/news/js/common.js"></script>
    <script type="text/javascript" src="/web/assets/news/js/script.js"></script>
    <script type="text/javascript" language="javascript" src="/web/assets/news/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" language="javascript" src="/web/assets/news/js/jquery.skitter.min.js"></script>
    <script type="text/javascript" language="javascript" src="/web/assets/news/js/user.js"></script>
    <script type="text/javascript" src="/web/assets/news/js/mescroll.min.js"></script>
    <link rel="stylesheet" href="/web/assets/news/css/mescroll.min.css">


    <script type="text/javascript" language="javascript" src="/web/assets/news/js/mescroll-option.js"></script>
    <link rel="stylesheet" href="/web/assets/news/css/mescroll-option.css">



    <?php echo $this->params['statistical_code'] ?? ''; ?>



    <script type="text/javascript">
    $(document).ready(function() {

        $('.box_skitter_large').skitter({
            theme: 'clean',
            dots: true,
            preview: false,
            numbers_align: 'right'
        });
    });
    </script>


    <link rel="stylesheet" type="text/css" href="/web/assets/news/css/news.css" />

    <SCRIPT language=javascript>
    window.onerror = function() {
        return true;
    }

    $('.carousel').carousel({
        interval: 2000
    })
    </SCRIPT>

    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>


    <div class="hidden-xs">

        <?php echo $this->render('header'); ?>

    </div>


    <div class="visible-xs">

        <?php echo $this->render('m-header'); ?>

    </div>


    <div class="container">
        <?php echo $content; ?>
    </div>


    <div class="hidden-xs">

        <?php echo $this->render('footer'); ?>

    </div>



    <script src="/web/assets/js/jquery.min.js"></script>
    <script src="/web/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/web/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="/web/assets/vendors/swiper/js/swiper.min.js"></script>
    <script src="/web/assets/js/index.min.js?t=<?php echo time(); ?>"></script>
    <script src="/web/assets/js/jquery.lazyload.js"></script>

    <script type="text/javascript">
    $(function() {
        $("img.lazy").lazyload({
            placeholder: "/web/assets/img/loading001.gif",
            effect: "fadeIn"
        });
    });


    $('[data-toggle="tooltip"]').tooltip({
        tipClass: 'tooltip-danger'
    });



    $('#search_article').keydown(function(e) {
        var curKey = e.which;
        var wd = $('input[name=wd]').val();
        if (curKey == 13) {
            if (wd) {

                $(".search-btn").trigger('click');
            }

        }
    })
    </script>

    <!--
    <script type="text/javascript">
    var break_line = document.getElementById("content_id");
    var content = break_line.innerHTML;
    break_line.innerHTML = content.replace(/\s+/g, "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
    </script>
    -->

    <script type="text/javascript">
    var catenames = localStorage.getItem("category_jval");

    if (catenames) {
        $(".slcids").each(function() {
            var catename = $(this).text();
            if (catename == catenames) {
                $(this).addClass('on');
                localStorage.removeItem("category_jval");
            }
        });

    }

    //$(".slcids").click(function() {
    //    var catename = $(this).text();
    //    localStorage.setItem("category_jval", catename);
    //});
    </script>



    <script type="text/javascript">
    function formatDate(timestamp) {
        var date = new Date(timestamp * 1000); //时间戳为10位需*1000，时间戳为13位的话不需乘1000
        Y = date.getFullYear() + '-';
        M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
        D = (date.getDate() + 1 < 10 ? '0' + (date.getDate()) : date.getDate()) + ' ';
        h = date.getHours() + ':';
        m = date.getMinutes() + ':';
        s = date.getSeconds();
        return Y + M + D;
    }



    var mescroll = initMeScroll("mescroll", { //第一个参数"mescroll"对应上面布局结构div的id
        //如果您的下拉刷新是重置列表数据,那么down完全可以不用配置,具体用法参考第一个基础案例
        //解析: down.callback默认调用mescroll.resetUpScroll(),而resetUpScroll会将page.num=1,再触发up.callback
        down: {
            auto: false,
            callback: downCallback //下拉刷新的回调,别写成downCallback(),多了括号就自动执行方法了
        },
        up: {
            callback: upCallback, //上拉加载的回调
            lazyLoad: {
                use: true, // 是否开启懒加载,默认false
                attr: 'imgurl', // 网络地址的属性名 (图片加载成功会移除该属性): <img imgurl='网络图  src='占位图''/>
                showClass: 'mescroll-lazy-in', // 图片加载成功的显示动画: 渐变显示,参见mescroll.css
                delay: 500, // 列表滚动的过程中每500ms检查一次图片是否在可视区域,如果在可视区域则加载图片
                offset: 200 // 超出可视区域200px的图片仍可触发懒加载,目的是提前加载部分图片
            },
            isBounce: false, //如果您的项目是在iOS的微信,QQ,Safari等浏览器访问的,建议配置此项.解析(必读)
            noMoreSize: 5,
            htmlNodata: '<p class="upwarp-nodata">-- 暂无相关数据~ --</p>',
            toTop: {
                //回到顶部按钮
                src: "/web/assets/news/images/gotop.png", //图片路径,默认null,支持网络图
                offset: 1000 //列表滚动1000px才显示回到顶部按钮
            },
        }
    });



    function downCallback() {
        setTimeout(function() {

            $.ajax({
                url: '#',
                success: function(data) {
                    //联网成功的回调,隐藏下拉刷新的状态;
                    mescroll.endSuccess(); //无参
                    //设置数据

                    mescroll.lockUpScroll(false);
                    mescroll.resetUpScroll();
                    $('.upwarp-nodata').html("");

                    //setXxxx(data);//自行实现 TODO
                },
                error: function(data) {
                    //联网失败的回调,隐藏下拉刷新的状态
                    mescroll.endErr();
                }
            });
        }, 500); //这个时间可适当的改下

    }
    </script>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>