<?php
/**
 * Created by aiman
 * User: aiman
 * Date: 2025/1/10
 * Time: 22:52
 */

namespace app\components;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

class ModelForm
{
    private       $model;
    private       $form;
    public static $instance;

    public static function getInstance()
    {
        if (!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    public function __construct()
    {
        $this->form = ActiveForm::begin([
            'action'                 => '#',
            'method'                 => "post",
            'id'                     => 'dataForm',
            'enableClientScript'     => false,
            'enableClientValidation' => true,
            'options'                => ['class' => 'form-horizontal form-bordered'],
            'fieldConfig'            => [
                'template'     => '
            {label}
	            <div class="col-md-6">
	                {input}
	                {hint}
	            </div>',
                'labelOptions' => ['class' => 'col-md-3 control-label'],
            ],
        ]);
    }

    public static function display(\yii\db\ActiveRecord $model, array $fieldsConfigs = [])
    {
        if (empty($fieldsConfigs)) return '';
        $type             = $model->isNewRecord ? "create" : "update";
        $modelForm        = self::getInstance();
        $modelForm->model = $model;
        $modelForm->model->loadDefaultValues();
        $formFields = [];
        foreach ($fieldsConfigs as $field => $config) {
            if (isset($config['type'])) {
                if (isset($config["available"])) {
                    $field = str_replace('_available', '', $field);
                    if (!in_array($type, $config["available"])) continue;
                }
                $function = ucwords(str_replace('-', ' ', $config['type']));
                $function = str_replace(' ', '', lcfirst($function));

                if (is_callable([$modelForm, $function])) {
                    $formFields[] = $modelForm->{$function}($field, $config);
                }
            }
        }
        array_push($formFields, $modelForm->primaryKey());
        if (empty($formFields)) {
            echo implode('', $formFields);
        }
        $modelForm->endForm();
    }

    public function text($field, $config = [])
    {
        $options = ['maxlength' => true, 'placeholder' => '请输入'];
        if (is_array($config)) {
            $options = array_merge($options, $config);
        }
        $input = $this->form->field($this->model, $field)->textInput($options);
        if (isset($config['label'])) {
            $input->label($config['label']);
        }
        echo $this->setHint($input, $config);
    }

    public function password($field, $config = [])
    {
        $options = ['maxlength' => true, 'placeholder' => '请输入'];
        if (is_array($config)) {
            $options = array_merge($options, $config);
        }
        $input = $this->form->field($this->model, $field)->passwordInput($options);
        if (isset($config['label'])) {
            $input->label($config['label']);
        }
        echo $this->setHint($input, $config);
    }

    public function hidden($field, $config = [])
    {
        echo $this->form->field($this->model, $field, [
            'template' => '{input}',
        ])->hiddenInput();
    }

    public function json($field, $config = [])
    {
        if (empty($this->model->{$field})) {
            $this->model->{$field} = "{}";
        }
        $style = '';
        if (isset($config['rows'])) {
            $rows  = $config['rows'] + 14;
            $style = "style='height:" . $rows . "em;'";
        }
        $options['class'] = 'json-editor';
        if (is_array($config)) {
            $options = array_merge($options, $config);
        }
        $dataInput = $this->form->field($this->model, $field, [
            'template' => '{input}',
        ])->hiddenInput();
        $input     = $this->form->field($this->model, $field, [
            'template'     => '
					{label}
					<div class="col-md-8">
						<div class="' . $options['class'] . '" ' . $style . '></div>
					    ' . $dataInput . '
					</div>',
            'labelOptions' => ['class' => 'col-md-3 control-label'],
        ])->textInput();
        if (isset($config['label'])) {
            $input->label($config['label']);
        }
        echo $this->setHint($input, $config);
    }

    public function textarea($field, $config = [])
    {
        $options = ['rows' => 3, 'placeholder' => '请输入'];
        if (is_array($config)) {
            $options = array_merge($options, $config);
        }
        $input = $this->form->field($this->model, $field)->textarea($options);
        if (isset($config['label'])) {
            $input->label($config['label']);
        }
        echo $this->setHint($input, $config);
        //->helpinfo('请输入您常用的标签')
    }

    public function radio($field, $config = [])
    {
        $items = $config['data'] ?? [];
        if (!empty($items)) {
            unset($config['data']);
        }
        $input = $this->form->field($this->model, $field)->radioList($items, $config);
        if (isset($config['label'])) {
            $input->label($config['label']);
        }
        echo $this->setHint($input, $config);
    }

    public function liveSearch($field, $config = [])
    {
        $config['data-live-search'] = 'true';
        $this->select($field, $config);
    }

    public function multipleSelect($field, $config = [])
    {
        $config['multiple'] = 'multiple';
        $this->select($field, $config);
    }

    public function select($field, $config = [])
    {
        $defaultConfig['class']      = 'selectpicker form-control';
        $defaultConfig['data-style'] = 'btn-white';
        if (is_array($config)) {
            $config = array_merge($defaultConfig, $config);
        }
        $input = $this->form->field($this->model, $field)->dropDownList($config['data'], $config);
        if (isset($config['label'])) {
            $input->label($config['label']);
        }
        $input = $this->setHint($input, $config);
        echo html_entity_decode($input);
    }

    public function fieldDatetime($field, $config = [])
    {
        $fieldValue = $config['value'] ?? $this->model->{$field};
        if (is_int($fieldValue)) {
            $fieldValue = date('Y-m-d H:i:s', $fieldValue);
        } else {
            $fieldValue = strtotime($fieldValue) ? strtotime($fieldValue) : false;
            !empty($fieldValue) && $fieldValue = date('Y-m-d H:i:s', $fieldValue);
        }
        $input = $this->form->field($this->model, $field, [
            'template'     => '
					{label}
					<div class="col-md-6">
						<div class="input-icon right">
							<i class="fa fa-calendar"></i>
							{input}
						</div>
					</div>
					<span class="help-block">{error}</span>',
            'labelOptions' => ['class' => 'col-md-3 control-label'],
        ])->textInput([
            'readonly'    => $config['readonly'] ?? true,
            'class'       => $config['class'] ?? 'form-control field-datetime date', // 这里很必要
            'placeholder' => $config['placeholder'] ?? '请选择时间',
            'value'       => $fieldValue,
        ]);
        if (isset($config['label'])) {
            $input->label($config['label']);
        }
        echo $input;
    }

    public function primaryKey()
    {
        echo !$this->model->isNewRecord ? $this->form->field($this->model, $this->model::PRIMARY_KEY, [
            'template' => '{input}',
        ])->hiddenInput() : '';
    }

    public function video($field, $config = [])
    {
        $readonly     = isset($config['readonly']) ? true : false;
        $uploadBtnCss = $readonly ? 'hide' : '';
        $btnClass     = empty($this->model->{$field}) ? 'hide' : '';
        $modelName    = explode('\\', get_class($this->model));
        $modelName    = strtolower(end($modelName));
        $field        = $this->form->field($this->model, $field, [
            'template'     => '
					{label}
					<div class="col-sm-9 controls">
						<span class="btn btn-success fileinput-button ' . $uploadBtnCss . '">
					        <i class="glyphicon glyphicon-upload"></i>
					        <span>上传</span>
					        <input type="file" name="' . $field . '" class="file-upload-btn" accept="video/mp4,video/mpeg">
					        {input}
					    </span>
					    <a class="btn btn-info ' . $btnClass . '" id="' . $modelName . '-' . $field . '-show" href="' . $this->model->{$field} . '" target="_blank" data-show="true"><i class="fa fa-eye"></i> 查看</a>
					    <a class="btn btn-primary delfile-btn ' . $btnClass . '" data-id="' . $modelName . '-' . $field . '" href="javascript:void(0);"><i class="fa fa-trash-o"></i> 删除</a>
					    {hint}
					</div>
        		',
            'labelOptions' => ['class' => 'col-md-3 control-label'],
        ])->hiddenInput();
        $field        = $this->setHint($field, $config);
        echo $field;
    }

    public function fileImage($field, $config = [])
    {
        $readonly     = isset($config['readonly']) ? true : false;
        $uploadBtnCss = $readonly ? 'hide' : '';
        $btnClass     = empty($this->model->{$field}) ? 'hide' : '';
        $modelName    = explode('\\', get_class($this->model));
        $modelName    = strtolower(end($modelName));
        $field        = $this->form->field($this->model, $field, [
            'template'     => '
					{label}
					<div class="col-sm-9 controls">
						<span class="btn btn-success fileinput-button ' . $uploadBtnCss . '">
					        <i class="glyphicon glyphicon-upload"></i>
					        <span>上传</span>
					        <input type="file" name="' . $field . '" class="images-upload-btn" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg">
					        {input}
					    </span>
					    <a class="btn btn-info ' . $btnClass . '" id="' . $modelName . '-' . $field . '-show" href="' . $this->model->{$field} . '" data-lightbox="roadtrip"><i class="fa fa-eye"></i> 查看</a>
					    <a class="btn btn-primary delfile-btn ' . $btnClass . '" data-id="' . $modelName . '-' . $field . '" href="javascript:void(0);"><i class="fa fa-trash-o"></i> 删除</a>
					    {hint}
					</div>
        		',
            'labelOptions' => ['class' => 'col-md-3 control-label'],
        ])->hiddenInput();
        $field        = $this->setHint($field, $config);
        echo $field;
    }

    public function endForm()
    {
        $plusIcon   = '<i class="glyphicon glyphicon-plus man"></i>';
        $editIcon   = '<i class="fa fa-edit fa-fw"></i>';
        $resetIcon  = '<i class="glyphicon glyphicon-repeat"></i>';
        $gobackIcon = '<i class="fa fa-reply"></i>';

        echo '<div class="form-actions text-center pal">';
        echo Html::submitButton($this->model->isNewRecord ? $plusIcon . ' 创建' : $editIcon . ' 更新', ['class' => $this->model->isNewRecord ? 'btn btn-success' : 'btn btn-info']);
        echo Html::resetButton($resetIcon . ' 重置', ['class' => 'btn btn-primary resetForm', 'name' => 'reset-button']);
        echo Html::button($gobackIcon . ' 返回', ['class' => 'btn btn-info goBack', 'name' => 'goback-button']);
        echo '</div>';
        ActiveForm::end();
    }

    private function setHint($field, $config)
    {
        if (isset($config['help'])) {
            $field->hint($config['help'], [
                'tag'   => 'span',
                'class' => 'help-block',
            ]);
        }
        return $field;
    }
}