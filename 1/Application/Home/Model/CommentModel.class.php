<?php
namespace Home\Model;

use Think\Model;
class CommentModel extends Model{
    /**
     * 收到消息的列表
     * @param int $page 当前页数
     * @param int $limit 每页大小
     */
    public function listsReceiveComment($me_id,$page,$limit){
        $res=$this->table("spt_receive_Comment")
                    ->field("rm_id,sender_id,content")
                    ->where("me_id=%d",$me_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->order('receive_time desc')//以收到的时间倒叙显示
                    ->select();
        return spt_json_success($res);
    }
    
    /**
     * 发送消息的列表
     */
    public function listsSendComment($me_id,$page,$limit){
        $res=$this->table("spt_send_Comment")
                    ->field("sm_id,receiver_id,content")
                    ->where("me_id=%d",$me_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->order('send_time desc')//以发送的时间倒叙显示
                    ->select();
        return spt_json_success($res);
    }
}