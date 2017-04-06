<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Car\Api\CarApi;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class CarController extends HomeController {

	/* 用户中心首页 */
	public function save(){
		$Car = new CarApi();
		$Car->save();
	}

	public function index(){
		echo 123;exit;
	}
	
}
