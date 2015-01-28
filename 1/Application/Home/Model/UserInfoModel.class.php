<?php
namespace Home\Model;

use Think\Model;
class UserInfoModel extends Model{
//     protected $_validate=array(
//         array('account','','',self::EXISTS_VALIDATE,'notequal',1),
//         array('account','require','b',self::EXISTS_VALIDATE,'unique',1)
//     );
    
    protected $_auto=array(
        array('ctime','time',1,'function'),
        array('cIP','getIP',1,'callback'),
        array('nickname','account',1,'field'),
        array('last_time','time',3,'function'),
        array('last_IP','getIP',3,'callback')

    );
    
    /**
     * 获取IP地址
     */
    protected function getIP($data){
        return $_SERVER['REMOTE_ADDR'];
    }
    
    /**
     * 检测是否正确填写性别
     */
//     protected function checkSex($sex){
//         if($sex == '男' || $sex == '女'){
//             return true;
//         }
//         return false;
//     }
    

    /**
     * UserInfo表 注册
     */
    public function register($data){
        if($this->create($data)){
            if($this->add()){
                return spt_json_success();
            }
//             $msg='注册发生错误'.$this->getDbError();
            return spt_json_error('注册发生错误!');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 更新个人信息 
     */
    public function updateInfo($data){
        $validate_rules=array(
            array('phone','11','电话格式不正确',2,'length',2),
            array('email','email','邮箱格式不正确',2,'regex',2)//邮箱
        );
        
       if($data['nickname'] == ''){
           $data['nickname'] = $data['account'];
       }
       
       if($this->validate($validate_rules)->create($data,2)){
           if($this->where("u_id=%d",$data['u_id'])->save()){
               return spt_json_success();
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
        $where="account='%s'";
        $res=$this->where($where,$account)->find();
//         $this->where("id=%d",$res['id'])->save($this->create($res,3));//create()是返回数据对象而不是$this,因此后面不能连贯操作save()/add()
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无此用户');
    }
}