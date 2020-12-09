<?php
namespace app\modules\broadcast\controllers;
/**
 * Created by PhpStorm.
 * User: whts
 * Date: 2020-05-06
 * Time: 11:59
 */
class ProductController extends BaseController
{
    /**
     * 拓宝客
    */
    public function actionExpand()
    {
        return $this->render("",[]);
    }

    /**
     * 直播系统
    */
    public function actionUlive()
    {
        return $this->render("",[]);
    }

    /**
     * 股民引流
    */
    public function actionBones()
    {
        return $this->render("ld_page",[]);
    }
}