<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/1/3
 * Time: 11:50
 */

namespace app\components;

use yii\helpers\Html;

class SearchPlugin
{
    /**
     * Created by lonisy@163.com
     * @param array $configs
     * @return string
     */
    public static function init(array $configs = [])
    {
        if (empty($configs)) return '';
        $formGroups = [];
        $beginTag   = Html::beginTag('div', ['class' => 'col-md-6']);
        $endTag     = Html::endTag('div');
        foreach ($configs as $config) {
            if (isset($config['type'])) {
                $function = ucwords(str_replace('-', ' ', $config['type']));
                $function = str_replace(' ', '', lcfirst($function));
                if (is_callable(array("app\\components\\SearchPlugin", $function))) {
                    $result = self::$function($config);
                    if (!empty($result)) {
                        $formGroups[] = $beginTag . $result . $endTag;
                    }
                }
            }
        }
        $formGroupsNum = count($formGroups);
        foreach ($formGroups as $key => &$formGroup) {
            if (($key + 1) % 2 == 0 && ($key + 1) != $formGroupsNum) {
                $formGroup = $formGroup . $endTag . Html::beginTag('div', ['class' => 'row']);
            }
        }
        return Html::beginTag('div', ['class' => 'row']) . implode('', $formGroups) . $endTag;
    }

    /**
     * Created by lonisy@163.com
     * 日期范围控件 dom
     * @param array $config
     * @return string
     */
    public static function dateRange(array $config = [])
    {
        $field      = isset($config['field']) ? $config['field'] : 'date_range';
        $start_date = isset($config['default']['start_date']) ? $config['default']['start_date'] : '';
        $end_date   = isset($config['default']['end_date']) ? $config['default']['end_date'] : '';
        $html       = '';
        $html       .= Html::beginTag('div', ['class' => 'form-group']);
        $html       .= Html::beginTag('label', ['class' => 'control-label', 'for' => 'dataRange']);
        $html       .= (isset($config['name']) ? $config['name'] : '日期范围');
        $html       .= Html::tag('span', ' *', ['class' => 'require']);
        $html       .= Html::endTag('label');
        $html       .= Html::beginTag('div', ['class' => 'input-group']);
        $html       .= Html::beginTag('div', ['class' => 'input-group-addon']);
        $html       .= Html::tag('i', '', ['class' => 'fa fa-calendar']);
        $html       .= Html::endTag('div');
        $html       .= Html::input('text', 'daterangepicker-default', '', ['class' => 'form-control', 'placeholder' => '请选择']);
        $html       .= Html::input('hidden', $field . "[start_date]", $start_date, ['class' => 'start_date']);
        $html       .= Html::input('hidden', $field . "[end_date]", $end_date, ['class' => 'end_date']);
        $html       .= Html::endTag('div');
        $html       .= Html::endTag('div');
        return $html;
    }

    /**
     * Created by lonisy@163.com
     * 单一字段控件 dom
     * @param array $config
     * @return bool|string
     */
    public static function field(array $config = [])
    {
        if (!isset($config['field'])) return false;
        $fieldName = (isset($config['name']) ? $config['name'] : $config['field']);
        $field     = $config['field'];
        $html      = '';
        $html      .= Html::beginTag('div', ['class' => 'form-group']);
        $html      .= Html::tag('label', $fieldName, ['class' => 'control-label', 'for' => $field]);
        $html      .= Html::input('text', $field, '', ['class' => 'form-control', 'id' => $field, 'placeholder' => '请输入']);
        $html      .= Html::endTag('div');
        return $html;
    }

    /**
     * Created by lonisy@163.com
     * 普通单选列表
     * @param array $config
     * @return bool|string
     */
    public static function select(array $config = [])
    {
        if (!isset($config['field'])) return false;
        $fieldName    = (isset($config['name']) ? $config['name'] : $config['field']);
        $field        = $config['field'];
        $defaultValue = isset($config['default']) ? $config['default'] : '';
        $listData     = isset($config['listData']) ? $config['listData'] : ['' => '请选择'];

        $html = '';
        $html .= Html::beginTag('div', ['class' => 'form-group']);
        $html .= Html::tag('label', $fieldName, ['class' => 'control-label', 'for' => $field]);
        $html .= Html::dropDownList($field, $defaultValue, $listData, ['class' => 'selectpicker form-control show-tick', 'data-style' => "btn-white", 'id' => $field, 'prompt' => '请选择']);
        $html .= Html::endTag('div');
        return html_entity_decode($html);
    }

    /**
     * Created by lonisy@163.com
     * 多选表单
     * @param array $config
     * @return bool|string
     */
    public static function multipleSelect(array $config = [])
    {
        if (!isset($config['field'])) return false;
        $fieldName    = (isset($config['name']) ? $config['name'] : $config['field']);
        $field        = $config['field'];
        $defaultValue = isset($config['default']) ? $config['default'] : '';
        $listData     = isset($config['listData']) ? $config['listData'] : ['' => '请选择'];

        $html = '';
        $html .= Html::beginTag('div', ['class' => 'form-group']);
        $html .= Html::tag('label', $fieldName, ['class' => 'control-label', 'for' => $field]);
        $html .= Html::dropDownList($field, $defaultValue, $listData, ['class' => 'selectpicker form-control', 'data-style' => "btn-white", 'multiple' => "multiple", 'id' => $field, 'data-selected-text-format' => "count", 'prompt' => '请选择']);
        $html .= Html::endTag('div');
        return $html;
    }

    /**
     * Created by lonisy@163.com
     * 可搜索表单 需要实体数据 非异步
     * @param array $config
     * @return bool|string
     */
    public static function searchSelect(array $config = [])
    {
        if (!isset($config['field'])) return false;
        $fieldName          = (isset($config['name']) ? $config['name'] : $config['field']);
        $field              = $config['field'];
        $defaultValue       = isset($config['default']) ? $config['default'] : '';
        $listData           = isset($config['listData']) ? $config['listData'] : ['' => '请选择'];
        $dropDownListconfig = ['class' => 'selectpicker form-control', 'data-style' => "btn-white", 'data-live-search' => "true", 'id' => $field, 'prompt' => '请选择'];
        if (isset($config['attributes']) && is_array($config['attributes'])) {
            $dropDownListconfig = array_merge($dropDownListconfig, $config['attributes']);
        }
        $html = '';
        $html .= Html::beginTag('div', ['class' => 'form-group']);
        $html .= Html::tag('label', $fieldName, ['class' => 'control-label', 'for' => $field]);
        $html .= Html::dropDownList($field, $defaultValue, $listData, $dropDownListconfig);
        $html .= Html::endTag('div');
        return html_entity_decode($html);
    }
}