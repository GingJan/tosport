<?php
namespace Home\Model;
use Think\Model;

class FriendModel extends Model{
    protected $_auto=array(
        array('add_time',NOW_TIME,3)
    );
    
    /**
     * 发送交友请求，对方接受后，才建立好友关系Todo
     */
    
    /**
     * 关注对方
     * @param array $data
     * @return json
     */
    public function addFriend($data){
        //判读是否已经添加改朋友
        //下面这条代码是在完成上面请求功能后才用
//         $res=$this->where("(me_id=%d AND friend_id=%d) OR (friend_id=%d AND me_id=%d)",$data['me_id'],$data['friend_id'],$data['me_id'],$data['friend_id'])->find();//need to fix
        $res=$this->where("me_id=%d AND friend_id=%d",$data['me_id'],$data['friend_id'])->find();
        if($res){
            return spt_json_error('已经关注该用户了');
        }
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('关注成功');
            }
            return spt_json_error('关注失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 删除关注
     * @param array $data
     * @return json
     */
    public function deleteFriend($data){
        if($this->where("f_id=%d AND me_id=%d",$data['f_id'],$data['me_id'])->delete()){
            return spt_json_success('取消关注成功');
        }
        return spt_json_error('取消关注失败');
    }
    
    /**
     * 列出我关注的人
     * @param string $me_id 本人u_id
     * @param $page 当前页
     * @param $limit 每页显示多少条数据
     * @return 
     */
    public function listsFriend($me_id,$page,$limit){
        if($page <= 0){
            $page = 1;
        }
        if($limit <= 0){
            $limit =15;
        }
        $res=$this->table("spt_user_info u,spt_friend f")
                 ->field("u.u_id,u.nickname,u.sex,u.avatar,u.region,f.f_id")
//                  ->where("(f.me_id=%d OR f.friend_id=%d) AND (u.u_id=f.friend_id OR u.u_id=f.me_id)",$me_id,$me_id)//取决于FriendModel的请求的完成才开启
                 ->where("f.me_id=%d AND u.u_id=f.friend_id",$me_id)
                 ->limit(($page-1)*$limit,$limit)
                 ->order('add_time desc')//以添加时间倒叙显示
                 ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('目前你还没关注其他人');
    }
}
