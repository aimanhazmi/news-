<?php
/**
 * Created by aiman
 * Author: aiman
 * Date: 2025/8/28
 * Time: 15:25
 */

namespace app\assets;


use yii\web\AssetBundle;

class FormAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '/static/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
        '/static/vendors/jquery-file-upload/css/jquery.fileupload.css',
        '/static/vendors/lightbox/css/lightbox.css',
    ];
    public $js = [
        '/static/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
        '/static/vendors/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js',
        '/static/vendors/jquery-file-upload/js/jquery.fileupload.js',
        '/static/vendors/jquery-file-upload/js/jquery.iframe-transport.js',
        '/static/vendors/lightbox/js/lightbox.min.js',
    ];
}