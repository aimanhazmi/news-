<?php
/**
 * Created by aiman
 * User: whts
 * Date: 2025-05-08
 * Time: 10:28
 */
use yii\helpers\Url;
?>
<div class="content-wrap">
    <div class="news-banner">
        <h2><?php echo $category["title"]; ?></h2>
    </div>
    <?php foreach($data["items"] as $item): ?>
    <div class="news-list-wrap">
        <div class="rili-wrap">
            <div class="news-rili">
                <span class="news-rili-y">Apr</span>
                <span class="news-rili-r">16</span>
            </div>
        </div>
        <div class="news-list">
            <div class="news-list-title">
                <h1><a href="<?php echo Url::to('detail-'.$item["id"].'-'.$item['category_id'].".html"); ?>" class="title"><?php echo $item["art_title"]; ?></a></h1>
                <p class="time pc-none"><?php echo $item["reltime"]; ?></p>
            </div>
            <div class="news-list-content"><?php echo $item["description"]; ?></div>
            <a class="more-info" href="<?php echo Url::to('detail-'.$item["id"].'-'.$item['category_id'].".html"); ?>">查看详情>></a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php echo $this->render("pagination",['data'=>$data,'category'=>$category,'seq'=>$seq]);?>
    <!--
    <div class="news-list-wrap">
        <div class="rili-wrap">
            <div class="news-rili">
                <span class="news-rili-y">Apr</span>
                <span class="news-rili-r">16</span>
            </div>
        </div>
        <div class="news-list">
            <div class="news-list-title">
                <h1><a href="report.php" class="title">UCloud优刻得首创的云量贷正式写入两部委政策文件</a></h1>
                <p class="time pc-none">2020-04-17</p>
            </div>
            <div class="news-list-content">4月10日，发改委、中央网信办印发《关于推进“上云用数赋智”行动 培育新经济发展实施方案》(以下简称《方案》)，UCloud优刻得首创的云量贷正式写入《方案》中。</div>
            <a class="more-info" href="report.php">查看详情>></a>
        </div>
    </div>
    <div class="news-list-wrap">
        <div class="rili-wrap">
            <div class="news-rili">
                <span class="news-rili-y">Apr</span>
                <span class="news-rili-r">10</span>
            </div>
        </div>
        <div class="news-list">
            <div class="news-list-title">
                <h1><a href="report.php" class="title">从Spring Cloud到UCloud UK8S的微服务迁移实践</a></h1>
                <p class="time pc-none">2020-04-17</p>
            </div>
            <div class="news-list-content">要出发周边游（以下简称要出发）是国内知名的主打「周边游」的在线旅行网站，以国内各大城市为中心，覆盖其周边旅游市场，提供包含酒店、门票、餐饮等在内的 1 – 3 天短途旅行套餐。为</div>
            <a class="more-info" href="report.php">查看详情>></a>
        </div>
    </div>
    <div class="news-list-wrap">
        <div class="rili-wrap">
            <div class="news-rili">
                <span class="news-rili-y">Apr</span>
                <span class="news-rili-r">03</span>
            </div>
        </div>
        <div class="news-list">
            <div class="news-list-title">
                <h1><a href="report.php" class="title">上海外贸调查：那些危机中的逆行者</a></h1>
                <p class="time pc-none">2020-04-17</p>
            </div>
            <div class="news-list-content">上海是中国经济最为活跃的城市之一，新冠肺炎疫情全球蔓延，尽管压力重重，上海外贸产业链在危机中积极探索新产品、新市场和新战法，仍然展示出强劲的韧性和逆生长潜力。</div>
            <a class="more-info" href="report.php">查看详情>></a>
        </div>
    </div>
    <div class="news-list-wrap">
        <div class="rili-wrap">
            <div class="news-rili">
                <span class="news-rili-y">Mar</span>
                <span class="news-rili-r">27</span>
            </div>
        </div>
        <div class="news-list">
            <div class="news-list-title">
                <h1><a href="report.php" class="title">UCloud优刻得：万物皆可“云”背后的RTC实时音视频技术</a></h1>
                <p class="time pc-none">2020-04-17</p>
            </div>
            <div class="news-list-content">事实上，让以上这些“云端狂欢”的大部分场景成为现实的是实时音视频技术，这是一项应用广泛但鲜为人知的技术，云蹦迪、云看房、云上课、云招聘等背后都要给实时音视频技术记一功。</div>
            <a class="more-info" href="report.php">查看详情>></a>
        </div>
    </div>
    <div class="news-list-wrap">
        <div class="rili-wrap">
            <div class="news-rili">
                <span class="news-rili-y">Mar</span>
                <span class="news-rili-r">27</span>
            </div>
        </div>
        <div class="news-list">
            <div class="news-list-title">
                <h1><a href="report.php" class="title">UCloud携手上海银行推出“云量贷”，西井科技快速获批千万贷款</a></h1>
                <p class="time pc-none">2020-04-17</p>
            </div>
            <div class="news-list-content">为了助力中小企业复工复产，UCloud优刻得与上海银行银企合作，针对UCloud云平台上的中小企业客户提供“云量贷”专项贷款支持，重点支持受本次疫情影响并且贷款有困难的中小企业。近日，西</div>
            <a class="more-info" href="report.php">查看详情>></a>
        </div>
    </div>-->

</div>