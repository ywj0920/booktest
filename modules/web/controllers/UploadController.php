<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/29 0029
 * Time: 下午 12:30
 */

namespace app\modules\web\controllers;


use app\common\services\UploadService;
use app\modules\web\controllers\common\BaseController;


class UploadController extends BaseController{

    private $allow_file_type = ['jpg','jpeg','gif','png'];

    public  function actionPic(){
        $bucket = trim( $this->post( "bucket","" ));
        $callback = "window.parent.upload";
        if( !$_FILES || !isset($_FILES['pic'])){
            return "<script>{$callback}.error('请选择文件之后在提交~~')</script>";
        }

        $file_name = $_FILES['pic']['name'];
        $tmp_file_extend = explode(".", $file_name);
        if(!in_array( strtolower( end( $tmp_file_extend ) ),$this->allow_file_type) ){
            return "<script type='text/javascript'>{$callback}.error('请上传图片文件,jpg,png,jpeg,gif');</script>";
        }

        //上传图片业务逻辑
      $ret = UploadService::uploadByFile( $file_name,$_FILES['pic']['tmp_name'],$bucket);
      // UploadService::uploadByFile();
        //return "<script>{$callback}.error('提交~~')</script>";

        if(!$ret){
            return "<script>{$callback}.error('".UploadService::getLastErrorMsg()."')</script>";
        }
       return "<script>{$callback}.success('{$ret['path']}')</script>";


    }
}