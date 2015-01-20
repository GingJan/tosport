<?php
namespace Home\Model;

use Think\Model;
class AccountModel extends Model{
    protected $_validate=array(
        array('account','','Account can not be null',self::EXISTS_VALIDATE,'notequal',1),
        array('account','require','account has been existed',self::EXISTS_VALIDATE,'unique',1),
        array('password','','password can not be null',self::EXISTS_VALIDATE,'notequal',3),
        array('password','6,12','password length 6~12',self::EXISTS_VALIDATE,'length',3),
        array('repassword','password','The two passwords do not match, please re-enter',self::EXISTS_VALIDATE,'confirm',3), // 验证确认密码是否和密码一致
    );
    
    protected $_auto=array(
        array('password','md5',3,'function')
    );
    
    /**
     * 检测密码是否正确
     * @param string $account
     * @param string $password
     * @return boolean
     */
    protected function checkPassword($account,$password){
        if($this->where("account='%s' AND password='%s'",$account,$password)->find()){
            return true;
        }
        return false;
    }
    
    /**
     * Account表 注册
     */
    public function register($data){
        if($this->create($data)){
            if($this->add()){
                return spt_json_success();
            }
            return spt_json_error('注册发生错误!');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 登录
     */
    public function login($data){
        $where="account='%s' AND password='%s'";
        $res=$this->where($where,$data['account'],$data['password'])->find();
        if($res){
            session(array('session_id'=>session_id(),'expire'=>3600));//设置session过期的时间
            $userInfo=D('UserInfo');
            $info=$userInfo->getUserInfo($res);
            $info['a_id']=$res['a_id'];
            session('user',$info);
            $userInfo->where("u_id=%d",$info['u_id'])->save($userInfo->create($res));
            return spt_json_success('登陆成功!');
        }
        return spt_json_error('用户不存在或者密码错误!');
    }
    
    /**
     * 修改密码
     */
    public function updatePassword($data){
        $validate_rules=array(
            array('password','','新密码不能为空',self::MUST_VALIDATE,'notequal',3),
            array('password','6,12','密码长度为6~12位',self::MUST_VALIDATE,'length',3),
            array('repassword','password','确认密码不一致，请重新输入',self::MUST_VALIDATE,'confirm',3) // 验证确认密码是否和密码一致
        );
        
        if($this->checkPassword($data['account'], $data['password'])){
            $res=$this->validate($validate_rules)->create(array('password'=>$data['newPassword'],'repassword'=>$data['repassword']));
            if($res){
                $this->where("account='%s'",$data['account'])->setField('password',$res['password']);
                return spt_json_success('密码修改成功!');
            }
            return spt_json_error($this->getError());
        }
        return spt_json_error('原密码错误!');
    }
    
}