<?php

namespace app\controllers;

use app\common\components\BaseWebController;
use app\common\services\applog\AppLogService;
use Yii;

use yii\log\FileTarget;



class ErrorController extends BaseWebController
{
    public function actionError(){
        //记录错误信息到文件和数据库中
        //实例化全局的yii类，调用某个方法找到错误
        $error=\Yii::$app->errorHandler->exception;

        $err_msg='';
        //判断是否有错误,如果有错误记录错误信息到文件和数据库中
        if($error){
            //一般记录那个文件错了，或者这个文件的第几行，错误信息是什么，以及错误码
            $file=$error->getFile();
            $line=$error->getLine();
            $message=$error->getMessage();
            $code=$error->getCode();
            //将这些信息写入到runtime/logs目录当中,使用FileTarget类
            $log=new FileTarget();
            $log->logFile=Yii::$app->getRuntimePath()."/logs/err.log";

            //将错误信息保存到一个变量当中
            $err_msg=$message."[file:{$file}][line:{$line}][code:{$code}][url:{$_SERVER
            ['REQUEST_URL']}][POST_DATA:".http_build_query($_POST)."]";

            $log->messages[]=[
                $err_msg,
                1,
                'application',
                microtime(true)
            ];
            //写入到文件当中
            $log->export();
            //toDo 写入到数据库

            ApplogService::addErrorLog(Yii::$app->id,$err_msg);
        }
        //$this->layout=false;
        return $this->render('error',['err_msg'=>$err_msg]);
        //return '错误页面:'.$err_msg;
    }

}
