<?php
namespace Admin\Controller;

use Common\Controller\BaseController;
/**
 * 该API仅提供给管理员使用
 */
class VenueController extends BaseController{
    /**
     * 创建一条场馆信息
     */
    public function createVenue(){
        $this->checkManager()->reqPost(array('name','type','price','region','intro','picture'));
        $data=I('post.'); 
        $data['manager_id']=session('manager.ma_id');
        $this->ajaxReturn(D('Venue')->createVenue($data));
    }
}