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
     * 列出所有的私信,包括收到的和发送的
     */
    public function listsAllLetter($page = 1,$limit = 15){
        $this->getlogin();
        $me_id=session('user.u_id');
        $this->ajaxReturn(D('Letter')->listsAllLetter($me_id,$page,$limit));
        
    }    
    
}