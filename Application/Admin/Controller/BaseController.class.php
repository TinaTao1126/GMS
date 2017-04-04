<?php
namespace Admin\Controller;


/**
 * 后台内容控制器
 * @author huajie <banhuajie@163.com>
 */
class BaseController extends AdminController{
	
	
	// 获取某个标签的配置参数
	public function group() {
		
		$id     =   I('get.id',1);
		$type   =   C('CONFIG_GROUP_LIST');
		$list   =   M("Config")->where(array('status'=>1,'group'=>$id))->field('id,name,title,extra,value,remark,type')->order('sort')->select();
		if($list) {
			$this->assign('list',$list);
		}
		$this->assign('id',$id);
		$this->meta_title = $type[$id].'设置';
		$this->display();
	}
}