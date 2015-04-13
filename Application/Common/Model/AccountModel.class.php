<?php
namespace Common\Model;

use Common\Model\BaseModel;
class AccountModel extends BaseModel{
    protected $_validate=array(
        array('account','','账户不能为空',self::EXISTS_VALIDATE,'notequal',1),
        array('account','require','账户已经存在',self::EXISTS_VALIDATE,'unique',1),
        array('password','','密码不能为空',self::EXISTS_VALIDATE,'notequal',1),
        array('password','6,12','密码长度6~12',self::EXISTS_VALIDATE,'length',1),
        array('repassword','password','两次输入密码不一致',self::EXISTS_VALIDATE,'confirm',1), // 验证确认密码是否和密码一致
    );       
    
    protected $_auto=array(
        array('password','md5',3,'function')
    );
    
    protected $readonlyField=array('a_id','account');
    
    
    /**
     * Account表 注册
     */
    public function register($data){
        if($this->create($data,1)){
            if($this->add()){
                return spt_json_success('注册成功');
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
        $res=$this->field('password',true)->where($where,$data['account'],$data['password'])->find();
        if($res){
            session(array('session_id'=>session_id(),'expire'=>3600));//如果session方法的第一个参数传入数组则表示进行session初始化设置
            $userInfo=D('UserInfo');
            $info=$userInfo->getUserInfo($res['account']);
            session('user',$info['response']);
            $userInfo->where("u_id=%d",$info['response']['u_id'])->save($userInfo->create($info['response'],4));
            return spt_json_success('登陆成功!');
        }
        return spt_json_error('用户不存在或者密码错误!');
    }
    
    /**
     * 第三方登陆
     */
    public function thirdLogin($account){
        $res=$this->table('spt_user_info')
                    ->where("account='%s'",$account)
                    ->find();
        if($res){
            session(array('session_id'=>session_id(),'expire'=>3600));
            session('user',$res);
            return spt_json_success('登陆成功');
        }
        return spt_json_error('登陆失败');
    }
    
    /**
     * 修改密码
     */
    public function updatePassword($data){
        $validate_rules=array(
            array('password','','新密码不能为空',self::MUST_VALIDATE,'notequal',2),
            array('password','6,12','密码长度为6~12位',self::MUST_VALIDATE,'length',2),
            array('repassword','password','确认密码不一致，请重新输入',self::MUST_VALIDATE,'confirm',2) // 验证确认密码是否和密码一致
        );
        
        if($this->checkPassword($data['account'], $data['password'])){
            $res=$this->validate($validate_rules)->create(array('password'=>$data['newPassword'],'repassword'=>$data['repassword']),2);
            if($res){
                $this->where("account='%s'",$data['account'])->setField('password',$res['password']);
                return spt_json_success('密码修改成功!');
            }
            return spt_json_error($this->getError());
        }
        return spt_json_error('原密码错误!');
    }
    
    /**
     * 找回/忘记 密码
     */
    public function forgetPassword($email){
        $res=M('UserInfo')->field("u_id,account")->where("email='%s'",$email)->find();
        if($res){
            if(D('PinCode')->createPIN($res)){
                $account=$res['account'];
                $content="<b>你好，请点击以下链接找回密码</b><br/>";
                $content.="www.egerla.com/index.php/Home/User/judge?u=".$res['account']."&p=".$res['PIN_code'];
                if(sendEmail($email,'约运动找回密码',$content)){
                    return spt_json_success('发送成功,请到邮箱查找邮件');
                }
                return spt_json_error('发送失败，请重试');
            }
            return spt_json_error('发生错误，请重试');
        }
        return spt_json_error('此邮箱未注册');
    }
    
    /**
     * 找回密码-重设密码
     * @param mixed $data
     */
    public function resetPassword($data){
        $validate_rules=array(
            array('password','','密码不能为空',self::EXISTS_VALIDATE,'notequal',2),
            array('password','6,12','密码长度6~12',self::EXISTS_VALIDATE,'length',2),
            array('repassword','password','两次输入密码不一致',self::EXISTS_VALIDATE,'confirm',2)
        );
        $res=$this->validate($validate_rules)->create($data);
        if($res){
            if($this->where("account='%s'",$data['account'])->setField('password',$res['password'])){
                return spt_json_success('重设密码成功,请使用新密码登陆');
            }
            return spt_json_error('操作失败');
        }
        return spt_json_error($this->getError());
    }
    
    
}