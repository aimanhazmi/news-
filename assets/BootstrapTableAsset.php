<?php
/**
 * Created by lonisy@163.com
 * Author: lilei
 * Date: 2017/8/24
 * Time: 21:48
 */

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapTableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/vendors/bootstrap-table/bootstrap-table.min.css',
    ];
    public $js = [
        'static/vendors/bootstrap-table/bootstrap-table.min.js',
        'static/vendors/bootstrap-table/locale/bootstrap-table-zh-CN.min.js',
        'static/js/bootstrap-table-addition.src.min.js',
    ];

    /**
     * @param $view
     * @param $jsfile
     */
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, ['type'=>'text/javascript', 'depends' => 'app\assets\BootstrapTableAsset']);
    }

    /**
     * @param $view
     * @param $cssfile
     */
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, ['type'=>'text/css','rel'=>'stylesheet', 'depends' => 'app\assets\BootstrapTableAsset']);
    }
}