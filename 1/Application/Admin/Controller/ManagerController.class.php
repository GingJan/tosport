<?php
namespace Admin\Controller;

use Common\Controller\BaseController;
class ManagerController extends BaseController{
    /**
     * 管理员注册（只限于超级管理员使用）
     */
    public function register(){
        $this->checkManager();
        if(session('manager.ma_id') !== 1 && session('manager.account') !== 'super'){
            $this->ajaxReturn(spt_json_error('你不是超级管理员，无法注册管理员账户'));
        }
        $this->reqPost(array('account','password','repassword'));
        $data=I('post.');
        $this->ajaxReturn(D('Manager')->register($data));
    }
    
    /**
     * 删除一管理员(只限于超级管理员使用)
     */
    public function deleteManager(){
        $this->checkManager();
        if(session('manager.ma_id') !== 1 && session('manager.account') !== 'super'){
            $this->ajaxReturn(spt_json_error('你不是超级管理员，无法删除管理员账户'));
        }
        $this->reqPost(array('ma_id'));
        $ma_id=I('post.ma_id');
        $this->ajaxReturn(D('Manager')->deleteManager($ma_id));
    }
    
    /**
     * 管理员登录(包括超级管理员)
     */
    public function login(){
        $this->reqPost(array('account','password'));
        $data=I('post.');
        $data['password']=md5($data['password']);
        $this->ajaxReturn(D('Manager')->login($data));
    }
    
    /**
     * 退出登录
     */
    public function logout(){
        session('manager',null);
        if(!session('?manager')){
            $this->ajaxReturn(spt_json_success('成功退出'));
        }
        $this->ajaxReturn(spt_json_error('退出失败'));
    }
    
    /**
     * 修改基本信息(包括超级管理员) 
     */
    public function updateInfo(){
        $this->checkManager()->reqPost(array('email'));
        $data=I('post.');
        $data['ma_id']=session('manager.ma_id');
        $this->ajaxReturn(D('Manager')->updateInfo($data));
    }
    
    /**
     * 修改密码
     */
    public function updatePassword(){
        $this->checkManager()->reqPost(array('password','newPassword','repassword'));
        $data=I('post.');
        $data['account']=session('manager.account');
        $data['password']=md5($data['password']);
        $this->ajaxReturn(D('Manager')->updatePassword($data));
    }
    
    /**
     * 列出所有管理员
     */
    public function listsManager($page = 1,$limit = 10){
        $this->checkManager();
        $this->ajaxReturn(D('Manager')->listsManager($page,$limit));
    }
}
