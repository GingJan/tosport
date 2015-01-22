<?php
namespace Home\Model;

use Think\Model;
class TimelineModel extends Model{
//     protected $_validate=array(
//         array('')
//     );
    
    protected $_auto=array(
        array('create_time','time',3,'function')
    );
    
    /**
     * 发表一条 说说
     * 
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
     * 删除一条动态 
     */
    public function deleteTimeline($tl_id){
        if($this->where("tl_id=%d",$tl_id)->delete()){
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
        return spt_json_success($res);
    }
    
    /**
     * 列出所有朋友的动态
     */
    public function listsAllTimeline($me_id,$page,$limit){
        $res=$this->table("spt_timeline tl,spt_friend f")
                    ->field("tl.tl_id,tl.content,tl.create_time,f_")
                    ->where("f.me_id=%d AND tl.sender_id=f.",)
        ->field("")
        
    }
}