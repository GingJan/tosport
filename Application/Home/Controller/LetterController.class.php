<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class LetterController extends BaseController{
    /**
     * 发送私信
     */
    public function send(){
        $this->getlogin()->reqPost(array('content','receiver_id','title'));
        $data=I('post.');
        $data['sender_id']=session('user.u_id');
        $this->ajaxReturn(D('Letter')->send($data));
    }
    
    /**
     * 获取消息列表
     */
    public function getList($page = 1,$limit = 10){
        $this->getlogin();
        $this->ajaxReturn(D('Letter')->getList(session('user.u_id'),$page = 1,$limit = 10));
    }
    
    /**
     * 获取某一对话记录
     */
    public function getRecord($page = 1,$limit = 10){
        $this->getlogin()->reqPost(array('sender_id'));
        $this->ajaxReturn(D('Letter')->getRecord(array('sender_id'=>I('post.sender_id'),'receiver_id'=>session('user.u_id')),$page = 1,$limit = 10));
    }
    
    
}