<?php
namespace Home\Controller;
use Common\Controller\BaseController;

vendor('php-sdk-6.1.13/qiniu.io');
vendor('php-sdk-6.1.13/qiniu.rs');
class SaveFileController extends BaseController{
    public function __construct(){
        Qiniu_SetKeys(C('ACCESSKEY'), C('SECRETKEY'));
    }
    
    
    public function upToken(){
        global $putPolicy;
        $putPolicy = new \Qiniu_RS_PutPolicy(C('BUCKET'));
        $putPolicy->Expires=86400;//上传凭证的有效期为24小时
        $putPolicy->CallbackUrl='http://www.egerla.com/index.php/Home/SaveFile/getCallback';
        $putPolicy->CallbackBody="key=$(key)&etag=$(etag)";
        $upToken = $putPolicy->Token(null);
        $this->ajaxReturn($upToken);
    }
    
    public function getCallback(){
        $info = I('post.');
        $this->ajaxReturn(D('QiNiu')->saveKey($info));
    }
    
    /**
     * 下载凭证
     * @param unknown $key 文件名
     */
    public function downToken($key){
        $baseUrl = Qiniu_RS_MakeBaseUrl(C('DOMAIN'), $key);
        $getPolicy = new \Qiniu_RS_GetPolicy();
        $privateUrl = $getPolicy->MakeRequest($baseUrl,null);
        $this->ajaxReturn($privateUrl);
    }
    
    
}