<?php
namespace Common\Model;

class GroupPersonModel extends BaseModel{
    
    protected $_auto=array(
        array('join_time',NOW_TIME,1)
    );
    
    /**
     * 加入群组 
     */
    public function joinGroup($data){
        if($this->where("gi_id=%d AND associator_id=%d",$data['gi_id'],$data['associator_id'])->find()){
            return spt_json_error('你已加入该群组了');
        }
        if($this->table('spt_group_info gi')->where("gi_id=%d AND people>joined",$data['gi_id'])){
            return spt_json_error('该群组人数已满');
        }
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('成功加入该群组');
            }
            return spt_json_error('出错了');
        }
        return spt_json_error('出问题了');
    }
    
    /**
     * 退出群组
     */
    public function quitGroup($gi_id,$associator_id){
        if($this->where("gi_id=%d AND associator_id=%d",$gi_id,$associator_id)->delete()){
            return spt_json_success('退出成功');
        }
        return spt_json_error('退出失败');
    }
    
    /**
     * 显示我加入的群组
     */
    public function listsJoinGroup($associator_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->where('associator_id=%d',$associator_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('还未加入任务群组');
    }
    
    /**
     * 显示加入群组的成员
     */
    public function listsAssociator($gi_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->where("gi_id=%d",$gi_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无成员');
    }
    
    
    /**
     * 设置群组成员的权限(设置某成员为管理员)
     */
    public function grantPower($data){
        if(M('GroupInfo')->where("gi_id=%d AND creator_id=%d",$data['gi_id'],$data['creator_id'])->find()){
            if($this->where("gi_id=%d AND associator_id=%d",$data['gi_id'],$data['associator_id'])->setField('power',1)){
                return spt_json_success('设置成功');
            }
            return spt_json_error('设置失败，请重试');
        }
        return spt_json_error('你不是群组创建人，无法设置权限');
    }
    
    /**
     * 撤销某群组管理员的权限
     */
    public function revokePower($data){
        if(M('GroupInfo')->where("gi_id=%d AND creator_id=%d",$data['gi_id'],$data['creator_id'])->find()){
            if($this->where("gi_id=%d AND associator_id=%d",$data['gi_id'],$data['associator_id'])->setField('power',0)){
                return spt_json_success('撤销成功');
            }
            return spt_json_error('撤销失败，请重试');
        }
        return spt_json_error('你不是群组创建人，无法撤销权限');
    }
    
}