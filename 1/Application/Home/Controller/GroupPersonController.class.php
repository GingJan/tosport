<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class GroupPersonController extends BaseController{
    /**
     * 加入群组
     */
    public function joinGroup(){
        $this->getlogin()->reqPost(array('gi_id'));
        $data['gi_id']=I('post.gi_id');
        $data['associator_id']=session('user.u_id');
        $this->ajaxReturn(D('GroupPerson')->joinGroup($data));
    }
    
    /**
     * 退出群组
     */
    public function quitGroup(){
        $this->getlogin()->reqPost(array('gi_id'));
        $this->ajaxReturn(D('GroupPerson')->quitGroup(I('post.gi_id'),session('user.u_id')));
    }
}