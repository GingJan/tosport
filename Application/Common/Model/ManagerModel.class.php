<?php
namespace Common\Model;

use Common\Model\BaseModel;
class ManagerModel extends BaseModel{
    protected $_validate=array(
        array('account','6,16','账户长度6-16',self::MUST_VALIDATE,'length',1),
        array('account','','账户已经存在',self::MUST_VALIDATE,'unique',1),
        array('password','','密码不能为空',self::EXISTS_VALIDATE,'notequal',3),
        array('password','6,12','密码长度6~12',self::EXISTS_VALIDATE,'length',3),
        array('nickname','','昵称不能为空',self::EXISTS_VALIDATE,'notequal',2),
        array('email','email','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',2),//5代表更新时
        array('phone','11','电话格式不正确',self::EXISTS_VALIDATE,'length',2)
    );
    
    protected $_auto=array(
        array('password','md5',1,'function'),
//        array('password','md5',5,'function'),
        array('create_time',NOW_TIME,1,'string'),
        array('create_IP','getIP',1,'callback'),
        array('nickname','account',1,'field'),
        array('is_ban',0,1,'string'),
        array('last_time',NOW_TIME,1,'string'),
        array('last_IP','getIP',1,'callback'),
    );
    
    //只读字段
    protected $readonlyField=array('ma_id','account','create_time','create_IP','parent_ma_id','role');
    
    /*超管*/
    /**
     * 管理员注册
     */
    public function createManager($data){
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('创建成功');
            }
            return spt_json_error('创建失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**不开放
     * 删除一管理员
     */
    public function deleteManager($ma_id){
        if($this->where("ma_id=%d",$ma_id)->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }

    /**
     * 禁用管理员（将同时禁用该管理员所创建的场馆和员工）
     */
    public function banManager($ma_id) {
        if($this->where('ma_id=%d OR parent_ma_id=%d',$ma_id,$ma_id)->save(array('is_ban'=>1))) {
            $this->table('spt_venue_info')->where("ma_id=%d",$ma_id)->save(array('is_ban'=>1));
            return spt_json_success('操作成功');
        }
        return spt_json_error('操作出错');
    }

    /**
     * 解封管理员
     */
    public function openManager($ma_id) {
        if($this->where('ma_id=%d OR parent_ma_id=%d',$ma_id, $ma_id)->save(array('is_ban'=>0))) {
            $this->table('spt_venue_info')->where('ma_id=%d', $ma_id)->save(array('is_ban'=>0));
            return spt_json_success('操作成功');
        }
        return spt_json_error('操作出错');
    }

    /**
     * 列出所有管理员
     */
    public function listsManager($page=1,$limit=10){
        $this->pageLegal($page, $limit);
        $res=$this->field(array('password'),true)
            ->where("role=1")
            ->order('create_time DESC')
            ->limit(($page-1)*$limit,$limit)
            ->select();
        return $res? spt_json_success($res) : spt_json_error('暂无数据');
    }

    /**不开放
     * 获取某管理员信息
     */
    public function getInfo($ma_id){
        $res=$this->field('password',true)->where('ma_id=%d',$ma_id)->find();
        if($res) {
            return spt_json_success($res);
        }
        return spt_json_error('无此管理员');
    }






    /*管理员*/
    /**
     * 创建员工
     */
    public function createStaff($data) {
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('创建成功');
            }
            return spt_json_error('创建失败');
        }
        return spt_json_error($this->getError());
    }

    /**不开放
     * 删除员工
     */
    public function deleteStaff($ma_id) {
        if($this->where("ma_id=%d",$ma_id)->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }

    /**
     * 禁用员工
     */
    public function banStaff($data) {
        if($this->where("ma_id=%d AND parent_ma_id=%d", $data['ma_id'], $data['parent_ma_id'])->save(array('is_ban'=>1))){
            return spt_json_success('操作成功');
        }
        return spt_json_error('操作失败');
    }

    /**
     * 解封员工
     */
    public function openStaff($ma_id) {
        if($this->where("ma_id=%d", $ma_id)->save(array('is_ban'=>0))) {
            return spt_json_success('操作成功');
        }
        return spt_json_error('操作失败');
    }

    public function listsStaff($ma_id,$page=1, $limit = 10) {
        $this->pageLegal($page,$limit);
        $res = $this->where("parent_ma_id=%d",$ma_id)->limit(($page-1)*$limit,$limit)->select();
        return $res? spt_json_success($res) : spt_json_error('暂无员工');
    }



    /*通用（超管、管理员、员工）*/
    /**
     * 登录
     */
    public function login($data){
        $res=$this->field(array('password'), true)->where("account='%s' AND password='%s'",$data['account'],$data['password'])->find();
        if($res['is_ban'] == 1){
            return spt_json_error('账户被禁用');
        }
        if($res){
            //如果session方法的第一个参数传入数组则表示进行session初始化设置
            session('user',$res);
            $this->where("ma_id=%d",$res['ma_id'])->save(array('last_time'=>NOW_TIME,'last_IP'=>get_client_ip()));
            return spt_json_success($res);
        }
        return spt_json_error('用户不存在或者密码错误!');
    }


    /**
     * 修改基本信息
     */
    public function updateInfo($data) {
//        var_dump($data);
//        exit;
        if($this->create($data,2)){
            if($this->where('ma_id=%d',$data['ma_id'])->save()) {
                return spt_json_success('更新成功');
            }
            return spt_json_error('无信息更新');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 修改密码
     */
    public function updatePassword($data){
        if(!$this->checkPassword($data['account'],$data['password'])){
            return spt_json_error('原密码错误');
        }
        if($this->where("account='%s'",$data['account'])->save(array('password'=>$data['newPassword']))) {
            return spt_json_success('修改密码成功');
        }
        return spt_json_error('修改密码失败');
    }
    

}