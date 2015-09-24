<?php
namespace Common\Model;

use Common\Model\BaseModel;
class VenueInfoModel extends BaseModel{
    protected $_validate=array(
        array('people','','场馆最大允许预约人数不能为空',self::EXISTS_VALIDATE,'notequal',3),
        array('type','','提供的运动项目不能为空',self::EXISTS_VALIDATE,'notequal',3),
        array('price','','场馆价格不能为空',self::EXISTS_VALIDATE,'notequal',3),
        array('region','','场馆所在城市不能为空',self::EXISTS_VALIDATE,'notequal',1)
    );
    
    protected $_auto=array(
        array('last_time',NOW_TIME,3,'string'),
        array('last_IP','getIP',3,'callback'),
        array('is_ban',0,1,'string')
    );
    
    protected $readonlyField=array('vi_id','ma_id','name','bought','region');//该三字段是不允许修改的

    /*管理员*/
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
     * 关闭场馆
     */
    public function closeVenue($data) {
        return $this->where("ma_id=%d",$data['ma_id'])->save(array('is_ban'=>1))?
            spt_json_success('操作成功') : spt_json_error('操作失败');
    }

    /**
     * 开放场馆
     */
    public function openVenue($data){
        return $this->where("ma_id=%d",$data['ma_id'])->save(array('is_ban'=>0))?
            spt_json_success('操作成功') : spt_json_error('操作失败');
    }


    /**
     * 修改场馆信息
     */
    public function updateVenue($data){
        if($this->create($data)){
            if($this->where('ma_id=%d',$data['ma_id'])->save()){
                return spt_json_success('修改成功');
            }
            return spt_json_error('修改失败');
        }
        return spt_json_error($this->getError());
    }



    /**不开放
     * 删除场馆
     */
    public function deleteVenue($vi_id,$ma_id){
        if($this->where("vi_id=%d AND ma_id=%d",$vi_id,$ma_id)->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }

    /**不开放
     * 显示所有我创建的场馆
     */
    public function listsMyVenue($ma_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->where("ma_id=%d",$ma_id)
                    ->order('last_time DESC')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无');
    }
    
    /**不开放
     * 列出所有场馆,只提供给超级管理员使用
     */
    public function listsAllVenue($page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->order('last_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        return $res? spt_json_success($res) : spt_json_error('暂无场馆');
    }






    /*用户*/
    /**
     * 列出同城的场馆
     */
    public function listsCityVenue($region, $page=1, $limit=10) {
        $this->pageLegal($page,$limit);
        $res = $this->where("region='%s' AND is_ban=0",$region)
                    ->order('bought DESC')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        return $res? spt_json_success($res) : spt_json_error('暂无场馆');
    }



    /**暂不开放
     * 显示/搜索  某一场馆的基本信息
     */
    public function listsSpeVenue($data){
        if(isset($data['search'])){
            $res=$this->table("spt_venue_info")
                ->field('last_time,last_IP',true)
                ->where("name='%s'",$data['search'])
                ->find();
        }else{
            $res=$this->table("spt_venue_info")
                ->field('last_time,last_IP',true)
                ->where("vi_id=%d",$data['vi_id'])
                ->find();
        }
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无此场馆');
    }
}