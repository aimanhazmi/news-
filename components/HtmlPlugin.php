<?php
/**
 * Created by PhpStorm.
 * User: CLZ
 * Date: 2018/1/25
 * Time: 下午1:22
 */

namespace app\components;

use yii\helpers\Html;

class HtmlPlugin
{

    /**
     * 下拉框select
     * Created by CLZ
     * @param $config ['name']
     * @param $config ['field']
     * @param $config ['default']
     * @param $config ['listData']
     * @return string
     *
     */
    public static function select($config)
    {
        $labelName = empty($config['name']) ? '' : trim($config['name']);
        $field = $config['field'];
        $defaultValue = isset($config['default']) ? $config['default'] : '';
        $listData = isset($config['listData']) ? $config['listData'] : ['' => (empty($config['allData']) ? '请选择' : $config['allData'])];
        $labelClass = $config['labelClass'] ?? 'col-md-3 control-label';
        $html = '';
        $html .= empty($labelName) ? '' : Html::beginTag('div', ['class' => 'form-group']);
        $html .= empty($labelName) ? '' : Html::tag('label', '<b>' . $labelName . '</b>', ['class' => $labelClass, 'for' => $field]);
        $html .= Html::beginTag('div', ['class' => 'col-md-9','style'=>'width:150px']);
        $html .= Html::dropDownList($field, $defaultValue, $listData, ['class' => 'selectpicker form-control show-tick', 'data-style' => "btn-white", 'id' => $field, 'prompt' => (empty($config['allData']) ? '请选择' : $config['allData'])]);
        $html .= Html::endTag('div');
        $html .= empty($labelName) ? '' : Html::endTag('div');
        return html_entity_decode($html);
    }

    public static function searchSelect($config)
    {
        $labelName = empty($config['name']) ? '' : trim($config['name']);
        $field = $config['field'];
        $defaultValue = isset($config['default']) ? $config['default'] : '';
        $listData = isset($config['listData']) ? $config['listData'] : ['' => (empty($config['allData']) ? '全部' : $config['allData'])];
        $html = '';
        $html .=  empty($labelName) ? '' : Html::beginTag('div', ['class' => 'form-group']);
        $html .= empty($labelName) ? '' : Html::tag('label', '<b>' . $labelName . '</b>', ['class' => 'col-md-3 control-label', 'for' => $field]);
        $html .= Html::beginTag('div', ['class' => 'btn-group bootstrap-select form-control']);
        $html .= Html::dropDownList($field, $defaultValue, $listData, ['class' => 'selectpicker form-control show-tick', 'data-style' => "btn-white", 'id' => $field, 'prompt' => (empty($config['allData']) ? '请选择' : $config['allData'])]);
        $html .= Html::endTag('div');
        $html .=  empty($labelName) ? '' :  Html::endTag('div');
        return html_entity_decode($html);
    }

    public static function multipleSelect($config){
        $labelName = empty($config['name']) ? '' : trim($config['name']);
        $field = $config['field'];
        $defaultValue = isset($config['default']) ? $config['default'] : '';
        $listData = isset($config['listData']) ? $config['listData'] : ['' => (empty($config['allData']) ? '全部' : $config['allData'])];
        $html = '';
        $html .=  empty($labelName) ? '' : Html::beginTag('div', ['class' => 'form-group']);
        $html .= empty($labelName) ? '' : Html::tag('label', '<b>' . $labelName . '</b>', ['class' => 'col-md-3 control-label', 'for' => $field]);
        $html .= Html::beginTag('div', ['class' => 'btn-group bootstrap-select form-control']);
        $html .= Html::dropDownList($field, $defaultValue, $listData, ['multiple'=>'multiple', 'class' => 'selectpicker form-control show-tick', 'data-style' => "btn-white", 'id' => $field, 'prompt' => (empty($config['allData']) ? '请选择' : $config['allData'])]);
        $html .= Html::endTag('div');
        $html .=  empty($labelName) ? '' :  Html::endTag('div');
        return html_entity_decode($html);
    }
}