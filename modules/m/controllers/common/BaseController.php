<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/4 0004
 * Time: 下午 12:32
 */

namespace app\modules\m\controllers\common;

use app\common\components\BaseWebController;

class BaseController extends  BaseWebController
{
    public function __construct($id, $module, $config = []){
        parent::__construct($id, $module, $config = []);
        $this->layout = "main";


    }

    public function beforeAction($action){
        return true;
    }


}