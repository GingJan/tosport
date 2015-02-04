<?php
namespace Admin\Model;

use Common\Model\BaseModel;
class ManagerModel extends BaseModel{
    protected $_validate=array(
        array('account','','账户不能为空',self::MUST_VALIDATE,'notequal',1),
        array('account','require','账户已经存在',self::MUST_VALIDATE,'unique',1),
        array('password','','密码不能为空',self::EXISTS_VALIDATE,'notequal',3),
        array('password','6,12','密码长度6~12',self::EXISTS_VALIDATE,'length',3),
        array('repassword','password','两次输入密码不一致',self::EXISTS_VALIDATE,'confirm',3), // 验证确认密码是否和密码一致
        array('email','email','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',5),//5代表更新时
        array('phone','11','电话格式不正确',self::EXISTS_VALIDATE,'length',5)
    );
    
    protected $_auto=array(
        array('password','md5',1,'function'),
        array('password','md5',5,'function'),
        array('create_time',NOW_TIME,1),
        array('create_IP','getIP',1,'callback'),
        array('nickname','account',1,'field'),
        array('last_time',NOW_TIME,1),
        array('last_IP','getIP',1,'callback'),
        array('last_time',NOW_TIME,4),//4代表登录时
        array('last_IP','getIP',4,'callback')
    );
    
    //只读字段
    protected $readonlyField=array('create_time','create_IP','account');
    
    
    /**
     * 管理员注册（只限于超级管理员使用）
     */
    public function register($data){
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('注册成功');
            }
            return spt_json_error('注册失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 删除一管理员(只限于超级管理员使用)
     */
    public function deleteManager($ma_id){
        if($ma_id == 1){
            return spt_json_error('不能删除超级管理员');
        }
        if($this->where("ma_id=%d",$ma_id)->delete()){
            return spt_json_success('删除成功');
        }
        return spt_json_error('删除失败');
    }
    
    /**
     * 管理员登录(包括超级管理员)
     */
    public function login($data){
        $res=$this->field('password',true)->where("account='%s' AND password ='%s'",$data['account'],$data['password'])->find();
        if($res){
            session(array('session_id'=>session_id(),'expire'=>3600));//如果session方法的第一个参数传入数组则表示进行session初始化设置
            session('manager',$res);
            $res=$this->field('last_time,last_IP')->where("ma_id=%d",$res['ma_id'])->save($this->create($res,4));
            return spt_json_success('登录成功！');
        }
        return spt_json_error('用户不存在或者密码错误!');
    }
    
    /**
     * 修改基本信息(包括超级管理员) 
     */
    public function updateInfo($data){
        if($data['nickname'] === ''){
           $data['nickname'] = session('manager.account');
        }
        if($this->create($data,5)){
            if($this->where('ma_id=%d',$data['ma_id'])->setField($data)){
                return spt_json_success('更新成功！');
            }
            return spt_json_error('更新失败！');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 修改密码
     */
    public function updatePassword($data){
        if(!$this->checkPassword($data['account'], $data['password'])){
            return spt_json_error('你的原密码错误');
        }
        if($this->create(array('password'=>$data['newPassword'],'repassword'=>$data['repassword']),5)){
            if($this->where("account='%s'",$data['account'])->save()){
                return spt_json_success('修改密码成功');
            }
            return spt_json_error('修改密码失败');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 列出所有管理员
     */
    public function listsManager($page,$limit){
        if($page <= 0){
            $page = 1;
        }
        if($limit <=0){
            $limit =10;
        }
        $res=$this->field('password',true)
                    ->order('create_time desc')
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('暂无数据');
    }
    
    
}