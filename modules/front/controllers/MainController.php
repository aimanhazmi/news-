<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/2 0002
 * Time: 下午 1:56
 */

namespace app\modules\front\controllers;
use Yii;
use app\models\Category;
use app\models\Article;
use app\service\ArticleService as SelfService;
use app\modules\admin\service\ArticleService;
use yii\helpers\Url;
use app\modules\admin\service\CategoryService;
use app\modules\admin\service\GuestBookService;
use app\components\ArrayToolkit;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class MainController extends BaseController
{

    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        try {

           $redis         = Yii::$app->redis;
           $index_Result = $redis->keys('index:items');
           $index_Resultpv = $redis->keys('index:itemspv');
     


           $key1 = 'index:items_hmset_pc';
           $key2 = 'index:items_hmset_pcpv';

           $index_Result = $redis->hget('index:items', $key1);
           $index_Resultpv = $redis->hget('index:items', $key2);
   
           if($index_Result && $index_Resultpv){

              $articles=ArrayHelper::toArray(json_decode($index_Result)); 
              $articlespv=ArrayHelper::toArray(json_decode($index_Resultpv)); 
  
            }else{


                $categoryTopId     =1;  // 总分类
      //          $showItemsSize     = 15; // 首页展示条数
    
                $category          = CategoryService::getInstance()->getModelById($categoryTopId);
                $categorys         = CategoryService::getInstance()->search(['parent_id' => $category->id]);
                $categoryIds       = ArrayToolkit::column($categorys['items'], 'id');
      
       
                 foreach ($categoryIds as $key => $value) {
     
                     $categorysisd = CategoryService::getInstance()->search(['parent_id' => $value]);
                     $categoryIdsd[]       = ArrayToolkit::column($categorysisd['items'], 'id');
     
                 }
     
                 foreach ($categoryIdsd as $k => $val) {
     
                    $articles[]=SelfService::getInstance()->articleslist($val);
     
                 
                 }

                 $articlespv=SelfService::getInstance()->getArticlePv();
           
                 $redis->hmset('index:items', $key1, json_encode($articles));
                 $redis->hmset('index:items', $key2, json_encode($articlespv));

  
          
            }


            $sort_time=array_column($articles[0]['items'],'updated_at');
            array_multisort($sort_time,SORT_DESC,$articles[0]['items']);


            $articles_pv_top=$articles[0];
            $sort_pv=array_column($articles_pv_top['items'],'pv');
            array_multisort($sort_pv,SORT_DESC,$articles_pv_top['items']);
    

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(Url::to([Yii::$app->params['notFoundUrl']]));
        }

        return $this->render('index', [
            'articlesd'             =>  $articles, 
            'articlesdpv'             =>  $articlespv,             
            'articles_pv_top'     =>$articles_pv_top,
        ]);  
    }






    public function actionIndex_post()
    { 
      
        if($_POST['num'] ){

          

        $categoryTopId1 =1;  // 总分类
     
        $category1          = CategoryService::getInstance()->getModelById($categoryTopId1);
        $categorys1         = CategoryService::getInstance()->search(['parent_id' => $category1->id]);
        $categoryIds1       = ArrayToolkit::column($categorys1['items'], 'id');


        $categorys         = CategoryService::getInstance()->search(['parent_id' =>  $categoryIds1 ]);
        $categoryIds       = ArrayToolkit::column($categorys['items'], 'id');

        $showItemsSize  = 10; // 每页条数
              
        $redis         = Yii::$app->redis;
        $key = 'index:items_hmset'.$_POST['num'];
        $index_Result = $redis->hget('index:ajax', $key);

        if($index_Result){
           $data=ArrayHelper::toArray(json_decode($index_Result)); 
         }else{

            $data  = ArticleService::getInstance()->search([
                'page_size'  => $showItemsSize,
                'category_id' =>  $categoryIds,
                'page_no'    => $_POST['num'] ?? 1,
            ], true);

            $redis->hmset('index:ajax', $key, json_encode($data));

         }    



      }else {
        $data=['msg'=>'非法请求'];
      }

      Yii::$app->response->format=Response::FORMAT_JSON;
      return $data;

    }





    public function actionCategory_post($id = 0)
    { 
      
        if($_POST['num'] && $_POST['id'] ){

        $categoryTopId = $_POST['id'];  // 总分类    
        $tabsCategory  = CategoryService::getInstance()->getModelById($categoryTopId); //查父分类   
        $tabsCategorys = CategoryService::getInstance()->search(['parent_id' => $tabsCategory->parent_id]); //查子分类 
        $Categorys = CategoryService::getInstance()->getModelById($tabsCategory->parent_id);


        $showItemsSize  = 10; // 每页条数


        $redis         = Yii::$app->redis;
        $key = 'category:items_hmset'.$tabsCategory->id.$_POST['num'];
        $category_Result = $redis->hget('category:ajax', $key);

        if($category_Result){
           $data=ArrayHelper::toArray(json_decode($category_Result)); 
         }else{
            
             $data  = ArticleService::getInstance()->search([
                 'page_size'  => $showItemsSize,
                 'category_id' => $tabsCategory->id,
                 'page_no'    => $_POST['num'] ?? 1,
             ], true);
   
             $redis->hmset('category:ajax', $key, json_encode($data));

            }    

      }else {
        $data=['msg'=>'非法请求'];
      }

      Yii::$app->response->format=Response::FORMAT_JSON;
      return $data;

    }






    public function actionCategorys_post($id = 0)
    { 
    
        
        if($_POST['num'] && $_POST['id'] ){

        $categoryTopId = $_POST['id'];  // 总分类   

        $tabsCategory  = CategoryService::getInstance()->getModelById($categoryTopId); //查父分类
        $tabsCategorys = CategoryService::getInstance()->search(['parent_id' => $tabsCategory->id]); //查子分类
        $categoryIds       = ArrayToolkit::column($tabsCategorys['items'], 'id');


        $showItemsSize  = 10; // 每页条数


        $redis         = Yii::$app->redis;
        $key = 'categorys:items_hmset'.$tabsCategory->id.$_POST['num'];
        $categorys_Result = $redis->hget('categorys:ajax', $key);

        if($categorys_Result){
           $data=ArrayHelper::toArray(json_decode($categorys_Result)); 
         }else{
            
              $data  = ArticleService::getInstance()->search([
                  'page_size'  => $showItemsSize,
                  'category_id' => $categoryIds,
                  'page_no'    => $_POST['num'] ?? 1,
              ], true);
      
              $redis->hmset('categorys:ajax', $key, json_encode($data));

          }    

       }else {
        $data=['msg'=>'非法请求'];
      }

      Yii::$app->response->format=Response::FORMAT_JSON;
      return $data;


    }







    /***
     * 获得文章
     * @return mixed
     */
    protected function getBottomArticle($categoryId = 3)
    {
        $params = [
            'page_size'   => 3,
            'category_id' => $categoryId
        ];
        if (isset($_GET['page_no']) && $_GET['page_no'] > 0) {
            $params['page_no'] = $_GET['page_no'];
        }
        return ArticleService::getInstance()->search($params);
    }


    public function actionNotfound()
    {
        Yii::$app->response->statusCode = 400;
      //  Yii::$app->response->send();
        return $this->renderPartial('Notfound');
   
    }

    public function actionGuestbook()
    {
        try {
            if (Yii::$app->request->isPost) {
                GuestBookService::getInstance()->create($_POST);
                return $this->responseApi(true);
            }
        } catch (\Exception $e) {
            return $this->responseApiError(1, $e->getMessage());
        }
        $categoryTopId = 2;  // 总分类
        $category      = CategoryService::getInstance()->getModelById($categoryTopId);
        $categorys     = CategoryService::getInstance()->search(['parent_id' => $category->id]);
        return $this->render($this->action->id, [
            'category'  => $category,
            'categorys' => $categorys,
        ]);
    }

   
    public function actionRepairdata()
    {
        $articleCount  = Article::getArticleCount();

        $i=72184;
        $sumf=1;
        while($i<=$articleCount) {
            $article  = Article::getArticleOne($i);
            if($article['id']){
            $imgpath='/data/html/news/web'.$article['img_big'];
            if(is_file($imgpath)){
              echo 'The file already exists ID='.$i.'  '.$imgpath;
              echo "<br />";
            }else{
                echo '没有找到图片'.$sumf;

                $sumf++;
               $delarticle  = Article::delArticleOne($i);
               if($delarticle){
                echo 'delete  '.$imgpath.'    ok';
                echo "<br />";
                }
               
            }
        }else{
            echo '没有找到数据';
            echo "<br />";
        }

        $i++;

      }
      exit;
    }
    
    


}