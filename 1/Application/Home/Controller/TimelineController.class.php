<?php
namespace Home\Controller;

use Common\Controller\BaseController;

class TimelineController extends BaseController{
    /**
     * 发表一条 动态
     */
    public function send(){
        $this->getlogin();
        $data['content']=I('post.content');
        $data['sender_id']=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->send($data));
    }
    
    /**
     * 删除一条动态
     */
    public function delete(){
        $this->getlogin();
        $tl_id=I('post.tl_id');
        $this->ajaxReturn(D('Timeline')->deleteTimeline($tl_id));
    }
    
    public function lists($page=1,$limit=15){
        $this->getlogin();
        $me_id=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->lists($me_id,$page,$limit));
    }
    
    
}
