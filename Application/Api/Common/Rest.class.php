<?php
/**
 * 接口通用参数
*/
class Rest{
	static function success($message, $data=array()){
		return array(
				'code'=>200,
				'message'=>$message,
				'data'=>$data
		);
	}


	static function failure($code=500, $message, $data=array()) {
		return array(
				'code'=>$code,
				'message'=>$message,
				'data'=>$data
		);
	}

}