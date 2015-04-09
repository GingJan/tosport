<?php
namespace Common\Model;

class GroupInfoModel extends BaseModel{
    protected $_validate=array(
        array('group_account','6,12','群组账号长度为6-12',self::MUST_VALIDATE,'length',1),
        array('group_account','require','该群组账号已存在',self::MUST_VALIDATE,'unique',1),
        array('name','6,12','群组的名称长度为6-12',self::MUST_VALIDATE,'length',3),
        array('name','require','该名称已经有了',self::MUST_VALIDATE,'unique',3),
        array('people',array(1,100),'群组的总人数为1-100人',self::MUST_VALIDATE,'between',3),
        array('people','isInteger','总人数应该为整数',self::MUST_VALIDATE,'callback',3),
        array('intro','1,140','群组简介应该在1-140字',self::VALUE_VALIDATE,'length',3)
    );
    
    protected $_auto=array(
        array('create_time',NOW_TIME,1)
    );
    
    protected $readonlyField=array('group_account','creator_id','joined','create_time','region');
    /**
     * 创建群组
     */
    public function createGroup($data){//创建了群组后，要把该创建人加入到GroupPerson表中
        if(isset($_FILES['picture'])){
            $res=$this->PicUpload(2,'group','picture');
            if(isset($res['imgurl'])){
                $data['picture'] = $res['imgurl'];
            }else {
                return spt_json_error('图片上传失败');
            }
        }
        if($this->create($data,1)){
            if($gi_id=$this->add()){
                $res=D('GroupPerson')->joinGroup(array('gi_id'=>$gi_id,'associator_id'=>$data['creator_id'],'power'=>2));
                if(isset($res['code'])){
                    return spt_json_success('创建成功');
                }
            }
            return spt_json_error('创建失败，请重试');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 查看我创建的群组
     */
    public function listsGroup($creator_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->field('')
                    ->where("creator_id=%d",$creator_id)
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无群组');
    }
    
    /**
     * 删除一群组
     */
    public function deleteGroup($gi_id,$creator_id){
        if($this->where("gi_id=%d AND creator_id=%d",$gi_id,$creator_id)->delete()){
            M('GroupPerson')->where("gi_id=%d",$gi_id)->delete();
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    /**
     * 更新群组信息
     */
    public function updateGroup($data){
        if(!$this->where("gi_id=%d AND creator_id=%d",$data['gi_id'],$data['creator_id'])){
            return spt_json_error('你不是该群组的创建人，无法修改群组信息');
        }
        if($this->create($data,2)){
            if($this->where("gi_id=%d",$data['gi_id'])->save()){
                return spt_json_success('更新成功');
            }
            return spt_json_error('更新失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 获取某群组的信息
     */
    public function getGroupInfo($gi_id){
        $res=$this->where("gi_id=%d",$gi_id)->find();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无此群组');
    }
    
}