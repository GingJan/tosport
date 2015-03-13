<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class DateMatchController extends BaseController{
    /**
     * 发布一条比赛
     */
    public function create(){
        $this->getlogin()->reqPost(array('match_type','match_place','match_time','content','picture','people_amount','my_region'));
        $data=I('post.');
        $data['creator_id']=session('user.u_id');
        $this->ajaxReturn(D('DateMatch')->createDM($data));
    }
    
    /**
     * 删除一条约比赛
     */
    public function delete(){
        $this->getlogin()->reqPost(array('dm_id'));
        $this->ajaxReturn(D('DateMatch')->deleteDM(I('post.dm_id'),session('user.u_id')));
    }
    
    /**
     * 显示 指定某条约比赛
     */
    public function listsSpeDM(){
        $this->getlogin()->reqPost(array('dm_id'));
        $this->ajaxReturn(D('DateMatch')->listsSpeDM(I('post.dm_id')));
    }
    
    /**
     * 显示同城的约运动
     */
    public function listsCityDM($page = 1,$limit = 10){
        $this->getlogin()->reqPost(array('my_region'));
        $this->ajaxReturn(D('DateMatch')->listsCityDM(I('post.my_region'),$page,$limit));
    }
    
    /**
     * 显示热门的约比赛
     */
    public function listsHotDM($page = 1,$limit = 10){
        $this->getlogin()->reqPost('my_region');
        $my_region=I('post.my_region');
        $this->ajaxReturn(D('DateMatch')->listsHotDM($my_region,$page,$limit));
    }
    
    /**
     * 约ta
     */
    public function dateIt(){
        $this->getlogin()->reqPost(array('dm_id','creator_id'));
        $data=I('post.');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('DateMatch')->dateIt($data));
    }
    
    /**
     * 取消预约
     */
    public function cancelDate(){
        $this->getlogin()->reqPost(array('dm_id'));
        $data['dm_id']=I('post.dm_id');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('DateMatch')->cancelDate($data));
    }
    
    /**
     * 列出约我的人
     */
    public function listsDateGuy($page = 1,$limit = 10){
        $this->getlogin();
        $creator_id=session('user.u_id');
        $this->ajaxReturn(D('DateMatch')->listsDateGuy($creator_id,$page,$limit));
    }
    
    /**
     * 列出我参加的比赛
     */
    public function listsJoin($page,$limit){
        $this->getlogin();
        $this->ajaxReturn(D('DateMatch')->listsJoin(session('user.u_id'),$page,$limit));
    }
}