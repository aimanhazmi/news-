<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025-12-05 22:28:44
 */

namespace app\modules\front\controllers;

use Yii;
use app\models\Category;
use yii\helpers\Url;
use app\service\ArticleService as SelfService;
use app\modules\admin\service\ArticleService;
use app\modules\admin\service\CategoryService;
use app\modules\admin\service\MemberAdvsService;

use app\components\ArrayToolkit;
use app\components\MobilePlug;
use app\components\CommonToolkit;

class ArticleController extends BaseController
{

    public function actionIndex($id)
    {
        try {
            $categoryTopId = 1;  // 总分类
            if ($id <= 0) {
                throw new \Exception("该页面不存在！");
            }
            // 更新PV
            SelfService::getInstance()->updateArticleView(['id' => $id]);

            $article        = ArticleService::getInstance()->getModelByIdf($id);
            $articleData    = $article->toArray();
    
            $isWechat       = CommonToolkit::getWechat();
 
            if ($isWechat) {
                $adv_source=['<>','adv_source','淘宝']; 
            } else {
                
                $adv_source=true;
            }
    

            //随机广告代码开始
            $Advsid         = MemberAdvsService::getInstance()->findModelAllid($adv_source);
            $Advrand        = array_rand($Advsid,18);        

           
            $AdvsInfo       = MemberAdvsService::getInstance()->findModelAll(['id'=>$Advrand]);
            //随机广告代码结束


            //$AdvsInfo       = MemberAdvsService::getInstance()->getadvsInfoByadvId($id);  //指定广告到当前内容页面



            


            $articleData['advs_info']   = $AdvsInfo;
            $articleData['title']       = $articleData['art_title'];



            $this->initSiteMeta($articleData);




            $category  = CategoryService::getInstance()->getModelById($categoryTopId);
            $categorys = CategoryService::getInstance()->search(['parent_id' => $category->id]);


            $category_article  = Category::getCategoryAll();

            $params = [
                'category_id' => $article['category_id'],
                'status' => 1
               ];

 
            $articles  = SelfService::getInstance()->getArticleLists($params);


            $articles_top_pv= $articles;
            $sort_pv=array_column($articles_top_pv['items'],'pv');
            array_multisort($sort_pv,SORT_DESC,$articles_top_pv['items']);

            $articles_top_times= $articles;
            $sort_pv=array_column($articles_top_times['items'],'updated_at');
            array_multisort($sort_pv,SORT_DESC,$articles_top_times['items']);


   


            $categoryMap = [];
            foreach ($category_article as $value) {
                $categoryMap[$value['id']] = $value['title'];
            }

            $articleData['category_names'] = $categoryMap[$articleData['category_id']] ?? '';

            foreach (['articles', 'articles_top_pv', 'articles_top_times'] as $listName) {
                foreach ($$listName['items'] as &$item) {
                    $item['category_names'] = $categoryMap[$item['category_id']] ?? '';
                }
                unset($item);
            }
 

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(Url::to([Yii::$app->params['notFoundUrl']]));
        }

     
        
        $articlestr = str_replace('。', '。<br><br>',$articleData['art_content']); 
        $articleData['art_content']=$articlestr;


        return $this->render('contents', [
            'article'   => $articleData,
            'articles_top_pv'   => $articles_top_pv,
            'articles_top_times'   => $articles_top_times,
            'articles'   => $articles,
            "category"  => $category,
            "categorys" => $categorys,
        ]);
    }

    public function actionContact()
    {
        return $this->actionIndex(122);
    }

    public function actionAbout()
    {
        return $this->render('aboutme');
    }


    // 行业资讯

    public function actionNews($id = 0)
    {
        try {
            $newsCategoryId = 7;  // 行业资讯总分类ID
            $showItemsSize  = 10; // 每页条数
            $newsCategory   = CategoryService::getInstance()->getModelById($newsCategoryId);
            $newsCategorys  = CategoryService::getInstance()->search(['parent_id' => $newsCategory->id]);
            $pageNo         = $_GET['page_no'] ?? 1;
            if ($id > 0) {
                $data = ArticleService::getInstance()->search([
                    'category_id' => $id,
                    'page_size'   => $showItemsSize,
                    'page_no'     => $pageNo,
                ], true);
            } else {
                $newsCategoryIds = ArrayToolkit::column($newsCategorys['items'] ?? [], 'id');
                $data            = ArticleService::getInstance()->search([
                    'category_ids' => $newsCategoryIds,
                    'page_size'    => $showItemsSize,
                    'page_no'      => $pageNo,
                ], true);
            }
        } catch (\Exception $e) {
            // 允许空列表，不 اعتبرها خطأ يعيد 404
            $data         = ['items' => [], 'first' => 1, 'current' => 1, 'before' => 1, 'next' => 1, 'limit' => 0, 'total_items' => 0, 'total_pages' => 1];
            $newsCategory = $newsCategory ?? null;
            $newsCategorys = $newsCategorys ?? ['items' => []];
        }

        return $this->render('contents-list', [
            'data'             => $data,
            "category"         => $newsCategory,
            "categorys"        => $newsCategorys,
            "categoryLinkPath" => '/news',
        ]);
    }




    public function actionSearch()
    {
        $newsCategoryId = 1; // 行业资讯总分类ID
        $showItemsSize  = 10; // 每页条数
        $newsCategory   = CategoryService::getInstance()->getModelById($newsCategoryId);
        $newsCategorys  = CategoryService::getInstance()->search(['parent_id' => $newsCategory->id]);

        if (isset($_GET['wd'])) {
            $searchWord = trim($_GET['wd']);
            $data       = ArticleService::getInstance()->search([
                'searchWord' => $searchWord,
                'page_size'  => $showItemsSize,
                'page_no'    => $_GET['page_no'] ?? 1,
            ], true);
        }

        return $this->render('search-list', [
            'data'      => $data ?? [],
            "category"  => $newsCategory,
            "categorys" => $newsCategorys,
        ]);
    }

    public function actionTag()
    {
        $newsCategoryId = 1; // 行业资讯总分类ID
        $showItemsSize  = 10; // 每页条数
        $newsCategory   = CategoryService::getInstance()->getModelById($newsCategoryId);
        $newsCategorys  = CategoryService::getInstance()->search(['parent_id' => $newsCategory->id]);

        if (isset($_GET['wd'])) {
            $searchWord = trim($_GET['wd']);
            $data       = ArticleService::getInstance()->search([
                'searchWord' => $searchWord,
                'page_size'  => $showItemsSize,
                'page_no'    => $_GET['page_no'] ?? 1,
            ], true);
        }

        return $this->render('search-list', [
            'data'      => $data ?? [],
            "category"  => $newsCategory,
            "categorys" => $newsCategorys,
        ]);
    }

}
