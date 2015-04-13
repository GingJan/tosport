<?php
namespace Home\Controller;

use Common\Controller\BaseController;

class TimelineController extends BaseController{
    /**
     * 发表一条 动态/打卡
     */
    public function send(){
        $this->getlogin()->reqPost(array('content'));
        $data=I('post.');
        $data['sender_id']=session('user.u_id');
        $data['now_region']=session('user.region');
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
        $this->getlogin()->reqGet();
        $data['sender_id']=session('user.u_id');
        $data['page']=$page;
        $data['limit']=$limit;
        $this->ajaxReturn(D('Timeline')->listsSpeTimeline($data));
    }
    
    /**
     * 显示某个人的动态
     */
    public function listsSpeTimeline(){
        $this->getlogin()->reqPost(array('u_id'));
        $data['page']=I('post.page',1);
        $data['limit']=I('post.limit',10);
        $data['sender_id']=I('post.u_id');
        $this->ajaxReturn(D('Timeline')->listsSpeTimeline($data));
    }
    
    /**
     * 显示指定某一条动态
     */
    public function listsOneTimeline(){
        $this->getlogin()->reqPost(array('tl_id'));
        $this->ajaxReturn(D('Timeline')->listsOneTimeline(I('post.tl_id')));
    }
    
    /**
     * 列出我关注的人的动态(包含我的动态)
     */
    public function listsAllTimeline($page=1,$limit=10){
        $this->getlogin()->reqGet();
        $this->ajaxReturn(D('Timeline')->listsAllTimeline(session('user.u_id'),$page,$limit));
    }
    
    /**
     * 列出同城用户的动态
     */
    public function listsCityTimeline($page=1,$limit=10){
        $this->getlogin()->reqGet();
        $this->ajaxReturn(D('Timeline')->listsCityTimeline(session('user.region'),$page,$limit));
    }
    
}
