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
     * 列出所有的私信,包括收到的和发送的
     */
    public function listsAllLetter($me_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res1=$this->table("spt_user_info u,spt_letter l")
                    ->field("l_id,sender_id,nickname as sender_nickname,receiver_id,nickname as receiver_nickname,content,send_time")
                    ->where("sender_id=%d AND u.u_id=l.sender_id OR u.u_id=l.receiver_id",$me_id)
                    ->order('send_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        $res2=$this->table("spt_user_info u,spt_letter l")
                    ->field("receiver_id,nickname as receiver_nickname,content,send_time")
                    ->where("receiver_id=%d AND u.u_id=l.receiver_id",$me_id)
                    ->order('send_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
//         $res=array_merge($res1,$res2);
        if($res1){
//             foreach ($res1 as $key => $value){
//                 echo $key.'=>'.$value;
//             }
//             var_dump($res);
//             exit;
            return spt_json_success($res1);
        }
        return spt_json_error('暂无私信');
    }
}