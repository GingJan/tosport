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
     * 列出收到的私信
     */
    public function listsReceiveLetter($me_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_user_info u,spt_letter l")
                    ->field("l_id,sender_id,nickname as sender_nickname,content,send_time")
                    ->where("receiver_id=%d AND u.u_id=l.sender_id",$me_id)
                    ->order('send_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无收到私信');
    }
    
    /**
     * 列出发出的私信
     */
    public function listsSendLetter($me_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_user_info u,spt_letter l")
                    ->field("l_id,receiver_id,nickname as receiver_nickname,content,send_time")
                    ->where("sender_id=%d AND u.u_id=l.receiver_id",$me_id)
                    ->order('send_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无发出私信');
    }
}