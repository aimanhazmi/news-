<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\gii\generators\service;

use Yii;
use yii\gii\CodeFile;

/**
 * This generator will generate the skeleton files needed by an extension.
 *
 * @property string $keywordsArrayJson A json encoded array with the given keywords. This property is
 * read-only.
 * @property boolean $outputPath The directory that contains the module class. This property is read-only.
 *
 * @author Tobias Munk <schmunk@usrbin.de>
 * @since 2.0
 */
class Generator extends \yii\gii\Generator
{
    public $vendorName;
    public $packageName = "yii2-";
    public $namespace;
    public $type = "yii2-extension";
    public $keywords = "yii2,extension";
    public $title;
    public $description;
    public $outputPath = "@app/mechanise/service";
    public $license;
    public $authorName;
    public $authorEmail;

    public $selfModel;
    public $originalService;
    public $name;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return '直播平台Service模版';
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return '生成直播平台service模版';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [[ 'name', 'selfModel', 'originalService','outputPath'], 'filter', 'filter' => 'trim']
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vendorName'  => 'Vendor Name',
            'packageName' => 'Package Name',
            'license'     => 'License',
        ];
    }

    /**
     * @inheritdoc
     */
    public function hints()
    {
        return [
            'vendorName'  => 'This refers to the name of the publisher, your GitHub user name is usually a good choice, eg. <code>myself</code>.',
            'packageName' => 'This is the name of the extension on packagist, eg. <code>yii2-foobar</code>.',
            'namespace'   => 'PSR-4, eg. <code>myself\foobar\</code> This will be added to your autoloading by composer. Do not use yii, yii2 or yiisoft in the namespace.',
            'keywords'    => 'Comma separated keywords for this extension.',
            'outputPath'  => 'The temporary location of the generated files.',
            'title'       => 'A more descriptive name of your application for the README file.',
            'description' => 'A sentence or subline describing the main purpose of the extension.',
        ];
    }

    /**
     * @inheritdoc
     */
    public function stickyAttributes()
    {
        return ['vendorName', 'outputPath', 'authorName', 'authorEmail'];
    }

    /**
     * @inheritdoc
     */
    public function successMessage()
    {


        return "";
    }

    /**
     * @inheritdoc
     */
    public function requiredTemplates()
    {
        return ["service.php"];
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $files = [];
        $modulePath = $this->getOutputPath();
        $files[] = new CodeFile(
            $modulePath . '/'.$this->name.'Service.php',
            $this->render("service.php")
        );
//        $files[] = new CodeFile(
//            $modulePath . '/' . $this->packageName . '/composer.json',
//            $this->render("composer.json")
//        );
//        $files[] = new CodeFile(
//            $modulePath . '/' . $this->packageName . '/AutoloadExample.php',
//            $this->render("AutoloadExample.php")
//        );
//        $files[] = new CodeFile(
//            $modulePath . '/' . $this->packageName . '/README.md',
//            $this->render("README.md")
//        );

        return $files;
    }

    /**
     * @return boolean the directory that contains the module class
     */
    public function getOutputPath()
    {
        return Yii::getAlias($this->outputPath);
    }

    /**
     * @return string a json encoded array with the given keywords
     */
    public function getKeywordsArrayJson()
    {
        return json_encode(explode(',', $this->keywords), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array options for type drop-down
     */
    public function optsType()
    {
        $licenses = [
            'yii2-extension',
            'library',
        ];

        return array_combine($licenses, $licenses);
    }

    /**
     * @return array options for license drop-down
     */
    public function optsLicense()
    {
        $licenses = [
            'Apache-2.0',
            'BSD-2-Clause',
            'BSD-3-Clause',
            'BSD-4-Clause',
            'GPL-2.0',
            'GPL-2.0+',
            'GPL-3.0',
            'GPL-3.0+',
            'LGPL-2.1',
            'LGPL-2.1+',
            'LGPL-3.0',
            'LGPL-3.0+',
            'MIT'
        ];

        return array_combine($licenses, $licenses);
    }
}
