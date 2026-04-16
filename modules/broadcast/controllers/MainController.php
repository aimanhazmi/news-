<?php
/**
 * Created by aiman
 * User: whts
 * Date: 2025-05-06
 * Time: 11:16
 */
namespace app\modules\broadcast\controllers;

use Yii;
use app\modules\admin\service\ArticleService;
use app\modules\admin\service\CategoryService;
use app\components\ArrayToolkit;

class MainController extends  BaseController {
    /**
     * 首页
    */
    public function actionIndex()
    {
        return $this->render("",[]);
    }
    /**
     * 分类文章列表
     * @param   int       $id   分类ID
     * @param   int       $seq  选取位置
     * @param   string    $t   分类(cases=>"案例",news=>"动态")
     * @return  string
     * @throws
    */
    public function actionCases($id=0,$seq=0,$t="cases")
    {
        $newsCategory   = CategoryService::getInstance()->getModelById($id);
        $newsCategoryIds = ArrayToolkit::column($this->view->params[$t], 'id');
        if(!isset(array_flip($newsCategoryIds)[$id])){
            throw new \Exception("该页面不存在！");
        }
        if ($id > 0) {
            $data = ArticleService::getInstance()->search([
                'category_id' => $id,
                'page_size'   => $this->itemsSize,
                'page_no'     => $_GET['page_no'] ?? 1,
            ]);
        } else {
            $newsCategoryIds = ArrayToolkit::column($this->view->params[$t], 'id');
            $data            = ArticleService::getInstance()->search([
                'category_ids' => $newsCategoryIds,
                'page_size'    => $this->itemsSize,
                'page_no'      => $_GET['page_no'] ?? 1,
            ]);
        }
        //关联产品数据
        $products = ArticleService::$instance->findProductData();
        return $this->render('category-list', [
            'data'              => $data,
            "category"          => $newsCategory,
            "seq"               => isset($this->pos[$seq])?$this->pos[$seq]:$seq,
            "type"              => $t,
            "products"          => $products,
        ]);
    }

    /**
     * 文章详情
     * @param   int $id 文章ID
     * @param   int $cat 文章所属分类
     * @return  string
     * @throws
    */
    public function actionDetail($id=0,$cat=0)
    {
        $categoryItem = [];//当前分类和子分类
        $categoryData = $this->view->params["news"]; //新闻分类

        //文章数据和分类
        $data = ArticleService::getInstance()->findModel($id);
        //获得分类关系
        array_walk($categoryData,function($item) use($cat,&$categoryItem){
            if($item["id"] == $cat) {
                $categoryItem["item"] = $item;
                $categoryItem["parent"] = CategoryService::getInstance()->getModelById($item["parent_id"])->toArray();
            }
        });
        //上一篇 下一篇
        $pnData = ArticleService::getInstance()->findBlurModel($id,$cat);
        //热门文章
        $topsArticle = ArticleService::getInstance()->search([
            'category_ids' => ArrayToolkit::column($categoryData, 'id'),
            'page_size'   => $this->itemsSize,
            'page_no'     => $_GET['page_no'] ?? 1,
        ]);
        $topArticle = array_filter($topsArticle["items"],function($item){
            if($item["istop"]) return $item;
            return [];
        });
        return $this->render("article-detail",[
            'data' => $data,
            'first_name'    =>  $categoryItem["item"]["title"],
            'second_name'   =>  $categoryItem["parent"]["title"],
            'tops'          =>  $topArticle,
            "up_down"       =>  $pnData
        ]);
    }

}