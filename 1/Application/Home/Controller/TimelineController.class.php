<?php
namespace Home\Controller;

use Common\Controller\BaseController;

class TimelineController extends BaseController{
    /**
     * 发表一条 动态/打卡
     */
    public function send(){
        $this->getlogin()->reqPost(array('content'));
        $data['content']=I('post.content');
        $data['sender_id']=session('user.u_id');
        $data['region']=session('user.region');//需要改进为，通过定位，获取用户所在的位置
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
    
    public function listsMyTimeline($page=1,$limit=15){
        $this->getlogin();
        $me_id=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->listsMyTimeline($me_id,$page,$limit));
    }
    
    
    /**
     * 列出我关注的人的动态(可能需要改为列出 好友 动态)
     * @param number $page
     * @param number $limit
     */
    public function listsAllTimeline($page=1,$limit=15){
        $this->getlogin();
        $me_id=session('user.u_id');
        $this->ajaxReturn(D('Timeline')->listsAllTimeline($me_id,$page,$limit));
    }
    
    /**
     * 列出同城用户的动态
     * @param number $page
     * @param number $limit
     */
    public function listsCityTimeline($page=1,$limit=15){
        $this->getlogin();
        $me_region=session('user.region');
        $this->ajaxReturn(D('Timeline')->listsCityTimeline($me_region,$page,$limit));
    }
    
}
