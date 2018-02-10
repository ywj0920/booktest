<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

/**
 * Default controller for the `m` module
 */
class UserController extends Controller
{
    public function __construct($id,  $module, array $config=[]){
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }
    //帐号绑定
    public function actionBind()
    {

        return $this->render('bind');
    }
    //我的购物车页面
    public function actionCart()
    {

        return $this->render('cart');
    }
    //我的订单列表页面
    public function actionOrder()
    {

        return $this->render('order');
    }
    //我的
    public function actionIndex()
    {

        return $this->render('index');
    }
    //我的地址列表
    public function actionAddress()
    {

        return $this->render('address');
    }
    //添加或者编辑收获地址
    public function actionAddress_set()
    {

        return $this->render('address_set');
    }
    //我的收藏
    public function actionFav()
    {

        return $this->render('fav');
    }
    //我的评论列表
    public function actionComment()
    {

        return $this->render('comment');
    }
    //我的评论
    public function actionComment_set()
    {

        return $this->render('Comment_set');
    }
}
