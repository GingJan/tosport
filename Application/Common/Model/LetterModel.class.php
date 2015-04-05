<?php
namespace Common\Model;

use Common\Model\BaseModel;

class LetterModel extends BaseModel{
    protected $_validate=array(
        array('content','','私信内容不能为空',self::MUST_VALIDATE,'notequal',1),
        array('sender_id','require','必须有发送人id',self::MUST_VALIDATE,'regex',1),
        array('receiver_id','require','必须有接收者id',self::MUST_VALIDATE,'regex',1),
//         array('receiver_id','sender_id','不可发送给自己',self::MUST_VALIDATE,'notequal',1),
    );
    
    protected $_auto=array(
        array('send_time',NOW_TIME,1)
    );
    
    /**
     * 发送私信
     */
    public function send($data){
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('发送成功!');
            }
            return spt_json_error('发送失败!');
        }
        return spt_json_error($this->getError());
    }
    
    
    /**
     * 获取消息列表
     */
    public function getList($receiver_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $page=($page-1)*$limit;
        $res=$this->query("select ll.*,u.nickname as sender_nickname,u.avatar as sender_avatar from (select *,sum(!isread) unread_count from (select * from spt_letter where receiver_id=$receiver_id ORDER BY send_time DESC) l GROUP BY sender_id) ll,spt_user_info u where u.u_id=ll.sender_id ORDER BY send_time DESC limit $page,$limit");
//         $subset=$this->table("spt_user_info u,spt_letter l")
//                         ->field("l.l_id,l.sender_id,l.receiver_id,l.title,l.content,l.isread,l.send_time,u.nickname as sender_nickname,u.avatar as sender_avatar")
//                         ->where("receiver_id=%d AND u_id=sender_id",$receiver_id)
//                         ->order("send_time DESC")
//                         ->select(false);//只生成sql句，不执行
//         $res=$this->table($subset.' s')
//                     ->group("sender_id")
//                     ->limit(($page-1)*$limit,$limit)
//                     ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无私信');
    }
    
    
    /**
     * 获取与某人的对话记录
     */
    public function getRecord($data,$page,$limit){
//         var_dump($data);
//         exit;
        $this->pageLegal($page, $limit);
        $subsql=$this->table("spt_user_info u,spt_letter l")
                    ->field("l.l_id,l.receiver_id,u.nickname as receiver_nickname,u.avatar as receiver_avatar,l.title,l.content,l.isread,l.send_time,l.sender_id")
                    ->where("l.receiver_id=%d AND u.u_id=l.receiver_id AND l.isread=0",$data['receiver_id'])
                    ->order("l.send_time DESC")
                    ->limit(($page-1)*$limit,$limit)
                    ->select(false);
        $subsql=$subsql.' sl';
        $res=$this->table("$subsql,spt_user_info us")
                    ->field("sl.*,us.nickname as sender_nickname,us.avatar as sender_avatar")
                    ->where("sl.sender_id=%d AND us.u_id=sl.sender_id",$data['sender_id'])
                    ->select();
        $this->markRead($data['receiver_id'],$data['sender_id']);//标记为已读
//         var_dump();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无新消息');
    }
    
    /**
     * 标记已读
     */
    private function markRead($receiver_id,$sender_id){
        if($this->where("receiver_id=%d AND sender_id=%d AND isread=0",$receiver_id,$sender_id)->setField('isread',1)){
            return true;
        }
        return false;
    }
}