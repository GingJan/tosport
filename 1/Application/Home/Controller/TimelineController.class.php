<?php
namespace Home\Controller;

use Common\Controller\BaseController;

class TimelineController extends BaseController{
    /**
     * 发表一条 动态
     */
    public function send(){
        $this->getlogin();
        $data=I('post.');
        $data['u_id']=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->send($data));
    }
    
    /**
     * 删除一条动态
     */
    public function delete(){
        $this->getlogin();
//         D('Timeine')->
    }
    
    public function lists($page=1,$limit=15){
        $this->getlogin();
        $me_id=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->lists($me_id,$page,$limit));
    }
    
    
}
