<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;


/**
 * 订单管理
 * @author tina
 *
 */
class OrderController extends AdminController {

    /**
     * 用户管理首页
     * @author tina
     */
    public function index(){
    	$district_id       =   I('district_id');
    	$city_id       =   I('city_id');
    	$store_id       =   I('store_id');
    	$map = array();
    	if($district_id > 0) {
    		$map['district_id']=$district_id;
    	}
    	if($city_id > 0) {
    		$map['city_id']=$city_id;
    	}
    	if($store_id > 0) {
    		$map['store_id']=$store_id;
    	}
        

        $list   = $this->lists('Store', $map);
        int_to_string($list);
        $this->assign('_list', $list);
//         print_r($list);exit;
        $this->meta_title = '门店信息';
        $this->display();
    }
    
    public function changeStatus($method=null){
    	$id = array_unique((array)I('id',0));
       	$id = is_array($id) ? implode(',',$id) : $id;
    	if ( empty($id) ) {
    		$this->error('请选择要操作的数据!');
    	}
    	$map['id'] =   array('in',$id);
    	switch ( strtolower($method) ){
    		case 'disabled':
    			$this->forbid('Store', $map );
    			break;
    		case 'enabled':
    			$this->resume('Store', $map );
    			break;
    		default:
    			$this->error('参数非法');
    	}
    }
    
    
    /**
     * 删除
     */
    public function del(){
    	$id = array_unique((array)I('id',0));
    
    	if ( empty($id) ) {
    		$this->error('请选择要操作的数据!');
    	}
    
    	$map = array('id' => array('in', $id) );
    	if(M('Store')->where($map)->delete()){
    		S('DB_CONFIG_DATA',null);
    		//记录行为
    		action_log('delete_store','store',$id,UID);
    		$this->success('删除成功');
    	} else {
    		$this->error('删除失败！');
    	}
    }
    
    /**
     * 修改初始化
     * @author tina
     */
    public function edit($id = 0){
    	if(IS_POST) {
    		$Store = D('Store');
    		$data = $Store->create();
    		if($data){
    			if($Store->save()){
    				S('DB_CONFIG_DATA',null);
    				//记录行为
    				action_log('update_store','store',$data['id'],UID);
    				$this->success('更新成功', Cookie('__forward__'));
    			} else {
    				$this->error('更新失败');
    			}
    		} else {
    			$this->error($Store->getError());
    		}
    	} else {
    		if($id == 0) {
    			$this->error('无效的参数');
    		}
    		$data = M('Store')->field(true)->find($id);
    		if(false === $data){
    			$this->error("获取门店信息错误");
    		}
    		$this->assign('data',$data);
    		$this->meta_title = '修改门店信息';
    		$this->display();
    	}
    	
    }
    
    /**
     * 更新
     * @author tina
     */
    public function save(){
    	$res = D('Store')->update();
    	if(!$res){
    		$this->error(D('Store')->getError());
    	}else{
    		$this->success($res['id']?'更新成功！':'新增成功！', Cookie('__forward__'));
    	}
    }
    
// 	/**
//      * 新增行为
//      * @author tina
//      */
//     public function addAction(){
//         $this->meta_title = '新增行为';
//         $data = array("storename"=>"test");
//         $this->assign('data',$data);
//         $this->display('editaction');
//     }
    
    
    /**
     * 用户行为列表
     * @author huajie <banhuajie@163.com>
     */
    public function action(){
    	//获取列表数据
    	$Action =   M('Action')->where(array('status'=>array('gt',-1)));
    	$list   =   $this->lists($Action);
    	int_to_string($list);
    	// 记录当前列表页的cookie
    	Cookie('__forward__',$_SERVER['REQUEST_URI']);
    
    	$this->assign('_list', $list);
    	$this->meta_title = '用户行为';
    	$this->display();
    }
    
    /**
     * 编辑行为
     * @author huajie <banhuajie@163.com>
     */
    public function editAction(){
    	$id = I('get.id');
    	empty($id) && $this->error('参数不能为空！');
    	$data = M('Action')->field(true)->find($id);
    
    	$this->assign('data',$data);
    	$this->meta_title = '编辑行为';
    	$this->display();
    }
    
    public function add(){

    	if(IS_POST){
    		$param = I('post.');
    		$storename = $param['name'];
    		
    		/** 判断参数*/
    		if(empty($storename)) {
    			$this->error("门店名称不能为空！");
    		}
    		
    
    		/* 调用注册接口注册用户 */
    		$Store = D('Store');
    		$data = $Store->create();
    		if($data){
    			$id = $Store->add();
    			if($id){
    				// S('DB_CONFIG_DATA',null);
    				//记录行为
    				action_log('add_store', 'Store', $id, UID);
    				$this->success('新增成功', Cookie('__forward__'));
    			} else {
    				$this->error('新增失败');
    			}
    		} else {
    			$this->error($Store->getError());
    		}
    		
    	} else {
    		$this->meta_title = '新增用户';
    		$this->display();
    	}
    }

   
}
