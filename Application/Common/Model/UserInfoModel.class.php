<?php
namespace Common\Model;

use Common\Model\BaseModel;

class UserInfoModel extends BaseModel{
    protected $_validate=array(
        array('email','','邮箱不能为空',self::EXISTS_VALIDATE,'notequal',1),
        //array('email','/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',3)
        array('email','/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',3),//邮箱正则需要改进
        array('phone','11','电话格式不正确',self::VALUE_VALIDATE,'length',2)//2代表编辑数据时
    );
    
    protected $_auto=array(
        array('ctime',NOW_TIME,1),
        array('cIP','getIP',1,'callback'),
        array('last_time',NOW_TIME,1),
        array('last_IP','getIP',1,'callback'),
        array('region','江门',1,'string'),
//         array('nickname','account',1,'field'),
        array('last_time',NOW_TIME,4),//4代表登录时
        array('last_IP','getIP',4,'callback')
    );
    
    protected $readonlyField=array('account','ctime','cIP');
    
    /**
     * UserInfo表 注册
     */
    public function register($data){
        $data['nickname']=$data['account'];
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('注册成功');
            }
            return spt_json_error('注册发生错误!');
        }
        return spt_json_error($this->getError());
    }
    
//     /**
//      * 第三方用户-第一次登陆
//      */
//     public function firstLogin($data){
//         if($this->validate()->create($data))
//     }


    /**
     * 头像上传
     */
    public function uploadAvatar($u_id){
        $res=$this->PicUpload(1,'avatar','avatar');
        if(isset($res['imgurl'])){
            if($this->where("u_id=%d",$u_id)->setField('avatar',$res['imgurl'])){
                return spt_json_success($res['imgurl']);//若用户第一次上传头像，则返回头像的URL
            }
            return spt_json_error('更新头像成功');//若用户非第一次上传头像，则不返回URL
        }
        return spt_json_error('上传失败');
    }
    
    
    /**
     * 附近的人
     */
    public function nearby($u_id,$page,$limit){
        $this->pageLegal($page, $limit);
        $location=$this->where("u_id=%d",$u_id)->find();
        $res=$this->where("location='%s'",$location['location'])
                    ->limit(($page-1)*$limit,$limit)
                    ->select();
        if($res){
            return spt_json_success($res);
        }
        return spt_json_error('附近很冷清啊');
        
    }
    
    /**
     * 获取实时位置
     */
    public function saveLocation($data){
        if($this->data($data)){
            if($this->where("u_id=%d",$data)->setField('location',$data['location'])){
                return spt_json_success();
            }
            return spt_json_error();
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 更新个人信息 
     */
    public function updateInfo($data){
       if($data['nickname'] === ''){
           $data['nickname'] = $data['account'];
       }
       if($this->create($data,2)){
           if($this->where("u_id=%d AND account='%s'",$data['u_id'],$data['account'])->save()){
               session('user',$data);
               return spt_json_success('更新资料成功！'); 
           }
           return spt_json_error('新信息与旧信息相同');
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
    
    
    
}