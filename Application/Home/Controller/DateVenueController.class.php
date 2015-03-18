<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class DateVenueController extends BaseController{
    /**
     * 显示某一场馆的基本信息
     */
    public function listsSpeVenue(){
        $this->getlogin()->reqPost(array('vi_id'));
        $vi_id=I('post.vi_id');
        $this->ajaxReturn(D('DateVenue')->listsSpeVenue($vi_id));
    }
    
    /**
     * 显示所有的场馆(均为同城场馆)
     */
    public function listsCityVenue($page =1,$limit =10){
        $this->getlogin()->reqPost(array('region'));
        $region=I('post.region');
        $this->ajaxReturn(D('DateVenue')->listsCityVenue($region,$page,$limit));
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
        $this->ajaxReturn(D('DateVenue')->cancelDate(I('post.dv_id'),session('user.u_id')));
    }
    
    /**
     * 显示我预约的场馆
     */
    public function listsDate($page =1,$limit =10){
        $this->getlogin();
        $this->ajaxReturn(D('DateVenue')->listsDate(session('user.u_id'),$page,$limit));
    }
}