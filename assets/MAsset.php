<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public function registerAssetFiles($view){
        $release_version = defined("RELEASE_VERSION")?RELEASE_VERSION:time();
        $this->css= [
            'font-awesome/css/font-awesome.css',
            'css/m/css_style.css',
            'css/m/app.css?ver='.RELEASE_VERSION,
        ];

        $this->js= [
            'plugins/jquery-2.1.1.js',
            'js/m/TouchSlide.1.1.js',
            'js/m/common.js?ver='.RELEASE_VERSION,
        ];
        parent::registerAssetFiles( $view );
    }
}
