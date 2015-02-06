<?php
namespace Admin\Model;

use Common\Model\BaseModel;

class VenueInfoModel extends BaseModel{
    protected $_validate=array(
        array('name','','场馆名称不能为空',self::MUST_VALIDATE,'notequal',1),
        array('type','','提供的运动项目不能为空',self::MUST_VALIDATE,'notequal',3),
        array('price','','场馆价格不能为空',self::MUST_VALIDATE,'notequal',3),
        array('region','','场馆所在城市不能为空',self::MUST_VALIDATE,'notequal',1)
    );
    
    protected $_auto=array(
        array('last_time',NOW_TIME,3),
        array('last_IP','getIP',3,'callback')
    );
    
    /**
     * 创建一场馆
     */
    public function createVenue($data){
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('创建成功');
            }
            return spt_json_error('创建失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 删除场馆
     */
    public function deleteVenue($vi_id,$ma_id){
        if($this->where("vi_id=%d AND ma_id=%d",$vi_id,$ma_id)->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    /**
     * 显示所有我创建的场馆
     */
    public function listsMyVenue($ma_id,$page,$limit){
        if($page <= 0){
            $page = 1;
        }
        if($limit <=0){
            $limit =10;
        }
        $res=$this->where("ma_id=%d",$ma_id)
                    ->order('last_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无');
    }
    
    /**
     * 列出所有场馆,只提供给超级管理员使用
     */
    public function listsAllVenue($page,$limit){
        if($page <= 0){
            $page = 1;
        }
        if($limit <=0){
            $limit =10;
        }
        $res=$this->order('last_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无');
    }
    
}