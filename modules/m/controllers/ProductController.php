<?php

namespace app\modules\m\controllers;

use yii\web\Controller;


class ProductController extends Controller
{
    public function __construct($id,  $module, array $config=[]){
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }
    //商品首页
    public function actionIndex()
    {

        return $this->render('index');
    }
    //商品详情
    public function actionInfo()
    {

        return $this->render('info');
    }
    //用户下单页面
    public function actionOrder()
    {

        return $this->render('order');
    }
}
