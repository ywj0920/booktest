<?php

namespace app\modules\web\controllers;

use yii\web\Controller;


class QrcodeController extends Controller
{
    public function __construct($id,  $module, array $config=[]){
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }
    //渠道二维码的列表
    public function actionIndex()
    {

        return $this->render('index');
    }
    //渠道二维码的添加和编辑
    public  function actionSet()
    {

        return $this->render('set');
    }

}
