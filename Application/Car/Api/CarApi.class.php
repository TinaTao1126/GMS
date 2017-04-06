<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Car\Api;
use Think\Exception;
use Car\Service\CarService;
define('UC_CLIENT_PATH', dirname(dirname(__FILE__)));

//载入配置文件
require_cache(UC_CLIENT_PATH . '/Conf/config.php');

//载入函数库文件
require_cache(UC_CLIENT_PATH . '/Common/common.php');

//载入函数库文件
require_cache(UC_CLIENT_PATH . '/Common/function.php');

class CarApi{
    
	public function save(){
		$json = file_get_contents('php://input');
		$param =json_decode($json,true);
		
		$carService = new CarService();
		$data = $carService->encapsuleData($param);
		
		//保存图片
		save_base64_image($data['imageFile']);
		var_dump($data);exit;
		
	}
	
	

	
}
