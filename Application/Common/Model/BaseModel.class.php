<?php
namespace Common\Model;

use Think\Model\AdvModel;
/**
 * @author Zjien
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
    
    
    
    /**
     * 图片上传
     * @param number $size 图片最大限制，默认为2M
     * @param string $type 上传模块（头像则为'avatar'，其他为对应接口名，如动态为'timeline'）
     * @param bool $replace 是否替换同名文件
     * @param array $data 上传相关信息 
     * @return array $info 返回图片上传信息
     */
    public function PicUpload($size=2,$type='',$field=''){
        if(!$type || !$field){
            return false;
        }
        $upload = new \Think\Upload();
        $upload->maxSize = $size*1204*1024;
        $upload->exts=array('jpg','png','jpeg');
        $upload->rootPath = "./Public/";
        $upload->savePath = 'img/'.$type.'/';
        $upload->autoSub = false;
        $upload->replace = false;
        
        if($type ==='avatar'){
            $upload->replace = true;
            $upload->saveExt = 'jpg';
            $upload->saveName = session('user.account');
        }
        
        $info = $upload->uploadOne($_FILES[$field]);
        if(!$info){
            return $upload->getError();
        }
        $info['imgurl'] = "Public/".$info['savepath'].$info['savename'];
        return $info;
    }

    /**
     *
     */
    protected function checkPage(&$page,&$limit){
        $limit = $limit < 10? 10 : (int)$limit;
        $page = $page > 1? ($page-1)*$limit : 0;
    }
    
}

