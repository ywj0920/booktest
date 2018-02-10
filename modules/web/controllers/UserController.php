<?php

namespace app\modules\web\controllers;



use app\common\services\UrlService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;


class UserController extends BaseController
{
    public function __construct($id,  $module, array $config=[]){
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }

    //登录页面
    public function actionLogin()
    {
        //如果是get请求，直接进入到登录页面
        if( \Yii::$app->request->isGet ){
            $this->layout="user";
            return $this->render('login');
        }
       //登录逻辑处理
        $login_name=trim($this->post("login_name",""));
        $login_pwd=trim($this->post("login_pwd",""));
        if(!$login_name || !$login_pwd){
            return $this->renderJS("请输入正确的用户名和密码1",UrlService::buildWebUrl("/user/login"));
        }
        //从用户表获取login_name =$login_name 信息是否存在
        $user_info=User::find()->where(['login_name'=>$login_name])->one();
        if(!$user_info){
            return $this->renderJS("请输入正确的用户名和密码2",UrlService::buildWebUrl("/user/login"));
        }

        //验证密码
        //密码加密算法 = md5(login_pwd + md5(login_salt))

        if( !$user_info->verifyPassword( $login_pwd)){
            return $this->renderJS("请输入正确的用户名和密码3",UrlService::buildWebUrl("/user/login"));
        }

        //保存用户的登录状态
        //cookies进行保存用户登录状态
        //加密字符串 + “#” + uid ,加密字符串 = md5(login_name + login_pwd + login_salt);

        $this->setLoginStatus($user_info);

        return $this->redirect(UrlService::buildWebUrl("/dashboard/index"));
    }
    //编辑当前登录人的信息
    public  function actionEdit()
    {
        if(\Yii::$app->request->isGet){
            //获取当前登录人的信息
            return $this->render('edit' ,['user_info' => $this->current_user]);
        }

        $nickname = trim( $this->post( "nickname","" ));
        $email = trim( $this->post( "email","" ));
        if( mb_strlen($nickname,"utf8") < 1 ){
            return $this->renderJSON([],"请输入合法的姓名",-1);
        }
        if( mb_strlen( $email,"utf8") < 1){
            return $this->renderJSON([],"请输入合法的邮箱",-1);
        }
        $user_info = $this->current_user;
        $user_info->nickname = $nickname;
        $user_info->email = $email;
        $user_info->updated_time = date("Y-m-d H:i:s");
        $user_info->update(0);
        return $this->renderJSON([],"编辑成功~~");

    }
    //重置当前人的登录密码
    public  function actionResetPwd()
    {
        if(\Yii::$app->request->isGet){

            return $this->render('reset_pwd',['user_info'=>$this->current_user]);
        }

        $old_password = trim($this->post('old_password',""));
        $new_password = trim($this->post('new_password',""));

        if(mb_strlen($old_password)<1){
            return $this->renderJSON([],'请输入原始密码~~');
        }

        if(mb_strlen($new_password)<6){
            return $this->renderJSON([],'请输入不少于6位字符~~');
        }

        if($old_password == $new_password){
            return $this->renderJSON([],'新密码和原始密码不能相同');
        }

        //判断原始密码是否正确
        $user_info = $this->current_user;
        if(!$user_info->verifyPassword($old_password)){
            return $this->renderJSON([],'请检查原始密码~~',-1);
        }

        //$user_info->login_pwd = md5($new_password.md5($user_info['login_salt']));
        $user_info->setPassword( $new_password );
        $user_info->updated_time = date('Y-m-d H:i:s');
        $user_info->update(0);

        $this->setLoginStatus($user_info);
        return $this->renderJSON([],'重置密码成功');
    }
    //退出登录
    public  function actionLogout(){
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl("/user/login"));
    }
}
