<?php
namespace Home\Controller;

use Common\Controller\BaseController;

class TimelineController extends BaseController{
    /**
     * 发表一条 动态/打卡
     */
    public function send(){
        $this->getlogin()->reqPost(array('content','region'));
        $data['content']=I('post.content');
        $data['region']=I('post.region');//通过定位，获取用户所在的位置
        $data['sender_id']=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->send($data));
    }
    
    /**
     * 删除一条动态/打卡
     */
    public function delete(){
        $this->getlogin()->reqPost(array('tl_id'));
        $data['tl_id']=I('post.tl_id');
        $data['sender_id']=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->deleteTimeline($data));
    }
    
    /**
     * 显示我发的动态/打卡记录
     */
    
    public function listsMyTimeline($page=1,$limit=10){
        $this->getlogin();
        $sender_id=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->listsSpeTimeline($sender_id,$page,$limit));
    }
    
    /**
     * 显示某个人的动态
     */
    public function listsSpeTimeline($page=1,$limit=10){
        $this->getlogin()->reqPost(array('u_id'));
        $sender_id=I('post.u_id');
        $this->ajaxReturn(D('Timeline')->listsSpeTimeline($sender_id,$page,$limit));
    }
    
    /**
     * 列出我关注的人的动态(包含我的动态)
     * @param number $page
     * @param number $limit
     */
    public function listsAllTimeline($page=1,$limit=10){
        $this->getlogin();
        $me_id=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->listsAllTimeline($me_id,$page,$limit));
    }
    
    /**
     * 列出同城用户的动态
     * @param number $page
     * @param number $limit
     */
    public function listsCityTimeline($page=1,$limit=10){
        $this->getlogin()->reqPost(array('region'));
        $me_region=I('post.region');
        $this->ajaxReturn(D('Timeline')->listsCityTimeline($me_region,$page,$limit));
    }
    
}
