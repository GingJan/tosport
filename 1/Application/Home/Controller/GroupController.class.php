<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class GroupController extends BaseController{
    /**
     * 创建群组
     */
    public function createGroup(){
        $this->getlogin()->reqPost(array('group_account','name','people'));
        $data=I('post.');
        $data['creator_id']=session('user.u_id');
        $data['region']=session('user.region');
        $this->ajaxReturn(D('GroupInfo')->createGroup($data));
    }
    
    /**
     * 显示我所创建的群组
     */
    public function listsGroup($page =1,$limit =10){
        $this->getlogin();
        $this->ajaxReturn(D('GroupInfo')->listsGroup(session('user.u_id'),$page,$limit));
    }
    
    
    /**
     * 删除群组
     */
    public function deleteGroup(){
        $this->getlogin()->reqPost(array('gi_id'));
        $this->ajaxReturn(D('GroupInfo')->deleteGroup(I('post.gi_id'),session('user.u_id')));
    }
    
    /**
     * 更改群组的信息
     */
    public function updateGroup(){
        $this->getlogin()->reqPost(array('gi_id','name','people'));
        $data=I('post.');
        $data['creator_id']=session('user.u_id');
        $this->ajaxReturn(D('GroupInfo')->updateGroup($data));
    }
    
    /**
     * 获取某群组的信息
     */
    public function getGroupInfo(){
        $this->getlogin()->reqPost(array('gi_id'));
        $this->ajaxReturn(D('GroupInfo')->getGroupInfo(I('post.gi_id')));
    }

    
    
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
    
    /**
     * 显示我加入的群组
     */
    public function listsJoinGroup($page = 1,$limit = 10){
        $this->getlogin();
        $this->ajaxReturn(D('GroupPerson')->listsJoinGroup(session('user.u_id'),$page,$limit));
    }
    
    /**
     * 显示加入群组的成员
     */
    public function listsAssociator($page =1,$limit =10){
        $this->getlogin()->reqPost(array('gi_id'));
        $this->ajaxReturn(D('GroupPerson')->listsAssociator(I('post.gi_id'),$page,$limit));
    }
    
    /**
     * 设置群组成员的权限(设置某成员为管理员,该API只限群组管理员使用)
     */
    public function setPower(){
        $this->getlogin()->reqPost(array('gi_id','associator_id'));
        $data=I('post.');
        $data['creator_id']=session('user.u_id');
        $this->ajaxReturn(D('GroupPerson')->setPower($data));
    }
    
    /**
     * 撤销某群组管理员的权限
     */
    public function rescindPower(){
        $this->getlogin()->reqPost(array('gi_id','associator_id'));
        $data=I('post.');
        $data['creator_id']=session('user.u_id');
        $this->ajaxReturn(D('GroupPerson')->rescindPower($data));
    }
    
    

}