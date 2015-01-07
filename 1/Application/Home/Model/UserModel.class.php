<?php
namespace Home\Model;

use Think\Model;
/**
 * 用户模型
 * @author zjien
 *
 */
class UserModel extends Model{
    protected $readonlyField = array("id","account","ctime","cIP");
    
    /**
     * 
     * @param mixed $data
     * @return json
     */
    public function register($data){
        $account = D('Account')->register($data);
        if($account['code'] == 20000){
            $userInfo=D('UserInfo')->register($data);
            if($userInfo['code'] == 20000){
                return spt_json_success();
            }
            return $userInfo;
        }
        return $account;
    }
    
    /**
     * 修改用户基本信息
     * @param mixed $data
     * @return json
     */
//     public function update($data){
//         $account = 
//     }
}