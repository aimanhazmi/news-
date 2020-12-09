<?php
/**
 * Created by PhpStorm.
 * User: whts
 * Date: 2020-05-06
 * Time: 14:54
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
                <li class="submenu dropdownshow"><a href="<?php echo Url::to("/")?>">首页</a></li>
                <li class="submenu dropdownshow" data-href="nav-product"><a href="<?php echo Url::to("/b/product/expand.html")?>">软件产品</a></li>
                <li class="submenu dropdownshow" data-href="nav-solution"><a href="<?php echo Url::to("/b/solution/retail.html")?>">产品方案</a></li>
                <li class="submenu dropdownshow" data-href="nav-case"><a href="<?php echo Url::to('/list-'.$this->params["cases"][0]["id"].'-0-cases.html'); ?>">客户案例</a></li>
                <li class="submenu dropdownshow" data-href="nav-activity"><a href="<?php echo Url::to('/list-'.$this->params["news"][0]["id"].'-0-news.html'); ?>">行业动态</a></li>
                <li class="submenu dropdownshow" data-href="nav-about"><a href="<?php echo Url::to("/b/ex/about.html")?>">关于我们</a></li>
            </ul>
        </div>
        <div class="top-wear-right">
            <div class="nav-search-wrap search-hide">
                <button title="搜索" id="nav-searchkey-button" class="icon__search search-button"></button>
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
            <a class="link-style vertical-position" href="#">文档</a>
<!--            <ul class="logined vertical-position dn">-->
<!--                <li class="login">-->
<!--                    <a href="#" class="user-name link-style"></a>-->
<!--                    <a href="#" class="link-style">退出</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="dib vertical-position" style="display:none;">-->
<!--                <li class="nologin vertical-position">-->
<!--                    <a href="register.html" class="button small button-general">快速注册</a>-->
<!--                </li>-->
<!--                <li class="vertical-position">-->
<!--                    <a href="login.html" target="_blank" class="button small button-ghost login tologin">登录控制台</a>-->
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
                    <a href="<?php echo Url::to("/b/product/expand.html")?>">拓客宝</a>
                    <a href="<?php echo Url::to("/b/product/ulive.html")?>">直播系统</a>
                    <a href="<?php echo Url::to("/b/product/bones.html")?>">股民引流落地页</a>
                </div>
                <div class="nav-category">
                    <ul class="category-type">
                        <li class="active">
                            <div class="title">营销类工具</div>
                            <div class="newprod">
                                <a href="<?php echo Url::to("/b/product/expand.html")?>">拓客宝</a>
                                <a href="<?php echo Url::to("/b/product/ulive.html")?>">直播系统</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">类金融系统</div>
                            <div class="newprod">
                                <a href="#">三农生态金融系统</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">期货业务系统</div>
                            <div class="newprod">
                                <a href="#">金融代理商佣金结算系统</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">互联网金融系统</div>
                            <div class="newprod">
                                <a href="#">消费分期系统</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">区块链金融系统</div>
                            <div class="newprod">
                                <a href="#">区块链金融系统</a>
                            </div>
                        </li>
                    </ul>
                    <div class="category-type-list">
                        <div class="nav-menu-list clearfix">
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">营销类工具包</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="<?php echo Url::to("/b/product/expand.html")?>">
                                            拓客宝
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Url::to("/b/product/ulive.html")?>">
                                            直播系统
                                            <i class="prod_tag">HOT</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Url::to("/b/product/bones.html")?>">
                                            股民引流落地页
                                            <i class="prod_tag dn"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="category-type-list dn">
                        <div class="nav-menu-list clearfix">
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
                        </div>
                    </div>
                    <div class="category-type-list dn">
                        <div class="nav-menu-list clearfix">
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">期货业务系统</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="#">
                                            金融代理商佣金结算系统
                                            <i class="prod_tag">HOT</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="category-type-list dn">
                        <div class="nav-menu-list clearfix">
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">互联网金融系统</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="#">
                                            消费分期系统
                                            <i class="prod_tag">HOT</i>
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
                    <div class="category-type-list dn">
                        <div class="nav-menu-list clearfix">
                            <div class="nav-submenu nav-font-13">
                                <div class="nav-submenu-top">
                                    <span class="nav-submenu-title">区块链金融系统</span>
                                </div>
                                <ul class="nav-submenu-prod">
                                    <li>
                                        <a href="#">
                                            区块链金融系统
                                            <i class="prod_tag">HOT</i>
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
                            <a href="<?php echo Url::to("/b/solution/retail.html")?>">
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
                            <a href="<?php echo Url::to("/b/solution/medical.html")?>">
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
                            <a href="<?php echo Url::to("/b/solution/overseas.html")?>">
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
                            <a href="<?php echo Url::to("/b/solution/financial.html")?>">
                                <span class="nav-submenu-title mr12">金融</span>
                                <i class="prod_tag org_tag">行业</i>
                                <div class="nav-font-color-6gray solution-minheight">
                                    互联网金融行业 | 银行业金融机构 | 证券行业
                                </div>
                            </a>
                        </div>
                        <!---->
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
            </div>
        </div>
        <div class="nav-menu-dropdown clearfix" id="nav-case">
            <div class="nav-menu-wrap nav-case">
                <div class="nav-menu-list clearfix">
                    <?php foreach($this->params["cases"] as $key=>$item):?>
                    <div class="nav-submenu nav-font-13 <?php echo $item["title"] == '游戏'?'last':''; ?>">
                        <div class="nav-submenu-top">
                            <a href="<?php echo Url::to('/list-'.$item["id"].'-'.$key.'-cases.html'); ?>">
                                <span class="nav-submenu-title"><?php echo $item["title"]; ?></span>

                                <div class="nav-font-color-6gray">
                                    <?php if($item["title"] == "教育"):?> 在线教育 | 培训机构 | 教务机构 | 中小学
                                    <?php elseif ($item["title"] == "金融"):?> 银行 | 证券 | 互联网金融
                                    <?php else:?> 手游 | 端游 | 游戏全球服
                                    <?php endif;?>
                                </div>
                            </a>
                        </div>
                        <ul class="nav-submenu-case">
                            <?php if($item["title"] == "教育"):?>
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
                            <?php elseif ($item["title"] == "金融"):?>
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
                            <?php else:?>
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
                            <?php endif;?>
                            <li><a href="#" class="more">更多</a></li>
                        </ul>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <div class="nav-menu-dropdown clearfix" id="nav-activity">
            <div class="nav-menu-wrap nav-about">
                <div class="nav-menu-list clearfix">
                    <div class="nav-submenu nav-font-13">
                        <div class="nav-submenu-top">
                            <span class="nav-submenu-title">行业动态</span>
                        </div>
                        <ul class="nav-submenu-other">
                            <?php foreach($this->params["news"] as $key=>$item):?>
                            <li><a href="<?php echo Url::to('/list-'.$item["id"].'-'.$key.'-news.html');?>"><?php echo $item["title"]; ?></a></li>
                            <?php endforeach;?>
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
                            <li><a href="about.html">公司介绍</a></li>
                            <li><a href="#">联系我们</a></li>
                            <li><a href="#">加入我们</a></li>
                            <li><a href="#">开源工作</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
