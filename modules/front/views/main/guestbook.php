<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-09 08:57:32
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->render('/layouts/recommend'); ?>
        </div>
    </div>
    <div class="row guestbook">
        <div class="col-md-3">
            <?php echo $this->render('/layouts/category-tabs', ['data' => $categorys, 'category' => $category]); ?>
            <?php echo $this->render('/layouts/category-tabs-style-1'); ?>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">在线留言</h5>
                </div>
                <div class="panel-body">
                    <div class="tips">
                        <h3>在线留言</h3>
                        <p>请一定填写您的真实信息，以便我们的工作人员及时的联系到您！</p>
                        <p>我们会对您所留的个人信息进行保密，请放心填写！</p>
                    </div>
                    <form id="guest-book-form" class="form-horizontal" method="post">
                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                            <div class="alert alert-danger"><?php echo Yii::$app->session->getFlash('error'); ?></div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="Id-title" class="col-sm-2 col-md-offset-1 control-label">主题：</label>
                            <div class="col-sm-5">
                                <input type="text" name="title" class="form-control" id="Id-title" placeholder="请输入主题">
                                <span class="help-block">必选项*</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Id-content" class="col-sm-2 col-md-offset-1  control-label">留言内容：</label>
                            <div class="col-sm-5">
                                <textarea name="content" class="form-control" id="Id-content" cols="30"
                                          rows="5" placeholder="请输入留言内容"></textarea>
                                <span class="help-block">必选项*</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Id-author" class="col-sm-2 col-md-offset-1 control-label">联系人：</label>
                            <div class="col-sm-5">
                                <input type="text" name="author" class="form-control" id="Id-author" placeholder="请输入联系人姓名">
                                <span class="help-block">必选项*</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Id-phone" class="col-sm-2 col-md-offset-1 control-label">手机：</label>
                            <div class="col-sm-5">
                                <input type="text" name="phone" class="form-control" id="Id-phone" placeholder="请输入手机">
                                <span class="help-block">必选项*</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Id-address" class="col-sm-2 col-md-offset-1 control-label">地址：</label>
                            <div class="col-sm-5">
                                <input type="text" name="address" class="form-control" id="Id-address" placeholder="请输入地址">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Id-email" class="col-sm-2 col-md-offset-1 control-label">邮箱：</label>
                            <div class="col-sm-5">
                                <input type="text" name="email" class="form-control" id="Id-email" placeholder="请输入邮箱">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <button type="button" class="btn btn-default guestbook-submit">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

