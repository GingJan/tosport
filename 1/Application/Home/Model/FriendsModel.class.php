<?php
namespace Home\Model;

use Think\Model;
class FriendsModel extends Model{
    protected $_validate=array(
        array('friend_account','accountExist','无此账号',self::MUST_VALIDATE,'callback',3),
        array('friend_account','myself','不能添加自己为朋友',self::MUST_VALIDATE,'callback',3),
        array('friend_account','','好友账号不能为空',self::MUST_VALIDATE,'notequal',3)
    );
    protected $_auto=array(
        array('add_time','time',3,'function')
    );
    
    /**
     * 判断是否存在该账号
     */
    protected function accountExist($account){
        if($this->table('spt_user_info')->where("account='%s'",$account)->find()){
            return true;
        }
        return false;
    }
    
    /**
     * 判断是否添加自己为好友
     */
    protected function myself($friend_account){
        if($friend_account == session('user.account')){
            return false;
        }
        return true;
    }
    /**
     * 添加朋友
     * @param array $data
     * @return json
     */
    public function addFriend($data){
        $res=$this->where("me_account='%s' AND friend_account='%s'",$data['me_account'],$data['friend_account'])->find();
        if($res){
            return spt_json_error('已经添加该朋友了');
        }
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('添加成功');
            }
            return spt_json_error('添加失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 删除好友关系
     * @param array $data
     * @return json
     */
    public function deleteFriend($data){
        if($this->where("f_id=%d AND me_account='%s'",$data['f_id'],$data['me_account'])->delete()){
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
    public function listsFriend($me_account,$page,$limit){
        $res=$this->table("spt_user_info u,spt_friends f")
                 ->field("u.u_id,u.nickname,u.sex,f.f_id,f.friend_account")
                 ->where("f.me_account='%s' AND u.account=f.friend_account",$me_account)
                 ->limit(($page-1)*$limit,$limit)
                 ->order('add_time desc')//以添加时间倒叙显示
                 ->select();
        return spt_json_success($res);
    }
}
