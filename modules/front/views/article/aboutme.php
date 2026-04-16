<hr>

<div class="row m-tb-30 page_banne_about">
    <div class="row col-xs-1" style="height:500px">
        <ul class="row nav nav-stacked">
            <li class="active"><a href="###" data-target="#tab3Content1" data-toggle="tab">关于我们</a></li>
            <li><a href="###" data-target="#tab3Content2" data-toggle="tab">联系我们</a></li>
            <li><a href="###" data-target="#tab3Content3" data-toggle="tab">商务合作</a></li>
        </ul>
    </div>
    <div class="col-xs-11">
        <div class="tab-content" style="padding-left:50px;height:500px">
            <div class="tab-pane fade active in" id="tab3Content1">


                <div class="jumbotron">
                    <h2>关于我们</h2>
                    <p><?=$this->params['description']?></p>
                    <p>
                        云易新闻，以各大网络资讯｜本站原创等各类新闻，各类文字信息、专题资料、图片、音视频资料等信息予以展示，已经本网协议授权的媒体、网站，在下载使用时必须注明"稿件来源"，违者本网将依法追究责任。

                    </p>

                </div>

                <p class="label label-default"></p>

            </div>
            <div class="tab-pane fade" id="tab3Content2">

                <div class="jumbotron">
                    <h2>联系我们</h2>
                    <p>邮箱：<?=$this->params['email']?></p>
                    <p>ＱＱ：<?=$this->params['qq']?></p>
                </div>
            </div>
            <div class="tab-pane fade" id="tab3Content3">
                <div class="jumbotron">
                    <h2>商务合作</h2>
                    <p>需要发布各类文字信息、专题资料、图片、音视频资料等广告信息，洽谈后予以合作！</p>
                </div>
            </div>
        </div>
    </div>
</div>