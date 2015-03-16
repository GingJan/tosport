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
        $this->checkManager()->reqPost(array('name','people','type','price','region','intro'));
        $data=I('post.'); 
        $data['ma_id']=session('manager.ma_id');
        $this->ajaxReturn(D('VenueInfo')->createVenue($data));
    }
    
    /**
     * 删除场馆
     */
    public function deleteVenue(){
        $this->checkManager()->reqPost(array('vi_id'));
        $vi_id=I('post.vi_id');
        $ma_id=session('manager.ma_id');
        $this->ajaxReturn(D('VenueInfo')->deleteVenue($vi_id,$ma_id));
    }
    
    /**
     * 修改场馆信息
     */
    public function updateVenue(){
        $this->checkManager()->reqPost('vi_id');
        $data=I('post.');
        $data['ma_id']=session('manager.ma_id');
        $this->ajaxReturn(D('VenueInfo')->updateVenue($data));
    }
    
    /**
     * 显示所有我创建的场馆
     */
    public function listsMyVenue($page = 1,$limit = 10){
        $this->checkManager();
        $ma_id=session('manager.ma_id');
        $this->ajaxReturn(D('VenueInfo')->listsMyVenue($ma_id,$page,$limit));
    }
    
    /**
     * 列出所有场馆,只提供给超级管理员使用
     */
    public function listsAllVenue($page = 1,$limit = 10){
        $this->checkSuper();
        $this->ajaxReturn(D('VenueInfo')->listsAllVenue($page,$limit));
    }
    
}