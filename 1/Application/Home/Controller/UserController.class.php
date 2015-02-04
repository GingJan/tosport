<?php
namespace Home\Controller;

use Common\Controller\BaseController;
/**
 * 用户接口
 */
class UserController extends BaseController{
    
    /**
     * 创建用户
     * @return json
     */    
    public function register(){
        $this->reqPost(array('account','password','repassword','email'));
        $data=I('post.');
        $res=D('Account')->register($data);//在Account表注册
        if(isset($res['code'])){
            $res=D('UserInfo')->register($data);//这UserInfo表注册
            if(isset($res['code'])){
                $this->ajaxReturn($res);
            }
            $this->ajaxReturn($res);
        }
        $this->ajaxReturn($res);
    }
    
    
    
    /**
     * 修改用户基本信息
     * @param int u_id
     */
    public function updateInfo(){
        $this->getlogin()->reqPost();
        $data=I('post.');
        $data['u_id'] = session('user.u_id');
        $data['account'] = session('user.account');
        $res=D('UserInfo')->updateInfo($data);
        $this->ajaxReturn($res);
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
        $this->getlogin()->reqPost(array('region'));
        $region=I('post.');
        $this->ajaxReturn(D('UserInfo')->nearby($region,$page,$limit));
    }
    
    /**
     * 显示本人的基本信息
     */
    public function getMyInfo(){
        $this->getlogin();
        $this->ajaxReturn(D('UserInfo')->getUserInfo(session('user.account')));
    }
    /**
     * 显示其他用户个人信息
     */
    public function listsUserInfo(){
        $this->getlogin()->reqPost(array('account'));
        $this->ajaxReturn(D('UserInfo')->getUserInfo(I('post.account')));
    }
    
    /**
     * Todo
     */
    public function forgetPassword(){
        $email=I('post.email');
        $this->ajaxReturn(D('Account')->forgetPassword($email));
    }
}