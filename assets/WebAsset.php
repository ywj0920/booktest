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
class WebAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public function registerAssetFiles($view){
        $release_version = defined("RELEASE_VERSION")?RELEASE_VERSION:time();
        $this->css= [
            'css/web/bootstrap.min.css',
            'font-awesome/css/font-awesome.css',
            'css/web/style.css?ver='.RELEASE_VERSION,
        ];

        $this->js= [
            'plugins/jquery-2.1.1.js',
            'plugins/layer/layer.js',
            'js/web/bootstrap.min.js',
            'js/web/common.js?ver='.RELEASE_VERSION,
        ];
        parent::registerAssetFiles( $view );
    }
}
