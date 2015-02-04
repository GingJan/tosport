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
        $this->ajaxReturn(D('VenueInfo')->createVenue($data));
    }
    
    /**
     * 删除场馆
     */
    public function deleteVenue(){
        $this->checkManager()->reqPost(array('vi_id'));
        $vi_id=I('post.vi_id');
    }
    
    /**
     * 显示所有我创建的场馆
     */
    public function listsMyVenue($page = 1,$limit = 10){
        $this->checkManager();
        $manager_id=session('manager.ma_id');
        $this->ajaxReturn(D('VenueInfo')->listsMyVenue($manager_id,$page,$limit));
    }
}