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
        $data=I('post.');
        $res=D('User')->register($data);
        $this->ajaxReturn($res);
    }
    
    /**
     * 修改用户基本信息
     * @param int u_id
     */
    public function update(){
        $this->getlogin();//登陆检测
        $data=I('post.');
        $data['u_id'] = session('user.u_id');
        $data['account'] = session('user.account');
        $res=D('UserInfo')->update($data);
        $this->ajaxReturn($res);
    }
    
    /**
     * 用户登陆
     */
    public function login(){
        $data=I('post.');
        $data['password']=md5($data['password']);
//         dump($data);
//         exit;
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
    
    public function updatePassword(){
        $this->getlogin();//登陆检测
        $data=I('post.');
        if($data['newPassword'] == NULL || $data['repassword'] == NULL){
            $this->ajaxReturn('需要newPassword 和 repassword 字段');
        }
        $data['account']=session('user.account');
        $data['password']=md5($data['password']);
//         var_dump($data);
//         exit;
//         $account=D('Account')->updatePassword($data);
        $this->ajaxReturn(D('Account')->updatePassword($data));
    }

}