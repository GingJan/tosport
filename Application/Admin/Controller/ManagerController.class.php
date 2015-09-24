<?php
namespace Admin\Controller;

use Common\Controller\BaseController;
class ManagerController extends BaseController{
    /*超级管理员*/
    /**
     * 管理员创建（只限于超级管理员使用）
     */
    public function createManager() {
        $this->getlogin()->checkPrivilege(array(0))->reqPost(array('account','password'));
        $data = I('post.');
        $data['nickname'] = $data['account'];
        $data['role'] = 1;
        $data['parent_ma_id'] = 0;
        if(isset($data['ma_id']))
            unset($data['ma_id']);
        $this->ajaxReturn(D('Manager')->createManager($data));
    }
    
    /**不开放
     * 删除一管理员(只限于超级管理员使用)
     */
    public function deleteManager() {
        $this->getlogin()->checkPrivilege(array(0))->reqPost(array('ma_id'));
        $this->ajaxReturn(D('Manager')->deleteManager(I('post.ma_id')));
    }

    /**
     * 禁用管理员
     */
    public function banManager() {
        $this->getlogin()->checkPrivilege(array(0))->reqPost(array('ma_id'));
        if(I('post.ma_id') == 1)
            $this->ajaxReturn(spt_json_error('不能禁用超级管理员'));
        $this->ajaxReturn(D('Manager')->banManager(I('post.ma_id')));
    }

    /**
     * 解封管理员
     */
    public function openManager() {
        $this->getlogin()->checkPrivilege(array(0))->reqPost(array('ma_id'));
        $this->ajaxReturn(D('Manager')->openManager(I('post.ma_id')));
    }

    /**
     * 列出所有管理员
     */
    public function listsManager(){
        $this->getlogin()->reqGet();
        $this->ajaxReturn(D('Manager')->listsManager(I('get.page',1)));
    }





    /*管理员*/
    /**
     * 创建场馆员工
     */
    public function createStaff() {
        $this->getlogin()->checkPrivilege(array(1))->reqPost(array('account','password'));
        $data = I('post.');
        $data['nickname'] = $data['account'];
        $data['role'] = 2;
        $data['parent_ma_id'] = session('user.ma_id');
        if(isset($data['ma_id']))
            unset($data['ma_id']);
        $this->ajaxReturn(D('Manager')->createStaff($data));
    }

    /**不开放
     * 删除员工
     */
    public function deleteStaff() {
        $this->getlogin()->checkPrivilege(array(1))->reqPost(array('ma_id'));
        $this->ajaxReturn(D('Manager')->deleteStaff(I('post.ma_id')));
    }

    /**
     * 禁用员工
     */
    public function banStaff() {
        $this->getlogin()->checkPrivilege(array(1))->reqPost(array('ma_id'));
        $data = I('post.');
        $data['parent_ma_id'] = session('user.ma_id');
        $this->ajaxReturn(D('Manager')->banStaff($data));
    }

    /**
     * 解封员工
     */
    public function openStaff() {
        $this->getlogin()->checkPrivilege(array(1))->reqPost(array('ma_id'));
        $this->ajaxReturn(D('Manager')->openStaff(I('post.ma_id')));
    }

    /**
     * 列出所有员工
     */
    public function listsStaff() {
        $this->getlogin()->checkPrivilege(array(1))->reqGet();
        $this->ajaxReturn(D('Manager')->listsStaff(session('user.ma_id'),I('get.page',1)));
    }




    /**
     * 登录
     */
    public function login(){
        $this->reqPost(array('account','password'));
        $data=I('post.');
        $data['password']=md5($data['password']);
        $this->ajaxReturn(D('Manager')->login($data));
    }
    
    /**
     * 退出
     */
    public function logout(){
        session(null);
        if(!session('?user')){//可以试下is_null()函数
            $this->ajaxReturn(spt_json_success('成功退出'));
        }
        $this->ajaxReturn(spt_json_error('退出失败'));
    }
    
    /**
     * 修改基本信息
     */
    public function updateInfo(){
        $this->getlogin()->reqPost();
        $data=I('post.');
        if(isset($data['password'])) {
            unset($data['password']);
        }
        $data['ma_id']=session('user.ma_id');
        $this->ajaxReturn(D('Manager')->updateInfo($data));
    }
    
    /**
     * 修改密码
     */
    public function updatePassword(){
        $this->getlogin()->reqPost(array('password','newPassword'));
        $data = I('post.');
        $data['account'] = session('user.account');
        $data['password'] = md5($data['password']);
        $data['newPassword'] = md5($data['newPassword']);
        $this->ajaxReturn(D('Manager')->updatePassword($data));
    }
    

    
    /**不开放
     * 获取我的信息
     */
    public function getMyInfo(){
        $this->checkManager();
        $this->ajaxReturn(D('Manager')->getInfo(session('manager.ma_id')));
    }
    
    /**不开放
     * 获取其他管理员信息
     */
    public function getOtherInfo(){
        $this->checkManager()->reqPost(array('ma_id'));
        $this->ajaxReturn(D('Manager')->getInfo(I('post.ma_id')));
    }
}
