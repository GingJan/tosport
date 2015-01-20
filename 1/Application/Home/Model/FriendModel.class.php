<?php
namespace Home\Model;
use Think\Model;

class FriendModel extends Model{
    protected $_auto=array(
        array('add_time','time',3,'function')
    );
    
    /**
     * 添加朋友
     * @param array $data
     * @return json
     */
    public function addFriend($data){
        //判读是否已经添加改朋友
        $res=$this->where("me_id=%d AND friend_id=%d",$data['me_id'],$data['friend_id'])->find();
        if($res){
            return spt_json_error('已经添加该朋友了');
        }
        
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('添加成功');
            }
            return spt_json_error('添加出错');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 删除好友关系
     * @param array $data
     * @return json
     */
    public function deleteFriend($data){
        if($this->where("f_id=%d AND me_id=%d",$data['f_id'],$data['me_id'])->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    /**
     * 列出已加的好友
     * @param string $me_account 本人账号
     * @param $page 当前页
     * @param $limit 每页显示多少条数据
     * @return 
     */
    public function listsFriend($me_id,$page,$limit){
        $res=$this->table("spt_user_info u,spt_friend f")
                 ->field("u.u_id,u.nickname,u.sex,f.f_id")
                 ->where("f.me_id=%d AND u.u_id=f.friend_id",$me_id)
                 ->limit(($page-1)*$limit,$limit)
                 ->order('add_time desc')//以添加时间倒叙显示
                 ->select();
        return spt_json_success($res);
    }
}
