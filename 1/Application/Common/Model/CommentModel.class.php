<?php
namespace Common\Model;

use Common\Model\BaseModel;

class CommentModel extends BaseModel{
    protected $_validate=array(
        array('content','','评论不能为空',self::EXISTS_VALIDATE,'notequal',1),
        array('sender_id','require','缺少发表者id',self::EXISTS_VALIDATE,'regex',1)
    );
    
    protected $_auto=array(
        array('send_time',NOW_TIME,1)
    );
    
    /**
     * 发送/回复 消息/评论动态
     */
    public function sendComment($data){
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('评论成功');//还需要返回其实数据，如点赞用户的名字或者内容吗？
            }
            return spt_json_error('评论失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 点/取消 赞
     */
    public function like($data){
        if($this->where("tl_id=%d AND sender_id=%d AND `like`=1",$data['tl_id'],$data['sender_id'])->delete()){//取消赞
            return  spt_json_success('取消赞成功');
        }
        $data['like']=1;
        if($this->data($data)){
            if($this->add()){
                return spt_json_success('点赞成功');//点赞
            }
            return spt_json_error('点赞失败');
        }
        return spt_json_error('点赞失败');
    }
    
    /**
     * 删除自己发的评论
     * @param int $c_id
     * @param int $me_id
     */
    public function deleteComment($c_id,$me_id){
        if($this->where("c_id=%d AND sender_id=%d",$c_id,$me_id)->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    
    /**
     * 显示所有收到的评论/赞
     * @param int $page 当前页数
     * @param int $limit 每页大小
     */
    public function listsAllComment($me_id,$page,$limit){
        $res=$this->table("spt_view_receive_comment")
                    ->where("c_sender_id=%d OR c_receiver_id=%d",$me_id,$me_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无评论');
    }
    
    /**
     * 获取指定动态的评论/赞
     * @param int $page 当前页数
     * @param int $limit 每页大小
     */
    public function listsSpeComment($data,$page,$limit){
        $res=$this->table("spt_view_receive_comment")
                    ->where("(c_sender_id=%d OR c_receiver_id=%d) AND tl_id=%d",$data['me_id'],$data['me_id'],$data['tl_id'])//need to fix
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无评论');
    }
}