<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025-11-08 22:01:41
 */

namespace app\controllers;

use yii\helpers\Json;
use Yii;

class FileController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionImage()
    {
        try {
            if (Yii::$app->request->isPost) {
                $fileService    = Yii::$app->FileService;
                $fileName       = key($_FILES);
                if (empty($fileName)){
                    throw new \Exception('上传失败');
                }
                $data           = $fileService->uploadImageByName($fileName);
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
                        echo Json::encode($fileInfo);
                        return Yii::$app->end();
                    }
                }
            } else {
                return $this->responseApiError(100, '上传失败');
            }
        } catch (\Exception $e) {
            return $this->responseApiError(100, $e->getMessage());
        }
        return $this->responseApi($data);
    }
}