<?php
namespace Home\Model;

use Think\Model;

class LetterModel extends Model{
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
     * 列出所有的私信,包括收到的和发送的
     */
    public function listsAllLetter($me_id,$page,$limit){
        if($page <=0){
            $page = 1;
        }
        if($limit <= 0){
            $limit = 15;
        }
        $res=$this->where("sender_id=%d OR receiver_id=%d",$me_id,$me_id)
                    ->order('send_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无私信');
    }
}