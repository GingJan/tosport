<?php
namespace Common\Model;

use Common\Model\BaseModel;

class DateVenueModel extends BaseModel{
    protected $_validate=array(
        array('date_time',array(0,NOW_TIME),'预约时间不能早于下单时间',self::MUST_VALIDATE,'notbetween',1)
    );
    
    protected $_auto=array(
        array('order_time',NOW_TIME,1)
    );
    
    /**
     * 显示某一场馆的基本信息
     */
    public function listsSpeVenue($vi_id){
        $res=$this->table("spt_venue_info")
                    ->field('last_time,last_IP',true)
                    ->where("vi_id=%d",$vi_id)
                    ->find();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无此场馆');
    }
    
    /**
     * 显示所有的场馆(均为同城场馆)
     */
    public function listsCityVenue($region,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_venue_info")
                    ->field('last_time,last_IP',true)
                    ->where("region='%s'",$region)
                    ->order('bought desc')
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无此场馆');
    }
    
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
     * 取消预约
     */
    public function cancelDate($dv_id,$subscriber){
        if($this->where("dv_id=%d AND subscriber=%d",$dv_id,$subscriber)->delete()){
            return spt_json_success('取消成功');
        }
        return spt_json_error('取消失败');
    }
    
    /**
     * 显示我预约的场馆
     */
    public function listsDate($subscriber,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_date_venue dv,spt_venue_info vi")
                    ->field("dv.dv_id,dv.subscriber,dv.vi_id,dv.date_time,dv.order_time,vi.ma_id,vi.name,vi.bought,vi.price")
                    ->where("dv.subscriber=%d AND vi.vi_id=dv.vi_id",$subscriber)
                    ->order('dv.order_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无场馆');
    }
    
    /**
     * 查看预约单(只提供给管理员使用)
     */
    public function listsAllOrder($ma_id,$page,$limit){
        $this->pageLegal($page, $limit);//判断该两个参数是否合法
        $res=$this->where("ma_id=%d",$ma_id)
                    ->order('order_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无预约单');
    }
    
    /**
     * 显示某一场馆的预约单(只提供给管理员使用)
     */
    public function listsSpeOrder($data,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->where("vi_id=%d AND ma_id=%d",$data['vi_id'],$data['ma_id'])
                    ->order('order_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无法查看该场所的信息');
    }
    
    /**
     * 显示未结的预约单(只提供给管理员使用)
     */
    public function listsUndone($ma_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->where("done is null AND ma_id=%d",$ma_id)
                    ->order('order_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无未结预约单');
    }
    
    /**
     * 结单(只提供给管理员使用)
     */
    public function doneOrder($dv_id,$ma_id){
        if($this->where("dv_id=%d AND done=1",$dv_id)->find()){
            return spt_json_error('结单失败，你已经结过单');
        }
        if($this->where("dv_id=%d AND ma_id=%d",$dv_id,$ma_id)->setField('done',1)){
            return spt_json_success('结单成功');
        }
    }
}