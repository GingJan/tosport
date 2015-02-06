<?php
namespace Admin\Controller;

use Common\Controller\BaseController;
class ManagerController extends BaseController{
    /**
     * 管理员注册（只限于超级管理员使用）
     */
    public function register(){
        $this->checkSuper()->reqPost(array('account','password','repassword'));
        $data=I('post.');
        $this->ajaxReturn(D('Manager')->register($data));
    }
    
    /**
     * 删除一管理员(只限于超级管理员使用)
     */
    public function deleteManager(){
        $this->checkManager()->reqPost(array('ma_id'));
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
    
    /**
     * 获取我的信息
     */
    public function getMyInfo(){
        $this->checkManager();
        $this->ajaxReturn(D('Manager')->getInfo(session('manager.ma_id')));
    }
    
    /**
     * 获取其他管理员信息
     */
    public function getOtherInfo(){
        $this->checkManager()->reqPost(array('ma_id'));
        $this->ajaxReturn(D('Manager')->getInfo(I('post.ma_id')));
    }
}
