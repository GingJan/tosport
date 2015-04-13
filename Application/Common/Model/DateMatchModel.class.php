<?php
namespace Common\Model;
use Common\Model\BaseModel;

class DateMatchModel extends BaseModel{
    protected $_validate=array(
        array('match_time',array(0,NOW_TIME),'运动时间不能早于发布时间',self::MUST_VALIDATE,'notbetween',1),
        array('people_amount',array(1,50),'人数必须在1~50人之间',self::MUST_VALIDATE,'between',1),
        array('content','0,140','附加内容不可超过140字',self::EXISTS_VALIDATE,'length',1)
    );
    
    protected $_auto=array(
        array('create_time',NOW_TIME,1)
    );
    
    
    /**
     * 创建一条约比赛
     */
    public function createDM($data){
        if(isset($_FILES['picture'])){
            $res=$this->PicUpload(2,'match','picture');
            if(isset($res['imgurl'])){
                $data['picture'] = $res['imgurl'];
            }else {
                return spt_json_error('图片上传失败');
            }
        }
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('发布成功！');
            }
            return spt_json_error('发布失败！');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 删除一条约比赛
     */
    public function deleteDM($dm_id,$creator_id){
        if($this->where("dm_id=%d AND creator_id=%d",$dm_id,$creator_id)->delete()){
            return spt_json_success('删除成功！');
        }
        return spt_json_error('删除失败！');
    }
    
    /**
     * 显示 指定某条约比赛
     */
    public function listsSpeDM($dm_id){
        $res=$this->table("spt_user_info u,spt_date_match dm")
                    ->field("dm_id,creator_id,nickname,avatar,match_type,match_place,match_time,content,people_amount,booked_amount,picture,create_time")
                    ->where("dm_id=%d AND u.u_id=dm.creator_id",$dm_id)
                    ->find();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('出现错误了');
    }
    
    /**
     * 显示同城最新的约比赛
     */
    public function listsCityDM($my_region,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_user_info u,spt_date_match dm")
                    ->field("dm_id,creator_id,nickname,avatar,match_type,match_place,match_time,content,people_amount,booked_amount,picture,create_time")
                    ->where("creator_region='%s' AND booked_amount<people_amount AND u.u_id=dm.creator_id",$my_region)
                    ->order('create_time DESC')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无比赛');
    }

    /**
     * 显示热门的约比赛
     */
    public function listsHotDM($my_region,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_user_info u,spt_date_match dm")
                    ->field("dm_id,creator_id,nickname,avatar,match_type,match_place,match_time,content,people_amount,booked_amount,picture,create_time")
                    ->where("creator_region='%s' AND u.u_id=dm.creator_id",$my_region)
                    ->order('booked_amount DESC')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无信息');
    }
    
    /**
     * 预约/取消预约
     */
    public function toDate($data){
        if($this->table("spt_match")->where("dm_id=%d AND me_id=%d",$data['dm_id'],$data['me_id'])->delete()){
            return spt_json_success('取消预约成功');
        }
        if($this->where("people_amount=booked_amount AND dm_id=%d",$data['dm_id'])->find()){
            return spt_json_error('预约人数已经满了');
        }
        $data['create_time']=NOW_TIME;
        if(M('Match')->data($data)){
            if(M('Match')->add()){
                return spt_json_success('预约比赛成功！');
            }
            return spt_json_error('预约比赛失败！');
        }
        return spt_json_error('出现问题了');
    }
    
    /**
     * 列出约我的人
     */
    public function listsDateGuy($creator_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_match m,spt_user_info u")
                    ->field("u.u_id,u.nickname,u.sex,u.avatar,m.dm_id,m.create_time")
                    ->where("m.creator_id=%d AND u.u_id=m.me_id",$creator_id)
                    ->order("m.create_time desc")
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无约');
    }
    
   /**
    * 列出我参加的比赛
    */
    public function listsJoin($me_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->table("spt_match m,spt_date_match dm")
                    ->field("dm.dm_id,dm.creator_id,dm.match_type,dm.match_place,dm.match_time,dm.content,dm.picture,m.create_time as joined_time")
                    ->where("m.me_id=%d AND dm.dm_id=m.dm_id",$me_id)
                    ->order("m.create_time desc")
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无约');
    }
    
}