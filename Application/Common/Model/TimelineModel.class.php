<?php
namespace Common\Model;

use Common\Model\BaseModel;
class TimelineModel extends BaseModel{
    protected $_validate=array(
        array('content','','内容不能为空',self::EXISTS_VALIDATE,'notequal',1),
        array('content','1,140','内容长度不能超过140字',self::EXISTS_VALIDATE,'length',1)
    );
    
    protected $_auto=array(
        array('create_time',NOW_TIME,1)
    );
    
    /**
     * 发表一条 动态
     */
    public function send($data){
        if($this->create($data)){//这里如果没有$data参数会出问题，sender_id字段会不见
            if($this->add()){
                return spt_json_success('发表成功');
            }
            return spt_json_error('发表失败');
        }
        return spt_json_error($this->getError()); 
    }
    
    /**
     * 删除一条动态 同时会删除相关的评论
     */
    public function deleteTimeline($data){
        if($this->where("tl_id=%d AND sender_id=%d",$data['tl_id'],$data['sender_id'])->delete()){
            M('Comment')->where("tl_id=%d",$data['tl_id'])->delete();
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    /**
     * 显示某个人的动态
     */
    public function listsSpeTimeline($sender_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_timeline tl,spt_user_info u")
                    ->field("tl.tl_id,tl.sender_id,tl.content,tl.create_time,tl.c_amount,u.u_id,u.nickname,u.avatar")
                    ->where("tl.sender_id=%d AND u.u_id=tl.sender_id",$sender_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->order('create_time desc')//以发表发表时间倒叙显示
                    ->select();
        if($res){
           return spt_json_success($res);
        }
        return spt_json_error('目前你还没发过动态');
    }
    
    /**
     * 列出我关注的人的动态（包含我的动态）
     */
    public function listsAllTimeline($me_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_user_info u,spt_timeline t,spt_friend f")
                    ->distinct(true)//与下面的field('f.me_id')字段一起使用，即数据集排除f.me_id字段中重复的的记录
                    ->field("f.me_id")
                    ->field("u.u_id,u.nickname,u.avatar,t.tl_id,t.sender_id,t.content,t.c_amount,t.create_time")
                    //->where("(f.me_id=%d AND at.sender_id=f.friend_id) OR (f.friend_id=%d AND at.sender_id=f.me_id)",$me_id,$me_id)//取决于FriendModel的请求的完成才开启
                    ->where("u.u_id=t.sender_id AND f.me_id=%d AND (t.sender_id=f.friend_id OR t.sender_id=%d)",$me_id,$me_id)
                    ->order("t.create_time DESC")
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error($this->getDbError());
    }
    
    /**
     * 列出同城用户的动态
     */
    public function listsCityTimeline($now_region,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_user_info u,spt_timeline t")
                   ->where("u.u_id=t.sender_id AND t.now_region='%s'",$now_region)
                   ->order("t.create_time desc")
                   ->limit(($page-1)*$limit,$limit)
                   ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error($this->getDbError());
    }
}