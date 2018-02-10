<?php

namespace app\modules\weixin\controllers;

use app\common\components\BaseWebController;

class MsgController extends BaseWebController{

    public function actionIndex(){
        if( !$this->checkSignature() ){
            $this->record_log( "校验错误" );
            //可以直接回复空串，微信服务器不会对此作任何处理，并且不会发起重试
            return 'error signature ~~';
        }

        if( array_key_exists('echostr',$_GET) && $_GET['echostr']){//用于微信第一次认证的
            return $_GET['echostr'];
        }
        return "hello word";
    }

    public function checkSignature(){
        $signature = trim( $this->get("signature","") );
        $timestamp = trim( $this->get("timestamp","") );
        $nonce = trim( $this->get("nonce","") );
        $tmpArr = array( \Yii::$app->params['weixin']['token'],$timestamp,$nonce );
        sort( $tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr ==  $signature ){
            return true;
        }else{
            return false;
        }
    }
}