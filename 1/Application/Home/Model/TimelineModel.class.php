<?php
namespace Home\Model;

use Think\Model;
class TimelineModel extends Model{
    protected $_validate=array(
        array('')
    );
    
    protected $_auto=array(
        array('create_time','time',3,'function')
    );
    
    /**
     * 发表一条 说说
     * 
     */
    public function send($data){
        if($this->create()){
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
    public function delete($t_id){
        if($this->where("t_id=%d",$t_id)->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    /**
     * 列出我发的动态
     */
    public function listsMy($me_id,$page,$limit){
        $this->where('');
    }
    
    /**
     * 列出所有朋友的动态
     */
    public function listsAll(){
        
    }
}