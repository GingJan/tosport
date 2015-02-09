<?php
namespace Common\Model;

class OrderModel extends BaseModel{
    /**
     * 查看预约单(只提供给管理员使用)
     */
    public function listsAllOrder($ma_id,$page,$limit){
        $this->pageLegal($page, $limit);//判断该两个参数是否合法
        $res=M('DateVenue')->where("ma_id=%d",$ma_id)
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
        $res=M('DateVenue')->where("vi_id=%d AND ma_id=%d",$data['vi_id'],$data['ma_id'])
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
        $res=M('DateVenue')->where("done is null AND ma_id=%d",$ma_id)
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
        if(M('DateVenue')->where("dv_id=%d AND done=1",$dv_id)->find()){
            return spt_json_error('结单失败，你已经结过单');
        }
        if(M('DateVenue')->where("dv_id=%d AND ma_id=%d",$dv_id,$ma_id)->setField('done',1)){
            return spt_json_success('结单成功');
        }
    }
}