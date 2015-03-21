<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class ThirdUserController extends BaseController{
    /**
     * 第三方用户第一次登陆
     */
    public function firstLogin(){
        $this->reqPost(array('account'));
        $this->ajaxReturn(D('UserInfo')->register(I('post.')));
    }
    
    /**
     * 登陆
     */
    public function login(){
        $this->reqPost(array('account'));
        $this->ajaxReturn(D('Account')->thirdLogin(I('post.account')));
    }
}