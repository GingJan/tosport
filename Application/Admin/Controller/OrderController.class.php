<?php
namespace Admin\Controller;

use Common\Controller\BaseController;
class OrderController extends BaseController{

    /**
     * 查看预约订单列表
     */
    public function listBooking() {
        $this->getlogin()->checkPrivilege(array(2))->reqGet();
        $this->ajaxReturn(D('DateVenue')->listBooking(session('user.parent_ma_id'),I('get.page',1)));
    }

    /**
     * 显示某一订单的详细信息
     */
    public function listOrderDetail() {
        $this->getlogin()->checkPrivilege(array(2))->reqPost(array('dv_id'));
        $data = I('post.');
        $data['ma_id'] = session('user.parent_ma_id');
        $this->ajaxReturn(D('DateVenue')->listOrderDetail($data));
    }

    /**
     * 结单
     */
    public function doneOrder(){
        $this->getlogin()->checkPrivilege(array(2))->reqPost(array('dv_id'));
        $data = I('post.');
        $data['ma_id'] = session('user.parent_ma_id');
        $this->ajaxReturn(D('DateVenue')->doneOrder($data));
    }










    /*下面的接口不开放*/
    /**
     * 查看所有预约单
     */
    public function listsAllOrder($page= 1,$limit = 10){
        $this->checkManager();
        $this->ajaxReturn(D('Order')->listsAllOrder(session('manager.ma_id'),$page,$limit));
    }

    /**
     * 查看特定场所的预约单
     */
    public function listsSpeOrder($page = 1,$limit = 10){
        $this->checkManager()->reqPost(array('vi_id'));
        $data=I('post.');
        $data['ma_id']=session('manager.ma_id');
        $this->ajaxReturn(D('Order')->listsSpeOrder($data,$page,$limit));
    }

    /**
     * 显示未结的预约单
     */
    public function listsUndone($page = 1,$limit = 10){
        $this->checkManager();
        $this->ajaxReturn(D('Order')->listsUndone(session('manager.ma_id'),$page,$limit));
    }
}