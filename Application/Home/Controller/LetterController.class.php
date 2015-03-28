<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class LetterController extends BaseController{
    /**
     * 发送私信
     */
    public function send(){
        $this->getlogin()->reqPost(array('content','receiver_id'));
        $data['content']=I('post.content');
        $data['receiver_id']=I('post.receiver_id');
        $data['sender_id']=session('user.u_id');
        $this->ajaxReturn(D('Letter')->send($data));
    }
    
    /**
     * 列出收到的私信
     */
    public function listsReceiveLetter($page = 1,$limit = 15){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('Letter')->listsReceiveLetter(session('user.u_id'),$page,$limit));
    }    
    
    /**
     * 列出发出的私信
     */
    public function listsSendLetter($page = 1,$limit = 15){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('Letter')->listsSendLetter(session('user.u_id'),$page,$limit));
    }
    
}