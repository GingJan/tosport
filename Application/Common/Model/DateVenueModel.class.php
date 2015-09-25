<?php
namespace Common\Model;

use Common\Model\BaseModel;

class DateVenueModel extends BaseModel{
    protected $_validate=array(
        array('date_time',array(0,NOW_TIME),'预约时间不能早于下单时间',self::MUST_VALIDATE,'notbetween',1)
    );
    
    protected $_auto=array(
        array('order_time',NOW_TIME,1,'string'),
        array('done',0,1,'string')
    );
    
    /*用户*/
    /**
     * 约该场馆
     */
    public function date($data){
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('预约成功');
            }
            return spt_json_error('预约失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 取消预约（可以同上面合并）
     */
    public function cancelDate($data){
        return $this->where("dv_id=%d AND subscriber=%d",$data['dv_id'],$data['subscriber'])->delete()?
            spt_json_success('取消成功') : spt_json_error('取消失败');
    }

    /**
     * 取消和预约
     */
    public function toggleData($data) {
        if($this->where("subscriber=%d AND vi_id=%d",$data['subscriber'],$data['vi_id'])->delete()) {
            return spt_json_success('取消成功');
        }
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('预约成功');
            }
            return spt_json_error('预约失败');
        }
        return spt_json_error($this->getError());
    }

    /**
     * 显示我预约的场馆
     */
    public function listsDate($subscriber,$page=1,$limit=10) {
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_date_venue dv,spt_venue_info vi")
                    ->field("dv.dv_id,dv.subscriber,dv.vi_id,dv.date_time,dv.order_time,vi.ma_id,vi.name")
                    ->where("dv.subscriber=%d AND vi.vi_id=dv.vi_id",$subscriber)
                    ->order('dv.order_time DESC')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        return $res? spt_json_success($res) : spt_json_error('暂无预约');
    }


    /*员工*/
    /**
     * 查看预约订单列表
     */
    public function listBooking($ma_id, $page=1, $limit=10) {
        $this->pageLegal($page,$limit);
        $res = $this->where("ma_id=%d",$ma_id)
                    ->order('order_time DESC')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        return $res? spt_json_success($res) : spt_json_error('暂无数据');
    }

    /**
     * 显示某一订单的详细信息
     */
    public function listOrderDetail($data){
        $res = $this->table('spt_date_venue dv,spt_user_info ui')
                    ->where("dv.ma_id=%d AND dv.dv_id=%d AND ui.u_id=dv.subscriber",$data['ma_id'],$data['dv_id'])
                    ->find();
        unset($res['account'],$res['u_id'],$res['avatar']);
        return $res? spt_json_success($res) : spt_json_error('暂无数据');
    }


    /**
     * 结单(员工)
     */
    public function doneOrder($data){
        return $this->where("dv_id=%d AND ma_id=%d",$data['dv_id'],$data['ma_id'])->save(array('done'=>1))?
            spt_json_success('操作成功') : spt_json_error('操作失败');
    }


    /**
     * 自动处理过期无效的订单
     * TODO
     */
    
    
}