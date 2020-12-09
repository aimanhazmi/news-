<?php
/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/8/25
 * Time: 13:35
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl  = '@web';

    /**
     * Created by lonisy@163.com
     * @param $view
     */
    public static function loadBootstrapTablePlugin($view)
    {
        $cssFiles = [
            '/static/vendors/bootstrap3-dialog/css/bootstrap-dialog.min.css',
            '/static/vendors/jquery-toastr/toastr.min.css',
        ];
        $jsFiles  = [
            '/static/vendors/bootstrap3-dialog/js/bootstrap-dialog.min.js',
            '/static/vendors/jquery-toastr/toastr.min.js',
        ];
        self::registerCssFiles($cssFiles, $view);
        self::registerJsFiles($jsFiles, $view);
    }

    /**
     * Created by lonisy@163.com
     * @param array $Files
     * @param       $view
     */
    public static function registerJsFiles(array $Files, $view)
    {
        array_walk($Files, function($file) use ($view) {
            self::addJs($view, $file);
        });
    }

    /**
     * Created by lonisy@163.com
     * @param array $Files
     * @param       $view
     */
    public static function registerCssFiles(array $Files, $view)
    {
        array_walk($Files, function($file) use ($view) {
            self::addCss($view, $file);
        });
    }


    /**
     * Created by lonisy@163.com
     * @param $view
     * @param $file
     */
    public static function addScript($view, $file)
    {
        return self::addJs($view, $file);
    }

    /**
     * Created by lonisy@163.com
     * @param $view
     * @param $file
     */
    public static function addCss($view, $file)
    {
        $view->registerCssFile(self::iniAssets($file), ['type' => 'text/css', 'rel' => 'stylesheet']);
    }


    /**
     * @param $view
     * @param $jsfile
     * 在页面上添加 Js 文件
     * 参数为外连文件的属性 'type'=>"text/javascript"
     * depends 参数为是否依赖当前资源
     */
    public static function addJs($view, $file)
    {
        $view->registerJsFile(self::iniAssets($file));
    }

    public static function addEs6Js($view, $file)
    {
        $view->registerJsFile(self::iniAssets($file), ['type' => 'es6']);
    }

    public static function set($assets, $view)
    {
        $assets      = is_array($assets) ? $assets : explode(',', $assets);
        $assetsTypes = ['js', 'css', 'bundle'];
        if (isset($assets[0]) && is_array($assets)) {
            $assets = array_unique($assets);
            foreach ($assets as $item) {
                $files = self::loadFiles($item);
                if (isset($files[0])) {
                    foreach ($files as $file) {
                        $assetsType = null;
                        if (is_string($file)) {
                            $assetsType = pathinfo($file, PATHINFO_EXTENSION);
                        } else if (is_array($file) && isset($file[0])) {
                            $assetsType = pathinfo($file[0], PATHINFO_EXTENSION);
                        }
                        if ($assetsType && in_array($assetsType, $assetsTypes)) {
                            $addType = "add" . ucfirst($assetsType);
                            if (is_array($file) && isset($file[1])) {
                                self::$addType($view, $file[0]);
                            } else {
                                self::$addType($view, $file);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * 加载资源
     * @param $item string
     * @return array|bool
     */
    public static function loadFiles($item)
    {
        if (empty($item))
            return false;
        $itemType = pathinfo($item, PATHINFO_EXTENSION);
        $assets   = [];
        switch ($itemType) {
            case 'js':
                $assets = [
                    'jquery.imagezoom.js' => '/static/js/jquery.imagezoom.min.js',
                    'vue.js'              => '/static/js/vue' . (YII_ENV != 'dev' ? '.min' : '') . '.js',
                    'manage.js'           => '/static/app/public/manage.min.js',
                    'modify.js'           => '/static/app/public/modify.min.js',
                ];
                break;
            case 'css':
                $assets = [
                    'animate.css' => 'assets/plugins/animate/animate.css',
                ];
                break;
            case 'bundle':
                $assets = [
                    'bootstrap-table.bundle'          => [
                        '/assets/plugins/bootstrap-table/bootstrap-table.min.css',
                    ],
                    'highcharts.bundle'               => [
                        '/static/vendors/jquery-highcharts/highcharts.js',
                        '/static/vendors/jquery-highcharts/highcharts-more.js',
                        '/static/vendors/jquery-highcharts/data.js',
                        '/static/vendors/jquery-highcharts/drilldown.js',
                        '/static/vendors/jquery-highcharts/exporting.js',
                    ],
                    '3D-lines-animation.bundle'       => [
                        '/static/vendors/3d-lines-animation/three.min.js',
                        '/static/vendors/3d-lines-animation/projector.min.js',
                        '/static/vendors/3d-lines-animation/canvas-renderer.min.js',
                        '/static/vendors/3d-lines-animation/3d-lines-animation.min.js',
                        '/static/vendors/3d-lines-animation/color.min.js',
                    ],
                    'Galaxy-canvas.bundle'            => [
                        '/static/vendors/canvas/galaxy.min.js',
                    ],
                    'bootstrap3-dialog.bundle'        => [
                        '/static/vendors/bootstrap3-dialog/js/bootstrap-dialog.min.js',
                        '/static/vendors/bootstrap3-dialog/css/bootstrap-dialog.min.css',
                    ],
                    'toastr.bundle'                   => [
                        '/static/vendors/jquery-toastr/toastr.min.css',
                        '/static/vendors/jquery-toastr/toastr.min.js',
                    ],
                    'select2.4.bundle'                => [
                        '/static/vendors/select2.4/css/select2.min.css',
                        '/static/vendors/select2.4/js/select2.full.min.js',
                        '/static/vendors/select2.4/js/i18n/zh-CN.js',
                    ],
                    'bootstrap-timepicker.bundle'     => [
                        '/static/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js',
                        '/static/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                    ],
                    'bootstrap-datetimepicker.bundle' => [
                        '/static/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                        '/static/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
                        '/static/vendors/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js',
                    ],
                    'multiselect.bundle'              => [
                        '/static/vendors/multi-select/css/multi-select.min.css',
                        '/static/vendors/multi-select/js/jquery.multi-select.js',
                    ],
                    'jsoneditor.bundle'               => [
                        '/static/vendors/josneditor/5.13.3/jsoneditor.min.css',
                        '/static/vendors/josneditor/5.13.3/jsoneditor.min.js',
                    ],
                    'vue-manage.bundle'               => [
                        '/static/vendors/bootstrap-daterangepicker/daterangepicker-bs3.css',
                        '/static/vendors/select2/select2-madmin.css',
                        '/static/vendors/bootstrap-select/bootstrap-select.min.css',
                        '/static/vendors/multi-select/css/multi-select.min.css',
                        '/static/vendors/select2/select2.min.js',
                        '/static/vendors/bootstrap-select/bootstrap-select.min.js',
                        '/static/vendors/multi-select/js/jquery.multi-select.js',
                        '/static/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js',
                        '/static/vendors/bootstrap-daterangepicker/daterangepicker.js',
                        '/static/vendors/lightbox-2.10/css/lightbox.css',
                        '/static/vendors/lightbox-2.10/js/lightbox.min.js',
                        '/static/vendors/jquery-toastr/toastr.min.css',
                        '/static/vendors/jquery-toastr/toastr.min.js',
                        '/static/js/vue' . (YII_ENV != 'dev' ? '.min' : '') . '.js',
                        '/static/app/public/manage.min.css',
                        '/static/app/public/manage.min.js',
                    ],
                    'modify.bundle'                   => [
                        '/static/vendors/bootstrap-select/bootstrap-select.min.css',
                        '/static/vendors/bootstrap-select/bootstrap-select.min.js',
                        '/static/vendors/josneditor/5.13.3/jsoneditor.min.css',
                        '/static/vendors/josneditor/5.13.3/jsoneditor.min.js',
                        '/static/app/public/modify.min.css',
                        '/static/app/public/modify.min.js',
                    ],
                    'ksplayer.bundle'                 => [
                        '/static/js/ksplayer/ksplayer.min.js',
                        '/static/js/ksplayer/ksplayer.min.css',
                        '/static/app/video/main' . (YII_ENV != 'dev' ? '.min' : '') . '.js',
                    ],
                    'chatwk.bundle'                   => [
                        '/static/vendors/chatwk/css/jquery-sinaEmotion-2.1.0.min.css',
                        '/static/vendors/chatwk/js/jquery.min.js',
                        '/static/vendors/chatwk/js/jquery-sinaEmotion-2.1.0.min.js',
                        '/static/vendors/chatwk/js/swfobject.js',
                        '/static/vendors/chatwk/js/web_socket.js',
                        '/static/app/chat/main' . (YII_ENV != 'dev' ? '.min' : '') . '.js',
                    ],
                    'beforeCommonAssets.bundle'       => [
                        'assets/before-style.css',
                    ],
                    'afterCommonAssets.bundle'        => [
                        'assets/after-style.css',
                    ],
                ];
                break;
            case 'jpg':
                $assets = [
                    'loading.jpg' => 'assets/images/loading.jpg',
                    'logo.jpg'    => 'assets/images/logo.jpg',
                ];
                break;
            default:
        }
        $files = isset($assets[$item]) ? $assets[$item] : false;
        if (is_string($files)) {
            $files = [$files];
        }
        return $files;
    }

    public static function iniAssets($file = '')
    {
        if (empty($file))
            return '';
        return $file . '?v=' . Yii::$app->params['view']['assetsVer'];
    }
}
