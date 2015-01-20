<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class MessageController extends BaseController{
    /**
     * 查看收到的消息
     * @param number $page
     * @param number $limit
     */
    public function listsReceiveComment($page = 1,$limit = 15){
        $this->getlogin();
        $this->ajaxReturn(D('Comment')->listsReceiveComment(session('user.u_id'),$page,$limit));
    }
    
    /**
     * 查看发送的消息
     */
    public function listsSendComment($page=1,$limit=15){
        $this->getlogin();
        $this->ajaxReturn(D('Comment')->listsSendComment(session('user.u_id'),$page,$limit));
    }
    
    /**
     * 发送消息
     */
    public function send(){
        $this->getlogin();
        $content=I('post.');
        
    }
    
    
}