<?php
namespace Common\Model;

use Think\Model\AdvModel;
/**
 * @author Jayin Ton
 */
class BaseModel extends AdvModel{
    //自动验证 //默认,验证条件：0存在字段就进行验证 , 验证时间：1新增/编辑 数据时候验证
    protected $_validate = array();
    //自动填充 //默认 新增数据的时候处理
    protected $_auto = array();
    //只读字段，插入后不能通过save更新
    protected $readonlyField = array();
    
    /**
     * 检测密码是否正确
     * @param string $account
     * @param string $password
     */
    protected function checkPassword($account,$password){
        if($this->where("account='%s' AND password='%s'",$account,$password)->find()){
            return true;
        }
        return false;
    }
    
    /**
     * 获取IP地址
     */
    protected function getIP($data){
        return $_SERVER['REMOTE_ADDR'];
    }
}

