<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Car\Service;

class CarService{

	/**
	 * 验证并且组装数据
	 * @param unknown $param
	 * @return unknown
	 */
	public function encapsuleData($param){
		if(!isset($param['AlarmInfoPlate'])) {
			
			throw_exception("请求参数不全");
		}
		$AlarmInfoPlate = $param['AlarmInfoPlate'];
		
		if(!isset($AlarmInfoPlate['result'])) {
			throw_exception("请求参数不全");
		}
		$Result = $AlarmInfoPlate['result'];
		
		if(!isset($Result['PlateResult'])) {
			throw_exception("请求参数不全");
		}
		$PlateResult = $Result['PlateResult'];
		$data = array();
		$data['carInfo'] = $PlateResult;
		$data['imageFile'] = $Result['imageFile']; 
		return $data;
	}
	
	
}