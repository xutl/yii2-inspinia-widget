<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace xutl\inspinia;


use xutl\plupload\Plupload;
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use xutl\bootstrap\filestyle\FilestyleAsset;

/**
 * Class ActiveField
 * @package xutl\inspinia
 */
class ActiveField extends \yii\bootstrap\ActiveField
{

    public $options = [
        'class' => 'form-group'
    ];

    public function imgInput($options = [])
    {
        $this->template = "{label}\n<div class=\"image\">{input}{img}\n{error}</div>\n{hint}";
        $value = Html::getAttributeValue($this->model, $this->attribute);
        if ($value) {
            $src = Yii::$app->getModule('attachment')->getUrl($value);
        } else {
            $src = Yii::$app->getModule('attachment')->getUrl('/images/none.jpg');
        }
        $this->parts['{img}'] = Html::img($src, $options);
        FilestyleAsset::register($this->form->view);
        return parent::fileInput($options);
    }

    public function ajaxUploadInput($options = [])
    {
        $this->template = "{label}\n<div class=\"image\">{input}{img}\n{error}</div>\n{hint}";
        $value = Html::getAttributeValue($this->model, $this->attribute);
        if ($value) {
            $src = Yii::$app->getModule('attachment')->getUrl($value);
        } else {
            $src = Yii::$app->getModule('attachment')->getUrl('/images/none.jpg');
        }
        $this->parts['{img}'] = Html::img($src, $options);
        FilestyleAsset::register($this->form->view);
        return parent::fileInput($options).Plupload::widget(['url'=>'url']);
    }

    /**
     * 显示文件上传窗口
     * @param array $options
     * @return $this
     */
    public function fileInput($options = [])
    {
        $options = array_merge([
            'class' => 'filestyle',
            'data' => [
                'buttonText' => Yii::t('app', 'Choose file'),
                //'size' => 'lg'
            ]
        ], $options);
        FilestyleAsset::register($this->form->view);
        return parent::fileInput($options);
    }

    /**
     * 显示下拉
     * @param array $items
     * @param array $options
     * @param bool $generateDefault
     * @return $this
     */
    public function dropDownList($items, $options = [], $generateDefault = true)
    {
        if ($generateDefault === true && !isset($options['prompt'])) {
            $options['prompt'] = yii::t('app', 'Please select');
        }
        return parent::dropDownList($items, $options);
    }

    /**
     * @param array $options
     * @return $this he field object itself.
     */
    public function textarea($options = [])
    {
        if (!isset($options['rows'])) {
            $options['rows'] = 5;
        }
        return parent::textarea($options);
    }
}