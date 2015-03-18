<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class CommentController extends BaseController{
    /**
     * 发送/回复 消息/评论
     */
    public function sendComment(){
        $this->getlogin()->reqPost(array('content','tl_id','receiver_id'));
        $data=I('post.');
        $data['sender_id']=session('user.u_id');
        $this->ajaxReturn(D('Comment')->sendComment($data));
    }
    
    /**
     * 点/取消 赞
     */
    public function like(){
        $this->getlogin()->reqPost(array('tl_id','receiver_id'));
        $data=I('post.');
        $data['sender_id']=session('user.u_id');
        $data['send_time']=NOW_TIME;
        $this->ajaxReturn(D('Comment')->like($data));
    }
    
    /**
     * 显示自己发的评论
     */
    public function listsMyComment($page = 1,$limit = 10){
        $this->getlogin()->reqPost(array('me_id'));
        $this->ajaxReturn(D('Comment')->listsMyComment(I('post.me_id')));
    }
    
    /**
     * 删除自己的发表的评论
     */
    public function deleteComment(){
        $this->getlogin()->reqPost(array('c_id'));
        $c_id=I('post.c_id');
        $me_id=session('user.u_id');
        $this->ajaxReturn(D('Comment')->deleteComment($c_id,$me_id));
    }
    
    /**
     * 显示所有的评论/消息/赞
     * @param number $page
     * @param number $limit
     */
    public function listsAllComment($page = 1,$limit = 10){
        $this->getlogin()->reqPost();//不再进行提交方式验证，get/post都可以
        $this->ajaxReturn(D('Comment')->listsAllComment(session('user.u_id'),$page,$limit));
    }
    
    /**
     * 显示特定某条动态的评论/赞
     */
    public function listsSpeComment($page = 1,$limit = 10){
        $this->getlogin()->reqPost(array('tl_id'));
        $this->ajaxReturn(D('Comment')->listsSpeComment(I('post.tl_id'),$page,$limit));
    }
}