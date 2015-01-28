<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class FriendController extends BaseController{
    /**
     * 添加朋友
     * @param string $friends_account
     */
    public function addFriend(){
        $this->getlogin()->reqPost(array('u_id'));
        $data['friend_id']=I('post.u_id');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('Friend')->addFriend($data));
    }
    
    /**
     * 删除朋友关系
     * @param int $f_id
     */
    public function deleteFriend(){
        $this->getlogin()->reqPost(array('f_id'));
        $data['f_id']=I('post.f_id');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('Friend')->deleteFriend($data));
    }
    
    /**
     * 列出改用户所加的朋友
     * @param number $page
     * @param number $limit
     */
    
    public function listsFriend($page = 1,$limit = 15){
        $this->getlogin();
        $this->ajaxReturn(D('Friend')->listsFriend(session('user.u_id'),$page,$limit));
    }
    
}