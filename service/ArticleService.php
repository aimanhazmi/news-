<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/2 0002
 * Time: 上午 9:47
 */

namespace app\service;

use yii\data\Pagination as Paginolion;
use app\models\Article as ArticleModel;
use app\models\Category as CategoryModel;
use app\models\SysSite as SysSiteModel;
use app\components\RedisToolkit; 
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use Yii;

class ArticleService
{
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self();
        return self::$instance;
    }

    /***
     * 查询文章列表
     * @param array $reqData 请求数据 分类ID 文章标题
     * @return array
     */
    public function getArticleList(array $reqData)
    {
        //数据定义
        $param = array_filter($reqData);
        $where = ["status" => 1];

        //返回查询字段
        $fields = ['art_title', 'reltime', 'keywords', 'description', 'img_thumb', 'img_banner'];

        //定义条件
        (isset($param["parent_id"]) && intval($param["parent_id"]) > 0) && $where["parent_id"] = $param["parent_id"];
        isset($param["arti_title"]) && $where["arti_title"] = ["like", "%" . $param["arti_title"] . "%"];

        //准备语句
        $query = ArticleModel::find()->select($fields)->where($where);


        $SysSiteModel = SysSiteModel::find()->one();

        //初始化分页
        $pageNo   = isset($param['page_no']) ? intval($param['page_no'] - 1) : 2;
        $pageSize = isset($param['page_size']) ? intval($param['page_size']) : 2;
        $pages    = new Paginolion([
            'totalCount'    => $query->count(),
            'pageSizeParam' => false,
        ]);
        $pages->setPage($pageNo);
        $pages->setPageSize($pageSize > 100 ? 100 : $pageSize);

        //数据查询
        $data = $query->offset($pages->offset)->limit($pages->limit)->all();

        //返回数据
        return [
            "total"   => $pages->totalCount,
            "page"    => $pageNo + 1,
            "data"    => ArrayHelper::toArray($data),
            "syssite" => $SysSiteModel
        ];
    }


 
    public function articleslist(array $reqData)
 
    {
  
         $param = array_filter($reqData);
         
         $orders = ArticleModel::find()
         -> select('id')
         -> where(['category_id'=> $param,'status' => 1])
         -> orderBy('id desc')
         -> asArray()
//       -> groupBy('title') 
         -> limit(15);
           
            
         $items = ArticleModel::find()
         -> select('*')
         -> from(['t1' => $orders]) // 在这里使用了子查询 mender:coclu(bj_ljh)
         -> join('INNER JOIN',ArticleModel::tableName(), 'article.id=t1.id')
         -> asArray()
         -> all();

      
         foreach ( $items as $k => $v) {

            $orders = CategoryModel::find()
            -> where(['id'=> $param])  
            -> asArray()
            -> all();


            foreach ($orders as $key => $value) {
 
                if($v['category_id']==$value['id']){
                    $v['categoryd_name']=$value['cate_name'];
                }
              
           }
           

           $itemsds[]=$v;
         
         }

   
        //返回数据
        return [

            "items"    => ArrayHelper::toArray($itemsds),

        ];


  
    }

   



    public function getArticleLists(array $reqData)
    {

        $param = array_filter($reqData);
        $data = ArticleModel::find()->where($param)->limit(15)->all();

        //返回数据
        return [

            "items"    => ArrayHelper::toArray($data),

        ];

    }




    /***
     * 查询文章详情
     * @param array $reqData 请求数据 文章ID
     * @return array
     * @throws \Exception
     */
    public function getArticleContent(array $reqData)
    {
        //数据定义
        $param = array_filter($reqData);
        $where = [];

        //返回查询字段
        $fields = ["*"];

        //定义条件
        isset($param["id"]) && $where["id"] = $param["id"];
        if (count($where) == 0) {
            throw new Exception("缺少查询参数！");
        }
        //准备语句
        $data = ArticleModel::find()->select($fields)->where($where)->one();
        if (!$data) {
            throw new Exception("该内容不存在！");
        }
        //返回数据
        return ArrayHelper::toArray($data);
    }


    /***
     * 更新文章阅读量
     * @param array $reqData 请求数据 文章ID
     * @return array
     * @throws \Exception
     */
    public function updateArticleView(array $reqData)
    {
        //数据定义
        $param = array_filter($reqData);
        $where = [];
        $data  = false;

        //定义条件
        isset($param["id"]) && $where["id"] = $param["id"];
        if (count($where) == 0)
            throw new Exception("参数错误");

        //数据处理
        $res = ArticleModel::findOne($where);
        $res->pv++;
        if ($res->save())
            $data = true;

        //返回数据
        return [
            "data" => $data
        ];
    }

    /***
     * 文章分类列表
     * @param array $reqData 请求数据 父类ID
     * @return array
     * @throws \Exception
     */
    public function getArticleCategory(array $reqData)
    {
        //数据定义
        $param = array_filter($reqData);
        $where = ["status" => 1];

        //返回查询字段
        $fields = ['*'];

        //定义条件
        isset($param["parent_id"]) && $where["parent_id"] = $param["parent_id"];

        //准备语句
        $query = CategoryModel::find()->select($fields)->where($where);

        //初始化分页
        $pageNo   = isset($param['page_no']) ? intval($param['page_no'] - 1) : 0;
        $pageSize = isset($param['page_size']) ? intval($param['page_size']) : 10;
        $pages    = new Paginolion([
            'totalCount'    => $query->count(),
            'pageSizeParam' => false,
        ]);
        $pages->setPage($pageNo);
        $pages->setPageSize($pageSize > 100 ? 100 : $pageSize);

        //数据查询
        $data = $query->offset($pages->offset)->limit($pages->limit)->all();

        //返回数据
        return [
            "total" => $pages->totalCount,
            "page"  => $pageNo + 1,
            "data"  => ArrayHelper::toArray($data)
        ];
    }


    public function getArticlePv()
    {
      
        $Articlepv = ArticleModel::find()->max('pv');
        $where=['and','status=1',['<=','pv', $Articlepv]];
        $Articlepvs= ArticleModel::find()
                     ->select('id')
                     ->where($where)
                     ->all();

       $Articlepvsd= ArticleModel::find()
                     ->where(['id'=>$Articlepvs])
                     ->orderBy('pv desc')
                     ->limit(8)
                     ->all();


       //返回数据
        return [
            "items" => ArrayHelper::toArray($Articlepvsd)
        ];
    
    } 






}