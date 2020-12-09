<?php

/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018/1/21
 * Time: 19:36
 */

function convert2ClassName($str, $ucfirst = true)
{
    $str = ucwords(str_replace('_', ' ', $str));
    $str = str_replace(' ', '', lcfirst($str));
    return $ucfirst ? ucfirst($str) : $str;
}

$model              = new stdClass();
$model->labels      = $labels;
$model->tableSchema = $tableSchema;
$model->primaryKey  = $tableSchema->primaryKey[0] ?? 'id';
$model->extendClass = $generator->parentModelClass;
$model->className   = convert2ClassName($tableName);
$model->tableName   = $generator->generateTableName($tableName);
$model->rules       = "[\n            " . implode(",\n            ", $rules) . ",\n        ]";



// 字段状态数组
$fieldStatus = [];

// 获取字段描述 && 生成字段状态数组
function getAttributeLabels($model, &$fieldStatus)
{
    $array = [];

    $columnNameMaxLen = 0;
    foreach ($model->labels as $name => $label) {
        if (strlen($name) > $columnNameMaxLen) {
            $columnNameMaxLen = strlen($name);
        }
    }
    $columnNameMaxLen += 2;

    foreach ($model->labels as $name => $label) {

        $comment    = (empty($model->tableSchema->getColumn($name)->comment) ? $name : $model->tableSchema->getColumn($name)->comment);
        $comments   = explode(':', $comment);
        $comment    = isset($comments[1]) ? $comments[0] : $comment;
        $commentAlt = isset($comments[1]) ? ", // " . $comments[1] : '';

        // 生成字段状态数组
        if (isset($comments[1])) {
            $comments[1] = trim($comments[1]);
            if (strpos($comments[1], "=>") !== false) { // 特别标注
                $items = explode('; ', $comments[1]); // 特别标注
                if (isset($items[0])) {
                    $items[0] = trim($items[0]);
                    foreach ($items as $item) {
                        $status = explode('=>', $item);
                        if (isset($status[1])) {
                            $status[1] = trim($status[1]);
                            $fieldStatus[$name][$status[0]] = $status[1];
                        }
                    }
                }
            }
        }

        $array[] = sprintf("%-{$columnNameMaxLen}s => '%s'%s", "'$name'", $comment, $commentAlt);
    }
    return "[\n            " . implode(",\n            ", $array) . ",\n        ]";
}

$model->attributeLabels = getAttributeLabels($model, $fieldStatus);


$tpl = file_get_contents(__DIR__ . "/tpl/model.tpl.php");
$tpl = str_replace("__EXTEND_CLASS__", ucwords($model->extendClass), $tpl);
$tpl = str_replace("__TABLE_NAME__", $model->tableName, $tpl);
$tpl = str_replace("__PRIMARY_KEY__", $model->primaryKey, $tpl);
$tpl = str_replace("__RULES__", $model->rules, $tpl);

$tpl = str_replace("__ATTRIBUTE_LABELS__", $model->attributeLabels, $tpl);

$fieldStatusString  = var_export($fieldStatus, true);
$fieldStatusStrings = explode(PHP_EOL, $fieldStatusString);
foreach ($fieldStatusStrings as $key => &$item) {
    $item = '            ' . $item . PHP_EOL;
}
$fieldStatusString = join('', $fieldStatusStrings);
$fieldStatusString = trim($fieldStatusString, PHP_EOL);
$fieldStatusString = trim($fieldStatusString, '            ');
$tpl               = str_replace("__FIELD_STATUS_DATA__", $fieldStatusString, $tpl);


/*生成管理表格字段配置*/
$makeManageTableHead = function ($labels, $tableSchema) {

    $columnNameMaxLen = 0;
    foreach ($labels as $name => $label) {
        if (strlen($name) > $columnNameMaxLen) {
            $columnNameMaxLen = strlen($name);
        }
    }
    $columnNameMaxLen += 2;

    $array = [];
    foreach ($labels as $name => $label) {
        $off = count($array) > 3 ? "// " : '';

        $comment  = (empty($tableSchema->getColumn($name)->comment) ? $name : $tableSchema->getColumn($name)->comment);
        $comments = explode(':', $comment);
        $comment  = isset($comments[1]) ? $comments[0] : $comment;
        $array[]  = sprintf("$off%-{$columnNameMaxLen}s => ['comment' => '%s']", "'$name'", $comment);
    }
    return "[\n            " . implode(",\n            ", $array) . ",\n        ]";
};
$tpl                 = str_replace("__MANAGE_TABLE_HEAD__", $makeManageTableHead($labels, $tableSchema), $tpl);

/*生成表单字段配置*/
$makeFormFields = function ($labels, $tableSchema, $primaryKey, $fieldStatus) {

    $columnNameMaxLen = 0;
    foreach ($labels as $name => $label) {
        if (strlen($name) > $columnNameMaxLen) {
            $columnNameMaxLen = strlen($name);
        }
    }
    $columnNameMaxLen += 2;

    $array = [];
    foreach ($labels as $name => $label) {
        // 过滤字段
        if ($name == $primaryKey) continue;
        if ($name == 'created_at') continue;
        if ($name == 'updated_at') continue;

        $comment    = (empty($tableSchema->getColumn($name)->comment) ? $name : $tableSchema->getColumn($name)->comment);
        $comments   = explode(':', $comment);
        $commentAlt = isset($comments[1]) ? ", // " . $comments[1] : '';

        // radio 类型判断
        $inputType = 'text';
        if (isset($fieldStatus[$name])) {
            $inputType       = 'radio';
            $dataGetFunction = '$this->getFieldStatusData("' . $name . '")';
            //$array[]         = "'{$name}' => ['type' => '{$inputType}', 'data' =>{$dataGetFunction} ]";
            $array[] = sprintf("%-{$columnNameMaxLen}s => ['type' => '%s', 'data' => %s]", "'$name'", $inputType, $dataGetFunction);

        } else {
            // $array[] = "'{$name}' => ['type' => '{$inputType}']$commentAlt";
            $array[] = sprintf("%-{$columnNameMaxLen}s => ['type' => '%s']%s", "'$name'", $inputType, $commentAlt);
        }
    }
    return "[\n            " . implode(",\n            ", $array) . ",\n        ]";
};
$tpl            = str_replace("__FORM_FIELDS__", $makeFormFields($labels, $tableSchema, $model->primaryKey, $fieldStatus), $tpl);

// 检测是否需要继承上级对象
$extendClassName = ucwords($model->extendClass);
$className       = ucwords($model->className);
$useParentClass  = '';
if (class_exists("app\\models\\$extendClassName", true)) {
    $useParentClass = 'use app\models\\' . $extendClassName . ' as OriginalModel;';
    $className      = $className . ' extends OriginalModel';
} else {
    $className = $className . ' extends \yii\db\ActiveRecord';
}
$tpl = str_replace("use __USE_PARENT_CLASS__;", $useParentClass, $tpl);
$tpl = str_replace("__CLASS_NAME__", $className, $tpl);

// 表字段=>类属性标注
function makeModelPropertyList($tableSchema)
{

    $phpTypeMaxLen = 0;
    foreach ($tableSchema->columns as $column) {
        if (strlen($column->phpType) > $phpTypeMaxLen) {
            $phpTypeMaxLen = strlen($column->phpType);
        }
    }

    $str = '';
    foreach ($tableSchema->columns as $column) {
        $str .= sprintf(" * @property %-{$phpTypeMaxLen}s %s" . PHP_EOL, $column->phpType, $column->name);
    }
    return trim($str, PHP_EOL);
}

$propertyList = makeModelPropertyList($tableSchema);
$tpl          = str_replace("__PROPERTY_LIST__", $propertyList, $tpl);


// 数据库选择
$tpl = str_replace("__DB__", $generator->db, $tpl);

// 格式化
// TODO printf("%-6s %-10s %-16s %-8s %-8s %-6s %-16s %-13s %-15s\n", $key, $alias, $host, $port, $user, "***", $name, $create_time, $description);
echo $tpl;