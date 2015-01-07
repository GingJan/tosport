<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class FriendsController extends BaseController{
    /**
     * 添加朋友
     * @param string $friends_account
     */
    public function addFriend(){
        if($res=spt_getLoginUser()){
            $data['friend_account']=I('post.friend_account');
            $data['me_account']=$res['account'];
            $this->ajaxReturn(D('Friends')->addFriend($data));
        }
       $this->ajaxReturn(spt_json_error('Oops,请先登录'));
    }
    
    /**
     * 删除朋友关系
     * @param int $f_id
     */
    public function deleteFriend(){
        $res=$this->getlogin(1);
        if($res['code'] === 20000){
            $data['f_id']=I('post.f_id');
            $data['me_account']=session('user.account');
            $this->ajaxReturn(D('Friends')->deleteFriend($data));
        }
        $this->ajaxReturn($res);
    }
    
    public function listsFriend($page = 1,$limit = 15){
        $this->getlogin();
        $data=spt_getLoginUser();
        $res=D('Friends')->listsFriend($data['account'],$page,$limit);
        $this->ajaxReturn($res);
    }
    
    
}