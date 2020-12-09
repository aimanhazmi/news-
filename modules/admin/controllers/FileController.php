<?php

namespace app\modules\admin\controllers;

use app\service\FileService;
use yii\helpers\Json;
use Yii;

class FileController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
    }

    public function actionImage()
    {
        try {
            if (Yii::$app->request->isPost) {
                $fileService    = Yii::$app->FileService;
                $data           = $fileService->uploadImageByName(key($_FILES));
                $data['imgUrl'] = Yii::getAlias('@upload_host') . $data['filePath'];
                if (isset($_GET['editorid'])) {
                    // 百度迷你编辑器文件上传逻辑
                    if ($_GET['editorid'] == 'umeditor') {
                        $fileInfo = [
                            "originalName" => '',
                            "name"         => '',
                            "url"          => $data['imgUrl'],
                            "size"         => '',
                            "type"         => '',
                            "state"        => 'SUCCESS',
                        ];
                        return Json::encode($fileInfo);
                        return Yii::$app->end();            
                    }
                }
            } else {
                return $this->responseApiError(100, '非法请求');
            }
        } catch (\Exception $e) {
            return $this->responseApiError(100, $e->getMessage());
        }
        return $this->responseApi($data);
    }

}
