<?php
namespace Home\Controller;

use Common\Controller\BaseController;
/**
 * 用户接口
 */
class UserController extends BaseController{
    /**
     * 创建用户
     */    
    public function register(){
        $this->reqPost(array('account','password','repassword','email'));
        $data=I('post.');
        $res=D('Account')->register($data);//在Account表注册
        if(isset($res['code'])){
            $this->ajaxReturn(D('UserInfo')->register($data));
        }
        $this->ajaxReturn($res);
    }
    
    /**
     * 上传用户头像
     */
    public function uploadAvatar(){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('UserInfo')->uploadAvatar(session('user.u_id')));
    }
    
    /**
     * 修改用户基本信息
     */
    public function updateInfo(){
        $this->getlogin()->reqPost();
        $data=I('post.');
        $data['u_id'] = session('user.u_id');
        $data['account'] = session('user.account');
        $this->ajaxReturn(D('UserInfo')->updateInfo($data));
    }
    
    /**
     * 获取实时位置
     */
    public function saveLocation(){
        $this->getlogin()->reqPost(array('u_id','location'));
        $this->ajaxReturn(D('UserInfo')->saveLocation(I('post.')));
    }
    
    
    /**
     * 用户登陆
     */
    public function login(){
        $this->reqPost(array('account','password'));
        $data=I('post.');
        $data['password']=md5($data['password']);
        $account=D('Account')->login($data);
        $this->ajaxReturn($account);
    }
    
    public function logout(){
        session('user',NULL);
        if(session('user') == NULL){
            $this->ajaxReturn(spt_json_success('退出成功'));
        }
        else{
            $this->ajaxReturn(spt_json_error('出问题了'));
        }
    }
    
    /**
     * 更新密码
     */
    public function updatePassword(){
        $this->getlogin()->reqPost(array('password','newPassword','repassword'));
        $data=I('post.');
        $data['account']=session('user.account');
        $data['password']=md5($data['password']);
        $this->ajaxReturn(D('Account')->updatePassword($data));
    }
    
    /**
     * 附近的人
     */
    public function nearby($page = 1,$limit = 10){
        $this->getlogin()->reqGet();
        $this->ajaxReturn(D('UserInfo')->nearby(session('user.u_id'),$page,$limit));
    }
    
    /**
     * 显示本人的基本信息
     */
    public function getMyInfo(){
        $this->getlogin();
        $this->ajaxReturn(D('UserInfo')->getUserInfo(session('user.account')));
    }
    
    /**
     * 显示特定一用户信息
     */
    public function listsUserInfo(){
        $this->getlogin()->reqPost(array('account'));
        $this->ajaxReturn(D('UserInfo')->getUserInfo(I('post.account')));
    }
    
    /**
     * 找回密码
     */
    public function forgetPassword(){
        $this->reqPost(array('email'));
        $this->ajaxReturn(D('Account')->forgetPassword(I('post.email')));
    }
    
    /**
     * 判断PIN码
     */
    public function judge(){
        $data['account']=I('get.u');
        $data['PIN']=I('get.p');
        if(D('PinCode')->judgePIN($data)){
            $this->assign('account',$data['account']);
            $this->display('resetPassword');
            return;
        }
        $this->ajaxReturn('校验码过期或者错误');
    }
    
    /**
     * 找回密码-重设密码
     */
    public function resetPassword(){
        $this->reqPost(array('password','repassword','account'));
        $this->ajaxReturn(D('Account')->resetPassword(I('post.')));
    }
}