<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class FriendController extends BaseController{
    /**
     * 发送交友请求，对方接受后，才建立好友关系Todo
     */
    
    /**
     * 关注对方
     * @param string $friends_account
     */
    public function addFriend(){
        $this->getlogin()->reqPost(array('u_id'));
        $data['friend_id']=I('post.u_id');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('Friend')->addFriend($data));
    }
    
    /**
     * 删除关注
     * @param int $f_id
     */
    public function deleteFriend(){
        $this->getlogin()->reqPost(array('f_id'));
        $data['f_id']=I('post.f_id');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('Friend')->deleteFriend($data));
    }
    
    /**
     * 列出我关注的人
     * @param number $page
     * @param number $limit
     */
    
    public function listsFriend($page = 1,$limit = 10){
        $this->getlogin()->reqGet();
        $this->ajaxReturn(D('Friend')->listsFriend(session('user.u_id'),$page,$limit));
    }
    
}