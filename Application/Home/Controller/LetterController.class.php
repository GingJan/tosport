<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class LetterController extends BaseController{
    /**
     * 发送私信
     */
    public function send(){
        $this->getlogin()->reqPost(array('content','receiver_id'));
        $data=I('post.');
        $data['sender_id']=session('user.u_id');
        $this->ajaxReturn(D('Letter')->send($data));
    }
    
    /**
     * 获取消息列表
     */
    public function getList($page = 1,$limit = 10){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('Letter')->getList(session('user.u_id'),$page,$limit));
    }
    
    /**
     * 获取与某人的未读记录
     */
    public function getRecord(){
        $this->getlogin()->reqPost(array('sender_id'));
        $this->ajaxReturn(D('Letter')->getRecord(array('sender_id'=>I('post.sender_id'),'receiver_id'=>session('user.u_id'))));
    }
    
    /**
     * 获取与某人的已读记录
     */
    public function getReaded($page = 1,$limit = 10){
        $this->getlogin()->reqPost(array('sender_id'));
        $this->ajaxReturn(D('Letter')->getReaded(array('sender_id'=>I('post.sender_id'),'receiver_id'=>session('user.u_id')),$page,$limit));
    }
    
    
    
}