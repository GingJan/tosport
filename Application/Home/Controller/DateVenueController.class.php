<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class DateVenueController extends BaseController{
    /**不开放
     * 显示某一场馆的基本信息
     */
    public function listsSpeVenue(){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('DateVenue')->listsSpeVenue(I('post.')));
    }
    
    /**
     * 显示所有的场馆(均为同城场馆)
     */
    public function listsCityVenue(){
        $this->getlogin()->reqGet();
        $this->ajaxReturn(D('VenueInfo')->listsCityVenue(session('user.region'),I('get.page',1)));
    }
    
    /**
     * 约该场馆
     */
    public function date(){
        $this->getlogin()->reqPost(array('vi_id','ma_id','date_time'));
        $data=I('post.');
        $data['subscriber']=session('user.u_id');
        $this->ajaxReturn(D('DateVenue')->date($data));
    }
    
    /**
     * 取消预约
     */
    public function cancelDate(){
        $this->getlogin()->reqPost(array('dv_id'));
        $data = I('post.dv_id');
        $data = session('user.u_id');
        $this->ajaxReturn(D('DateVenue')->cancelDate($data));
    }
    
    /**
     * 显示我预约的场馆
     */
    public function listsDate(){
        $this->getlogin()->reqGet();
        $this->ajaxReturn(D('DateVenue')->listsDate(session('user.u_id'),I('get.page',1)));
    }
}