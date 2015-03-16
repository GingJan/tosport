<?php
namespace Common\Model;
use Common\Model\BaseModel;

define('PIN_LENGTH',10);//PIN的长度，默认为10
define('EXPIRATION',86400);//有效期24小时

class PinCodeModel extends BaseModel{
    /**
     * 创建一临时PIN码
     * @param unknown $data
     */
    public function createPIN(&$data){
        $data['PIN_code']=random_str(PIN_LENGTH);
        $data['create_time']=NOW_TIME;
        $data['expiration']=$data['create_time']+EXPIRATION;//数据库用event会每24小时执行一次，删除过期的PIN码
        if($this->data($data)){
            if($this->add()){
                return true;
            }
            return false;
        }
        return false;
    }
    
    /**
     * 判断PIN是否正确匹配
     * @param unknown $u_id
     */
    public function judgePIN(&$data){
        if($this->where("account='%s' AND PIN_code='%s' AND expiration>=%d",$data['account'],$data['PIN'],NOW_TIME)->find()){
            return true;
        }
        return false;
        
        
    }
    
    
    public function deletePIN($u_id){
        
    }
}