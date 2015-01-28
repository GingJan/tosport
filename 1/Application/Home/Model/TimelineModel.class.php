<?php
namespace Home\Model;

use Think\Model;
class TimelineModel extends Model{
    protected $_validate=array(
        array('content','','content could not be null',self::EXISTS_VALIDATE,'notequal',1),
        array('content','1,140','content length less-than 140',self::EXISTS_VALIDATE,'length',1)
    );
    
    protected $_auto=array(
        array('create_time','time',1,'function')
    );
    
    /**
     * 发表一条 说说
     */
    public function send($data){
        if($res=$this->create($data)){//这里如果没有$data参数会出问题，sender_id字段会不见
            if($this->add()){
                return spt_json_success('发表成功');
            }
            return spt_json_error('发表失败');
        }
        return spt_json_error($this->getError()); 
    }
    
    /**
     * 删除一条动态 
     */
    public function deleteTimeline($data){
        if($this->where("tl_id=%d AND sender_id=%d",$data['tl_id'],$data['sender_id'])->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    /**
     * 列出我发的动态
     */
    public function listsMyTimeline($me_id,$page,$limit){
        $res=$this->field("tl_id,content,create_time")
                    ->where("sender_id=%d",$me_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->order('create_time desc')//以发表发表时间倒叙显示
                    ->select();
        if($res){
           return spt_json_success($res);
        }
        return spt_json_error('目前你还没发过动态');
    }
    
    /**
     * 列出所有朋友的动态
     */
    public function listsAllTimeline($me_id,$page,$limit){
        $res=$this->table("spt_view_all_timeline at,spt_friend f")//这张表用View做
                    ->field("at.u_id,at.nickname,at.avatar,at.tl_id,at.content,at.like")
                    ->where("f.me_id=%d AND at.sender_id=f.friend_id",$me_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->order('at.create_time desc')
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error($this->getDbError());
    }
    
    /**
     * 列出同城用户的动态
     */
//     public function listsCityTimeline($me_id,$page,$limit){
//         $res=$this->table("spt_view_all_timeline at")
//                    ->field("at.u_id,at.nickname,at.avatar,at.sex,at.tl_id,at.sender_id,at.content,at.like")
//                    ->where("at.region='%s'",$me_region)
//     }
}