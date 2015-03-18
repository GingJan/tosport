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
    
    /**
     * 判断输入的页码和每页显示数
     */
    protected function pageLegal(&$page,&$limit){
        if($page <= 0){
            $page = 1;
        }
        if($limit <= 0){
            $limit = 10;
        }
        return $this;
    }
    
    
    /**
     * 是否为整数 
     */
    protected function isInteger($data){
        if($data == floor($data)){
            return true;
        }
        return false;
    }
    
   
     /************************* 调用七牛***********************/
    /**
     * 获取upToken上传凭证
     */
    public function upToken($CallbackUrl){
        vendor('php-sdk-6.1.13/qiniu.io');
        vendor('php-sdk-6.1.13/qiniu.rs');
        Qiniu_SetKeys(C('ACCESSKEY'), C('SECRETKEY'));
        global $putPolicy;
        $putPolicy = new \Qiniu_RS_PutPolicy(C('BUCKET'));
        $putPolicy->Expires=86400;//上传凭证的有效期为24小时
        $putPolicy->CallbackUrl=$CallbackUrl;
        $putPolicy->CallbackBody="key=$(key)&etag=$(etag)";
        $upToken = $putPolicy->Token(null);
        return $upToken;
    }
     
}

