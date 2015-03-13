<?php
namespace Common\Model;
use Common\Model\BaseModel;

vendor('php-sdk-6.1.13/qiniu.io');
vendor('php-sdk-6.1.13/qiniu.rs');
class QiniuModel extends BaseModel{
    /**
     * 上传凭证 
     */
    public function upToken(){
        Qiniu_SetKeys(C('ACCESSKEY'), C('SECRETKEY'));
        $putPolicy = new \Qiniu_RS_PutPolicy(C('BUCKET'));
        $putPolicy->Expires=86400;//上传凭证的有效期为24小时
//         $putPolicy->CallbackUrl=$CallbackUrl;
//         $putPolicy->CallbackBody="key=$(key)&etag=$(etag)";
        return spt_json_success($putPolicy->Token(null));//返回一个upToken
    }
    
    /**
     * 下载凭证
     */
    public function downToken($key){
        Qiniu_SetKeys(C('ACCESSKEY'), C('SECRETKEY'));
        $baseUrl = Qiniu_RS_MakeBaseUrl(C('DOMAIN'), $key);
        $getPolicy = new \Qiniu_RS_GetPolicy();
        return $getPolicy->MakeRequest($baseUrl, null);
    }
    
    
    /**
     * 把七牛返回来的信息保存起来
     * @param unknown $data
     */
    public function saveKey($data){
        if($this->data($data)){
            if($this->add()){
                return spt_json_success('上传成功');
            }
            return spt_json_error('发生错误了');
        }
        return spt_json_error('发生错误了');
    }
    
    
    
}