<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class DateVenueController extends BaseController{
    /**
     * 显示特指某一场馆的基本信息
     */
    public function listsSpeVenue(){
        $this->getlogin()->reqPost(array('vi_id'));
        $data['vi_id']=I('post.vi_id');
        $this->ajaxReturn(D('DateVenue')->listsSpeVenue($data));
    }
    
    /**
     * 显示所有同城的场馆
     */
    public function listsCityVenue(){
        $this->reqPost();
        $this->ajaxReturn(D('DateVenue')->listsCityVenue());
    }
    
    /**
     * 
     */
}