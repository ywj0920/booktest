<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19 0019
 * Time: 下午 8:18
 */

namespace app\common\services;

//只用于加载本身的资源文件
class StaticService {

    public static  function  includeAppJsStatic($path,$depend){
        self::includeAppStatic('js',$path,$depend);
    }

    public static  function  includeAppCssStatic($path,$depend){
        self::includeAppStatic('css',$path,$depend);
    }

    public static  function  includeAppStatic($type,$path,$depend){
        $release_version = defined("RELEASE_VERSION")?RELEASE_VERSION:time();
        $path = $path ."?ver=".$release_version;
        if($type=='css'){
            \Yii::$app->getView()->registerCssFile( $path,['depends'=>$depend]);
        }else{
            \Yii::$app->getView()->registerJsFile($path,['depends'=>$depend]);
        }
    }
}