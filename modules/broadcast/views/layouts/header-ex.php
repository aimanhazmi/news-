<?php
/**
 * Created by PhpStorm.
 * User: whts
 * Date: 2020-05-07
 * Time: 10:58
 */
use yii\helpers\Url;
?>

<div class="page-header ">
    <div class="main" style="overflow: visible;">
        <div class="top-wear-left">
            <a class="logo-ucloud" href="#"></a>
        </div>
        <div class="top-wear-middle">
            <ul id="topmenu">
                <li class="submenu dropdownshow"><a href="<?php echo Url::to("/b/main/index.html")?>">首页</a></li>
                <li class="submenu dropdownshow" data-href="nav-product"><a href="<?php echo Url::to("/b/product/expand.html")?>">软件产品</a></li>
                <li class="submenu dropdownshow" data-href="nav-solution"><a href="<?php echo Url::to("/b/solution/retail.html")?>">产品方案</a></li>
                <li class="submenu dropdownshow" data-href="nav-case"><a href="<?php echo Url::to("/b/cases/education.html")?>">客户案例</a></li>
                <li class="submenu dropdownshow" data-href="nav-activity"><a href="<?php echo Url::to("/b/activity/index.html")?>">行业动态</a></li>
                <li class="submenu dropdownshow" data-href="nav-about"><a href="<?php echo Url::to("/b/ex/about.html")?>">关于我们</a></li>
            </ul>
        </div>
        <div class="top-wear-right">
            <div class="nav-search-wrap search-hide">
                <button title="搜索" class="icon__search search-button"></button>
                <input text="text" class="nav-search-key" placeholder="搜索产品、产品文档" onfocus="if(placeholder=='搜索产品、产品文档') {placeholder=''}" onblur="if (value=='') {placeholder='搜索产品、产品文档'}">
                <button title="清空" class="icon__cross search-clear"></button>
                <div id="nav-search-dropdown" class="nav-search-dropdown">
                    <div id="nav-search-result" class="nav-search-result"></div>
                    <div id="full-search-name" class="full-search-name">
                    </div>
                    <div id="nav-search-dc" class="nav-search-dc">
                    </div>
                </div>
            </div>
            <a class="link-style vertical-position" style="padding:0 0 0 5px" href="#" target="_blank">文档</a>
            <a class="link-style vertical-position" href="#">备案</a>
<!--            <ul class="logined vertical-position dn">-->
<!--                <li class="login">-->
<!--                    <a href="#" class="user-name link-style"></a>-->
<!--                    <a href="#" class="link-style">退出</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="dib vertical-position" style="display:none;">-->
<!--                <li class="nologin vertical-position">-->
<!--                    <a href="--><?php //echo Url::to('/b/ex/register.html') ?><!--" class="button small button-general">快速注册</a>-->
<!--                </li>-->
<!--                <li class="vertical-position">-->
<!--                    <a href="--><?php //echo Url::to('/b/ex/login.html') ?><!--" target="_blank" class="button small button-ghost login tologin">登录控制台</a>-->
<!--                </li>-->
<!--            </ul>-->
        </div>
    </div>
    <div id="menudropdowns">
        <div class="nav-menu-dropdown clearfix" id="nav-product">
            <div class="nav-menu-wrap nav-product">
                <div class="nav-hotprods">
                    <a class="new" href="#">
                        <i class="sicon sicon-new"></i>
                        热门产品
                    </a>
                    <a href="#">拓客宝</a>
                    <a href="#">直播系统</a>
                    <a href="#">消费分期系统</a>
                </div>
                <div class="nav-category">
                    <div class="category-type-list">
                        <div class="nav-menu-list clearfix">
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">营销类工具包</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="#">
                                            拓客宝
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            直播系统
                                            <i class="prod_tag">HOT</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            股民引流落地页
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">期货业务系统</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="#">
                                            金融代理商佣金结算系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">类金融系统</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="#">
                                            新三农生态金融系统
                                            <i class="prod_tag">HOT</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            新生态供应链金融系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            汽车金融系统
                                            <i class="prod_tag">HOT</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            私募股权投资管理系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            金融知识付费问答系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            影视众筹系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            融资租赁系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">互联网金融系统</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="#">
                                            消费分期系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            金频反欺诈系统
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-menu-dropdown clearfix" id="nav-solution">
            <div class="nav-menu-wrap nav-solution">
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="/site/solution/nretail.html">
                                <span class="nav-submenu-title mr12">新零售</span>
                                <i class="prod_tag org_tag">行业</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    传统百货商、超市 | 便利店 | 专门店&nbsp;&nbsp;
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="https://www.ucloud.cn/site/cases/ret/2220.html">
                                    <img src="/static/broadcast/images/7114229ea5a34c6dbbabb22fc52c7ed0.png">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.ucloud.cn/site/cases/ret/729.html">
                                    <img src="/static/broadcast/images/029cf07bb5f2265e81ba77572338a4b3.jpg">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">医疗</span>
                                <i class="prod_tag org_tag">行业</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    区域化云HIS | 数据容灾备份 | 医疗人工智能 | 海量分布式存储
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1PGG0500AW.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/7a8c9f5b0bb14b0abdcdbd520cd4720c.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">出海</span>
                                <i class="prod_tag org_tag">行业</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    游戏出海业务 | 电商出海业务 | 区块链技术
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/6284381363b78f52f5ff9b7c5467dc99.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/888f9e8b902941f89e8d9281e124c3d7.jpg">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">金融</span>
                                <i class="prod_tag org_tag">行业</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    互联网金融行业 | 银行业金融机构 | 证券行业
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/25556fbec7154ff92f732da57a8b4185.jpg">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/192b375805b1c3edce579368b9f28b9e.jpg">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">智慧校园</span>
                                <i class="prod_tag org_tag">行业</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    人脸门禁 | 学生用餐统计 | 学生归寝统计 | 黑白名单布控
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/985ba72f7ef54d1aaac590fd17ac8adc.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/499ceaaf78374af8a4bb94db92836d9e.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">智慧楼宇</span>
                                <i class="prod_tag org_tag">行业</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    考勤管理 | 人脸门禁 | 智能迎宾 | 访客管理
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/221bb0d754774bebad9510fc5ad40a49.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/0e4bf011a6d444378ab7783f97cf57fa.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">人工智能</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    图像识别服务 | OCR文字识别 | 视频处理
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/abee233b6ede42b796a05b0c3550832e.jpg">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1Z3120U913a0.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">海量计算</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    图片处理 | 基因测序 | 视频转码 | 科学计算
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/9acf640d81644bf1b5183fce41ad107e.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/ce86088a10b65393a3d11a84597de6f9.jpg">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">安全</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    网站防护 | 游戏防护 | 主机防护 | 内部运维风险管控
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/17-1P611104331449.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1P624013QX28.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">高可用</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    具备高可用架构和冗余能力的业务 | 具有较高可靠性、业务连续性的业务
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/9acf640d81644bf1b5183fce41ad107e.png">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.ucloud.cn/site/cases/more/766.html">
                                    <img src="/static/broadcast/images/abd94647cb05b94dc64e8d893bbeca98.jpg">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">大数据</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    开箱即用 | 智能运维 | 一站式服务 | 资源独享
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/7a8c9f5b0bb14b0abdcdbd520cd4720c.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/fae9c8406d0c6e309b713f3bb2ab2ea1.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">云备份</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    云灾备场景 | 云归档场景
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/4840f6c998294245abb72df9189a85b2.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/fd50589097f643abb7d33b1edc4bbb24.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu  nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">物联网VPC</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    移动专用网 | 共享设备租赁 | 环境监测
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1Z3120U913a0.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu  nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title mr12">云智能存储网关</span>
                                <i class="prod_tag blue_tag">通用</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    医疗PACS影像上云 | 视频安防文件上云
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-solution">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/3a330b07ad1a4eceb04c435bf16226e8.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-menu-dropdown clearfix" id="nav-case">
            <div class="nav-menu-wrap nav-case">
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">教育</span>
                                <div class="nav-font-color-6gray">
                                    在线教育 | 培训机构 | 教务机构 | 中小学
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1P624013QX28.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-191230113035314.png">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">金融</span>
                                <div class="nav-font-color-6gray">
                                    银行 | 证券 | 互联网金融
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/25556fbec7154ff92f732da57a8b4185.jpg">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/192b375805b1c3edce579368b9f28b9e.jpg">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">游戏</span>
                                <div class="nav-font-color-6gray">
                                    手游 | 端游 | 游戏全球服
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/888f9e8b902941f89e8d9281e124c3d7.jpg">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/6284381363b78f52f5ff9b7c5467dc99.png">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                </div>
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">出海</span>
                                <div class="nav-font-color-6gray">
                                    电商 | 游戏
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-200306142449426.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/9626a72bb5114b5617daae285c0709b8.jpg">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">政务企业</span>
                                <div class="nav-font-color-6gray">
                                    政务 | 传统企业 | 媒体
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/6993e8be9f8fb5973b2251d6231ace06.jpg">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/f5756a62d39944bfbd676bb816c754e8.png">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">新零售</span>
                                <div class="nav-font-color-6gray">
                                    电商 | 门店 | 商超 | 品牌商
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1PZ51H040645.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/029cf07bb5f2265e81ba77572338a4b3.jpg">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                </div>
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">视频直播</span>
                                <div class="nav-font-color-6gray">
                                    娱乐直播 | 赛事直播 | 课堂直播 | 短视频
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1PGQ1414C33.jpg">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/bb5410cb7ed9dee5f6099bbf0500a84e.png">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">医疗健康</span>
                                <div class="nav-font-color-6gray">
                                    传统医院 | 基层医疗机构 | 在线医疗
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1PGG0500AW.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/7a8c9f5b0bb14b0abdcdbd520cd4720c.png">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <a href="#">
                                <span class="nav-submenu-title">AI+IoT</span>
                                <div class="nav-font-color-6gray">
                                    AI | 物联网 | 车联网 | 智能制造
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/abee233b6ede42b796a05b0c3550832e.jpg">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/20-1Z3120U913a0.png">
                                </a>
                            </li>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-menu-dropdown clearfix" id="nav-partner"></div>
        <div class="nav-menu-dropdown clearfix" id="nav-activity">
            <div class="nav-menu-wrap nav-activity">
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <span class="nav-submenu-title">TIC</span>
                        </div>
                        <ul class="nav-submenu-activity">
                            <li>
                                <a href="#" target="_blank">
                                    <img src="/static/broadcast/images/66d5422e50254698bd4c0648896edc57.png">
                                    <i class="activity_tag 精彩回放">精彩回放</i>
                                </a>
                                <p class="activity_des">TIC 2019</p>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <img src="/static/broadcast/images/a62cb62a91b04cac9b079f7ad9db0990.png">
                                    <i class="activity_tag dn"></i>
                                </a>
                                <p class="activity_des">TIC 2018 12月</p>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <img src="/static/broadcast/images/076338fbee5a45bca7d3372827116a22.png">
                                    <i class="activity_tag dn"></i>
                                </a>
                                <p class="activity_des">TIC 2018 5月</p>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <img src="/static/broadcast/images/b7dbec00f88f4bab8ff3c88063b7ee31.png">
                                    <i class="activity_tag dn"></i>
                                </a>
                                <p class="activity_des">TIC 2015</p>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <span class="nav-submenu-title">You+</span>
                        </div>
                        <ul class="nav-submenu-activity">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/99e0942caf7440b184276a5a1df58c7f.png">
                                    <i class="activity_tag dn"></i>
                                </a>
                                <p class="activity_des">UCan 下午茶</p>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/a0172ad21b104f03b7f2b5b9661992c0.png">
                                    <i class="activity_tag dn"></i>
                                </a>
                                <p class="activity_des">UCan 技术夜</p>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu  nav-font-13">
                        <div class="nav-submenu-top">
                            <span class="nav-submenu-title">Tech Talk</span>
                        </div>
                        <ul class="nav-submenu-activity">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/9bdfb9706cf741f9871ac3956fd6471d.jpg">
                                    <i class="activity_tag dn"></i>
                                </a>
                                <p class="activity_des">TechTalk</p>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <span class="nav-submenu-title">UCan线上公开课</span>
                        </div>
                        <ul class="nav-submenu-activity">
                            <li>
                                <a href="#">
                                    <img src="/static/broadcast/images/8c846e092a8d4f1097da77a2e8aacfc3.png">
                                    <i class="activity_tag 正在直播">正在直播</i>
                                </a>
                                <p class="activity_des">线上公开课</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-menu-dropdown clearfix" id="nav-about">
            <div class="nav-menu-wrap nav-about">
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <span class="nav-submenu-title">关于UCloud</span>
                        </div>
                        <ul class="nav-submenu-about">
                            <li><a href="#">公司介绍</a></li>
                            <li><a href="#">联系我们</a></li>
                            <li><a href="#">加入我们</a></li>
                            <li><a href="#">开源工作</a></li>
                        </ul>
                    </div>
                    <div class="nav-submenu last nav-font-13">
                        <div class="nav-submenu-top">
                            <span class="nav-submenu-title">新闻资讯</span>
                        </div>
                        <ul class="nav-submenu-other">
                            <li><a href="#">最新动态</a></li>
                            <li><a href="#">媒体报道</a></li>
                            <li><a href="#" target="_blank">技术分享</a></li>
                            <li><a href="#">安全资讯</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
