<?php
namespace Admin\Controller;

use Common\Controller\BaseController;
class OrderController extends BaseController{
    /**
     * 查看所有预约单
     */
    public function listsAllOrder($page= 1,$limit = 10){
        $this->checkManager();
        $this->ajaxReturn(D('DateVenue')->listsAllOrder(session('manager.ma_id'),$page,$limit));
    }
    
    /**
     * 查看特定场所的预约单 
     */
    public function listsSpeOrder($page = 1,$limit = 10){
        $this->checkManager()->reqPost(array('vi_id'));
        $data=I('post.');
        $data['ma_id']=session('manager.ma_id');
        $this->ajaxReturn(D('DateVenue')->listsSpeOrder($data,$page,$limit));
    }
    
    /**
     * 显示未结的预约单
     */
    public function listsUndone($page = 1,$limit = 10){
        $this->checkManager();
        $this->ajaxReturn(D('DateVenue')->listsUndone(session('manager.ma_id'),$page,$limit));
    }
    
    
    /**
     * 结单
     */
    public function doneOrder(){
        $this->checkManager()->reqPost(array('dv_id'));
        $this->ajaxReturn(D('DateVenue')->doneOrder(I('post.dv_id'),session('manager.ma_id')));
    }
}