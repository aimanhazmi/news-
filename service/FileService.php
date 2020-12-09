<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/1/22
 * Time: 23:28
 */

namespace app\service;

use yii\web\UploadedFile;
use yii\base\Object;
use Yii;

class FileService extends Object
{
    public $uploadDir;
    public $rsyncStatus        = 'off';
    public $rsyncCommand;
    public $rsyncServer;
    public $rsyncModule;
    public $unlinkOriginalFile = true;

    public static $instance;

    public static function getInstance(array $args = [])
    {
        if (!self::$instance) self::$instance = new self($args);
        return self::$instance;
    }

    /**
     * Created by lonisy@163.com
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function uploadImageByName(string $name = '')
    {
        $image = UploadedFile::getInstanceByName($name);
        if (!$image) {
            throw new \Exception('上传失败!');
        }
        $imageMimetypes = [
            'image/jpeg'              => 'jpe,jpeg,jpg',
            'image/gif'               => 'gif',
            'image/x-portable-anymap' => 'pnm',
            'image/x-icon'            => 'ico',
            'image/png'               => 'png',
            'image/svg+xml'           => 'svg',
            'image/webp'              => 'webp',
            'image/bmp'               => 'bmp',
            'image/cgm'               => 'cgm',
        ];
        if (!isset($imageMimetypes[$image->type])) {
            throw new \Exception('图片格式错误! fileType: ' . $image->type);
        }
        if ($image->size > 2048 * 1024) {
            throw new \Exception('图片最大不可超过2M');
        }
        $filePath[] = $baseDir = join("/", [Yii::getAlias('@app'), $this->uploadDir]);
        $filePath[] = date("Y");
        $filePath[] = date("md");
        $filePath[] = date('His') . rand(100, 999) . '.' . $image->getExtension();
        $filePath   = join("/", $filePath);
        $dir        = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        if (!$image->saveAs($filePath)) {
            throw new \Exception('上传图片失败!');
        }
        if ($this->rsyncStatus == 'on') {
            $this->distribute($baseDir, [$filePath]);
        }
        $filePaths            = explode($this->uploadDir, $filePath);
        $uploaded['filePath'] = $filePaths[1] ?? '';
        return $uploaded;
    }

    /**
     * Created by lonisy@163.com
     * 文件分发
     * @param string $baseDir 文件存放目录
     * @param array  $files   绝对路径
     * @throws \Exception
     */
    private function distribute(string $baseDir = './', array $files = [])
    {
        if (is_array($files)) {
            foreach ($files as $k=>$file) {
                $files[$k] = trim($file, $baseDir);
            }
            $files = implode(" ", $files);
        }
        if (empty($this->rsyncCommand)) {
            throw new \Exception('无 rsync 配置参数!');
        }
        $baseDir = preg_replace("/(\/|\\\)/", DIRECTORY_SEPARATOR, $baseDir);
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $cdCommand     = "cd /d";
            $comdSeparator = '&';
        } else {
            $cdCommand     = "cd";
            $comdSeparator = ';';
        }
        $output = "";
        // 外部建议传入数组
        $servers = explode(";", $this->rsyncServer);
        foreach ($servers as $server) {
            $serverAddress = empty($server) ? '' : $server . "::";
            \Yii::error('requestError: ' . PHP_EOL . $cdCommand . " " . $baseDir . $comdSeparator . $this->rsyncCommand . " " . $files . " " . $serverAddress . $this->rsyncModule . " 2>&1".PHP_EOL, __METHOD__);
            exec($cdCommand . " " . $baseDir . $comdSeparator . $this->rsyncCommand . " " . $files . " " . $serverAddress . $this->rsyncModule . " 2>&1",
                $output, $status);
            if ($status != 0) {
                throw new \Exception('文件同步失败: ' . json_encode($output));
            } else {
            }
        }
        if ($this->unlinkOriginalFile == true) {
            $files = explode(' ', $files);
            if (!empty($files)) {
                foreach ($files as $file) {
                    unlink($baseDir . '/' . $file);
                }
            }
        }
    }
}