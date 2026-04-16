<?php
use yii\helpers\Url;
?>
<div class="submain-navbg"></div>
<div class="main">
    <div class="sub-main product">
        <div class="nav-wrap">
            <h2>产品&服务<span class="en">PRODUCTS</span></h2>
            <ul class="main-nav">
                <!-- 营销类工具包 -->
                <li class="first-node father active">
                    营销类工具包
                    <span class="black-top mini left-nav-prod-pos"><i class="black-top1"></i></span>
                    <ul class="nav">
                        <li>
                            <a href="<?php echo Url::to("/b/product/expand.html")?>">
                                <i class="icon__uhost prod"></i>
                                拓客宝
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo Url::to("/b/product/ulive.html")?>">
                                <i class="icon__uphost prod"></i>
                                直播系统
                            </a>
                        </li>
                        <li  class="focus">
                            <a href="<?php echo Url::to("/b/product/bones.html")?>">
                                <i class="icon__gpu prod"></i>
                                股民引流落地页
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- 期货业务系统 -->
                <li class="first-node father">
                    期货业务系统
                    <span class="black-top mini left-nav-prod-pos"><i class="black-top1"></i></span>
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <i class="icon__unet prod"></i>
                                金融代理商佣金结算系统
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- 类金融系统 -->
                <li class="first-node father">
                    类金融系统
                    <span class="black-top mini left-nav-prod-pos"><i class="black-top1"></i></span>
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <i class="icon__udb prod"></i>
                                新三农生态金融系统
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon__udb prod"></i>
                                新生态供应链金融系统
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon__udb prod"></i>
                                汽车金融系统
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon__umem prod"></i>
                                私募股权投资管理系统
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon__uddb prod"></i>
                                金融知识付费问答系统
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon__udb prod"></i>
                                影视众筹系统
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon__tidb prod"></i>
                                融资租赁系统
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- 互联网金融系统  -->
                <li class="first-node father">
                    互联网金融系统
                    <span class="black-top mini left-nav-prod-pos"><i class="black-top1"></i></span>
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <i class="icon__udisk prod"></i>
                                消费分期系统
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon__ufile prod"></i>
                                金频反欺诈系统
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- 区块链应用 -->
                <li class="first-node father">
                    区块链应用
                    <span class="black-top mini left-nav-prod-pos"><i class="black-top1"></i></span>
                    <ul class="nav">
                        <li>
                            <a href="/site/product/ucdn.html">
                                <i class="icon__ucdn prod"></i>
                                区块链应用
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
        <script>
            (function() {
                function foucs(i) {
                    if(i!=null) {
                        $('.main-nav .first-node').eq(i).addClass('active').find('.nav li').hasClass('focus');
                    } else {
                        $('.main-nav .first-node').eq(i).addClass('focus')
                    }
                }
                foucs({
                    118: 0,
                    229: 1,
                    230: 2,
                    119: 3,
                    648: 4,

                    215: 5,
                    120: 6,
                    380: 7,
                    912: 8,
                    703: 9,

                    217: 10,
                    625: 11,
                    121: 12,
                    1023: 13,
                    307: 14,

                    914: 15
                }[215]);
            })();
        </script>

        <div class="content-wrap">
            <div class="product-dash">
                <div class="prod-img"><img src="/static/broadcast/images/5-1609191T414336.png"></div>
                <h2>
                    股民引流落地页
                </h2>
                <p>
                    有金融类自媒体平台资源数百个，我们坚持拒绝二套贩子！更拒绝工具作弊，凭借自身平台优势与行业特性的掌握，从心底做一个更有担当的事业。
                </p>
                <div class="prod-operating">
                    <a href="#" class="button1 blue">免费申请</a>
                </div>



            </div>
            <div id="navbar-example">
                <ul class="sub-tabs-x anchor nav nav-tabs" role="tablist">
                    <li>
                        <a href="#odds">优势</a>
                    </li>

                    <li>
                        <a href="#funct">功能</a>
                    </li>

                    <li>
                        <a href="#jiagou">架构示例</a>
                    </li>
                </ul>
            </div>
            <script>
                $('.sub-tabs-x li:eq(0)').addClass('active');
                $('.nav a[href="/site/product/ulive.html"]').parent('li').addClass('focus');
            </script>
            <div class="tab-content sub-tab-cont">
                <div id="odds">
                    <h2 class="h2">
                        优势</h2>
                    <div class="prod-anchor">
                        <h5 class="h5">
                            一站式直播云服务 助您专注内容生产</h5>
                        <p class="text">
                            提供集前端视频推流播放，后台视频转码处理，网络直播传输加速为一体化的视频直播服务。无需关注基础设施和底层软件模块，助您专注视频内容生产及业务推广。</p>
                        <h5 class="h5">
                            极速加载 流畅高清 良好观看体验</h5>
                        <p class="text">
                            高效转码集群降低带宽占用，断点续流技术提升视频传输质量，CDN智能调度机制优化直播传输链路。直播内容1秒载入、延迟控制1-2秒、全程高清流畅带来流畅直播观赏效果。</p>
                        <h5 class="h5">
                            高并发 大流量 支持百万用户观看</h5>
                        <p class="text">
                            200+CDN加速节点、覆盖范围广阔、解决终端用户分布不均、网络质量差的地域问题。 Tbps级别带宽承载能力，轻松支持海量用户并发访问，实现数百万用户同时访问观看。</p>
                        <h5 class="h5">
                            推流认证 访问鉴权 保护内容产权</h5>
                        <p class="text">
                            提供推流认证策略，从推流端阻断非法推流，同时支持访问鉴权策略，在用户端实现权限分级保护，验证用户访问权限。最终降低直播内容盗用风险及成本损失，提升客户合规性要求。</p>
                        <h5 class="h5">
                            &nbsp;</h5>
                    </div>
                </div>
                <br type="_moz">



                <div id="funct">
                    <h2 class="h2">
                        产品功能</h2>
                    <div class="prod-anchor">
                        <br>
                        <div style="display: flex; justify-content: space-around;">
                            <ul>
                                <li class="h5">
                                    录制转点播</li>
                                <li style="list-style-type: disc;">
                                    支持实时录制</li>
                                <li style="list-style-type: disc;">
                                    支持自动保存</li>
                                <li style="list-style-type: disc;">
                                    支持智能拼接</li>
                            </ul>
                            <ul>
                                <li class="h5">
                                    访问鉴权</li>
                                <li style="list-style-type: disc;">
                                    支持安全加密</li>
                                <li style="list-style-type: disc;">
                                    支持权限分级</li>
                                <li style="list-style-type: disc;">
                                    支持内容保护</li>
                            </ul>
                            <ul>
                                <li class="h5">
                                    直播截图</li>
                                <li style="list-style-type: disc;">
                                    支持关键帧截取</li>
                                <li style="list-style-type: disc;">
                                    支持自定义周期</li>
                                <li style="list-style-type: disc;">
                                    支持自动化操作</li>
                            </ul>
                            <ul>
                                <li class="h5">
                                    直播支持码率</li>
                                <li style="list-style-type: disc;">
                                    360P</li>
                                <li style="list-style-type: disc;">
                                    480P</li>
                                <li style="list-style-type: disc;">
                                    540P</li>
                                <li style="list-style-type: disc;">
                                    720P</li>
                                <li style="list-style-type: disc;">
                                    1080P</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <br type="_moz">

                <div id="jiagou">
                    <h2 class="h2">
                        架构示例</h2>
                    <div class="prod-anchor">
                        <img alt src="/static/broadcast/images/89f5126bee4a9aa0326cb39920d5ece4.png" style="width: 809px;">
                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UCloud提供简单易用、功能丰富的SDK工具包及API接口，包含推流端和播放器端，支持rtmp，hls及hdl协议。</div>
                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可实现：</div>
                        <div>
                            <ul style="margin-left: 45px; list-style-type: disc;">
                                <li>
                                    多终端：支持iOS、Android、PC多平台播放</li>
                                <li>
                                    低延时：智能调度，上行下行双向加速，直播延时1-2s</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>

            </div>
        </div>
    </div>
</div>
<?php echo $this->render("../layouts/common");?>