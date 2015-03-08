<?php
namespace Common\Model;

use Common\Model\BaseModel;

class UserInfoModel extends BaseModel{
    protected $_validate=array(
        array('email','','邮箱不能为空',self::EXISTS_VALIDATE,'notequal',3),
        //array('email','/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',3)
        array('email','/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',3)//邮箱正则需要改进
    );
    
    protected $_auto=array(
        array('ctime',NOW_TIME,1),
        array('cIP','getIP',1,'callback'),
        array('nickname','account',1,'field'),
        array('last_time',NOW_TIME,1),
        array('last_IP','getIP',1,'callback'),
        array('last_time',NOW_TIME,4),//4代表登录时
        array('last_IP','getIP',4,'callback')
    );
    
    protected $readonlyField=array('account','ctime','cIP');
    
    /**
     * UserInfo表 注册
     */
    public function register($data){
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('注册成功');
            }
            return spt_json_error('注册发生错误!');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 附近的人
     */
    public function nearby($region,$page,$limit){
        $this->pageLegal($page, $limit);
        $res=$this->where("region='%s'",$region)
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('附近很冷清啊');
        
    }
    
    /**
     * 更新个人信息 
     */
    public function updateInfo($data){
        $validate_rules=array(
            array('phone','11','电话格式不正确',self::VALUE_VALIDATE,'length',5),//5代表更改时
            array('email','/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/','邮箱格式不正确',self::VALUE_VALIDATE,'regex',5)//邮箱
        );
       if($data['nickname'] === ''){
           $data['nickname'] = $data['account'];
       }
       if($data['email'] === ''){
           $data['email'] = session('user.email');
       }
       if($this->validate($validate_rules)->create($data,5)){
           if($this->where("u_id=%d AND account='%s'",$data['u_id'],$data['account'])->save()){
               return spt_json_success('更新资料成功！');
           }
           return spt_json_error('信息更改发生错误!');
       }
       return spt_json_error($this->getError());
    }
    
    /**
     * 获取登陆用户的基本信息
     * @param string $account
     */
    public function getUserInfo($account){
        $res=$this->where("account='%s'",$account)->find();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无此用户');
    }
    
    /**
     * 找回/忘记 密码
     */
    public function forgetPassword($email){
        if($this->where("email='%s'")->find()){
            $content="<b>你好，请点击以下链接找回密码</b><br/>";
            $content.="www.egerla.com/index.php/home/Index/test";
            if(sendEmail($email,'找回密码',$content)){
                return spt_json_success('发送成功,请到邮箱查找邮件');
            }
            return spt_json_error('发送失败，请重试');
        }
        return spt_json_error('此邮箱未注册');
    }
}