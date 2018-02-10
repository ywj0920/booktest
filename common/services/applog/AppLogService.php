<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/18 0018
 * Time: 下午 8:21
 */
namespace app\common\services\applog;


use app\common\services\UtilService;
use app\models\log\AppAccessLog;
use app\models\log\AppLog;

class AppLogService
{
    /**
     * 记录错误日志
     * 参数一：应用名称
     * 参数二：错误信息
     */
    public  static function addErrorLog($appname,$content){
        $error = \Yii::$app->errorHandler->exception;
        $model_app_log = new AppLog();
        $model_app_log->app_name = $appname;
        $model_app_log->content = $content;
        //获取ip，$_SERVER['REMOTE_ADDR']
        $model_app_log->ip = UtilService::getIP();

        if(!empty($_SERVER['HTTP_USER_AGENT'])){
            $model_app_log->ua = $_SERVER['HTTP_USER_AGENT'];
        }

        if( $error ){
            $model_app_log->err_code=$error->getCode();
            if( isset( $error->statusCode ) ){
                $model_app_log->http_code = $error->statusCode;
            }

            if( method_exists( $error,"getname") ){
                $model_app_log->err_name = $error->getName();
            }
        }

        $model_app_log->created_time = date( "Y-m-d H:i:s" );
        $model_app_log->save( 0 );
    }

    public static function addAppAccessLog( $uid = 0 ){

        $get_params = \Yii::$app->request->get();
        $post_params = \Yii::$app->request->post();
        if( isset( $post_params['summary'] ) ){
            unset( $post_params['summary'] );
        }


        $target_url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'';

        $referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
        $ua = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';

        $access_log = new AppAccessLog();
        $access_log->uid = $uid;
        $access_log->referer_url = $referer?$referer:'';
        $access_log->target_url = $target_url;
        $access_log->query_params = json_encode(array_merge($get_params,$post_params));
        $access_log->ua = $ua?$ua:'';
        $access_log->ip = UtilService::getIP();
        $access_log->created_time = date("Y-m-d H:i:s");
        return $access_log->save(0);
    }
}