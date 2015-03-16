<?php
namespace Common\Model;
use Common\Model\BaseModel;

class DateMatchModel extends BaseModel{
    protected $_validate=array(
        array('match_time',array(0,NOW_TIME),'运动时间不能早于发布时间',self::MUST_VALIDATE,'notbetween',1),
        array('people_amount',array(1,50),'人数必须在1~50人之间',self::MUST_VALIDATE,'between',1),
        array('content','0,140','附加内容不可超过140字',self::MUST_VALIDATE,'length',1)
    );
    
    protected $_auto=array(
        array('create_time',NOW_TIME,1)
    );
    
    
    /**
     * 创建一条约比赛
     */
    public function createDM($data){
        if($data['content'] === ''){
            $data['content'] = $data['match_type'];
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
        $res=$this->where("dm_id=%d",$dm_id)->find();
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
        $res=$this->field('creator_region',true)
                    ->where("creator_region='%s' AND booked_amount<people_amount",$my_region)
                    ->order('create_time desc')
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
        $res=$this->field('creator_region',true)//除了这个字段不返回外，其他字段都返回
                    ->where("creator_region='%s'",$my_region)
                    ->order('booked_amount desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无信息');
    }
    
    /**
     * 约ta
     */
    public function dateIt($data){
        if($data['me_id'] === $data['creator_id']){
            return spt_json_error('不能与自己比赛');
        }
        $res=$this->field('people_amount,booked_amount')->where("dm_id=%d",$data['dm_id'])->find();
        if($res['people_amount'] === $res['booked_amount']){
            return spt_json_error('预约人数已经满了');
        }
        $data['create_time']=NOW_TIME;
        if(M('Match')->data($data)){
            if(M('Match')->add()){
                return spt_json_success('比赛预约成功！');
            }
            return spt_json_error('比赛预约失败！');
        }
        return spt_json_error($this->getDbError());
    }
    
    /**
     * 取消预约
     */
    public function cancelDate($data){
        if(M('Match')->where("dm_id=%d AND me_id=%d",$data['dm_id'],$data['me_id'])->delete()){
            return spt_json_success('取消成功');
        }
        return spt_json_error('取消失败');
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
                    ->field("dm.creator_region,dm.create_time,m.mt_id,m.dm_id,m.creator_id",true)
                    ->where("m.me_id=%d",$me_id)
                    ->order("m.create_time desc")
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无约');
    }
    
}