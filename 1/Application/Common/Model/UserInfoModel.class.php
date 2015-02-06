<?php
namespace Common\Model;

use Common\Model\BaseModel;

class UserInfoModel extends BaseModel{
    protected $_validate=array(
        array('email','','邮箱不能为空',self::MUST_VALIDATE,'notequal',1),
        //array('email','/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',3)
        array('email','email','邮箱格式不正确',self::MUST_VALIDATE,'regex',1)//邮箱正则需要改进
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
//             $msg='注册发生错误'.$this->getDbError();
            return spt_json_error('注册发生错误!');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 附近的人
     */
    public function nearby($region,$page,$limit){
        if($page <= 0){
            $page = 1;
        }
        if($limit <= 0){
            $limit =10;
        }
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
            array('email','email','邮箱格式不正确',self::VALUE_VALIDATE,'regex',5)//邮箱
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
//         $this->where("id=%d",$res['id'])->save($this->create($res,3));//create()是返回数据对象而不是$this,因此后面不能连贯操作save()/add()
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('无此用户');
    }
}