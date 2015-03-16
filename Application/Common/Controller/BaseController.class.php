<?php

namespace Common\Controller;

use Think\Controller;

class BaseController extends Controller{
	
	/**
	 * 对应控制器下没有方法就会执行该方法
	 */
	protected function _empty(){
        if(file_exists_case($this->view->parseTemplate())) {
            // 检查是否存在默认模版 如果有直接输出模版
            $this->display();
        }else{
            $this->ajaxReturn(spt_json_error("No interface for this."));
        }
	}
    /**
     * 需要Get的字段
     * @param array $require_data
     * @return $this
     */
    public function reqGet(array $require_data = null){
        if(! IS_GET){
            $this->ajaxReturn(spt_json_error_request());
        }
        if($require_data){
            foreach ($require_data as $key){
                $_k = I('get.' . $key,null);
                if(is_null($_k)){
                    $this->ajaxReturn(spt_json_error("require params: " . $key));
                }
            }
        }
        return $this;
    }
	/**
	 * 需要Post的字段
	 * @param array $require_data
	 * @return \Common\Controller\BaseController
	 */
	protected function reqPost(array $require_data = null) {
		if (! IS_POST) {
			$this->ajaxReturn(spt_json_error_request());
		}
		if ($require_data) {
			foreach ($require_data as $key) {
				$_k = I('post.' . $key,null);
				if(is_null($_k)){
					$this->ajaxReturn(spt_json_error("require params: " . $key));
				}
			}
		}
		return $this;
	}
	
	/**
	 * 登录检测
	 * @param int
	 * @return $this
	 */
	protected function getlogin($type = 0){
		if(session('?user')){
		    return $this;
		}
		else{
            $this->ajaxReturn(spt_json_error('请先登录'));
		}
	}
	
	/**
	 * 获取当前登录会员资料 
	 * $return session
	 */
	protected function reqLoginmember(){
	    $member=session("member");
	    unset($member["password"],$member["ctime"],$member["cIP"]);
	    return $member;
	}
	
	/**
	 * 检测是否管理员
	 */
	protected function checkManager(){
	   if(session('?manager')){
	       return $this;
	   }
	   else{
	       $this->ajaxReturn(spt_json_error('你不是管理员或者你还未登录'));
	   } 
	}
	
	/**
	 * 检测是否超级管理员
	 */
	protected function checkSuper(){
	    if(session('manager.ma_id') === 1){
	        return $this;
	    }
	    $this->ajaxReturn(spt_json_error('你不是超级管理员,无法使用该功能'));
	}
	
	/**
	 * 获取上传凭证
	 */
	public function uploadToken(){
	    $this->getlogin()->reqPost();
	    $this->ajaxReturn(D('Qiniu')->upToken());
	}
	
	/**
	 * 获取下载凭证(下载链接)
	 */
	public function downloadToken($key){
	    $this->getlogin()->reqPost();
	    $this->ajaxReturn(D('Qiniu')->downToken($key));
	}
}