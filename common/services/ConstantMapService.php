<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/20 0020
 * Time: 下午 1:11
 */

namespace app\common\services;


class ConstantMapService {
    public static $status_default=-1;
    public  static $status_mapping =[
        1 => '正常',
        0 => '已删除',
    ];
    public  static $default_avatar = "default_avatar";
    public  static $default_password = "******";

    public static $sex_mapping = [
        1 => '男',
        2 => '女',
        0 => '未填写'
    ];
}