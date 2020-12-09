<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:28:44
 */

namespace app\modules\front\controllers;

use Yii;
use app\models\Category;
use yii\helpers\Url;
use app\modules\admin\service\ArticleService;
use app\modules\admin\service\CategoryService;
use yii\web\Response;
use yii\helpers\ArrayHelper;

class CategoryController extends BaseController
{

    public function actionIndex($id = 0)
    {

 

        try {
            if ($id <= 0) {
                throw new \Exception("该页面不存在！");
            }
      
                
               $category = CategoryService::getInstance()->getModelById($id);
               $this->initSiteMeta($category->toArray());
                 

               $categoryTopId = $id;  // 总分类
               $tabsCategory  = CategoryService::getInstance()->getModelById($categoryTopId); //查父分类
               $tabsCategorys = CategoryService::getInstance()->search(['parent_id' => $tabsCategory->id]); //查子分类        
        
        

              foreach ($tabsCategorys['items'] as $key => $value) { 
                       $valuesd[]=$value['id'];
              }        

         
              $params = [
                 'category_id' =>  $valuesd,
                  'page_size'   => 16,
                ];
                        

                if (isset($_GET['page_no']) && $_GET['page_no'] > 0) {
                 $params['page_no'] = $_GET['page_no'];
                }
     

            //   $redis         = Yii::$app->redis;
            //   $category_Result = $redis->keys('category:items'.$id);
          
      
            // if($category_Result){
     
            //    $category_itemsResult = $redis->get('category:items'.$id);
            //    $data=ArrayHelper::toArray(json_decode($category_itemsResult)); 
                
     
            //  }else{

                $data= ArticleService::getInstance()->search($params);
            //    $redis->set('category:items'.$id,json_encode($data));  
            //  }
        
              
             $top_pv_data= $data;
             $sort_pv=array_column($top_pv_data['items'],'pv');
             array_multisort($sort_pv,SORT_DESC,$top_pv_data['items']);



        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(Url::to([Yii::$app->params['notFoundUrl']]));
        }


        return $this->render('images-lists', [
            'data'         => $data,
            'top_pv_data'  =>$top_pv_data,
            'category'     => $category,
            'tabsData'     => $tabsCategorys,
            'tabsCategory' => $tabsCategory,
        ]);
    }



    public function actionCategorylist($id = 0)
    {
    
        try {
            if ($id <= 0) {
                throw new \Exception("该页面不存在！");
            }
    
          $categoryTopId = $id;  // 总分类    
          $tabsCategory  = CategoryService::getInstance()->getModelById($categoryTopId); //查父分类   
          $tabsCategorys = CategoryService::getInstance()->search(['parent_id' => $tabsCategory->parent_id]); //查子分类 
          $Categorys = CategoryService::getInstance()->getModelById($tabsCategory->parent_id);


           $params = [
             'category_id' => $tabsCategory->id,
             'page_size'   => 16,
            ];

            
           if (isset($_GET['page_no']) && $_GET['page_no'] > 0) {
              $params['page_no'] = $_GET['page_no'];
          }
  
           $data = ArticleService::getInstance()->search($params);
          
           
           $top_pv_data= $data;
           $sort_pv=array_column($top_pv_data['items'],'pv');
           array_multisort($sort_pv,SORT_DESC,$top_pv_data['items']);



        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(Url::to([Yii::$app->params['notFoundUrl']]));
        }

        return $this->render('images-list', [
            'data'         => $data,
            'top_pv_data'  =>$top_pv_data,
            'categorys'     => $Categorys,
            'tabsData'     => $tabsCategorys,
            'tabsCategory' => $tabsCategory,
        ]);
 
    }






}