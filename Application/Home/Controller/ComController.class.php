<?php
namespace Home\Controller;

use Common\Controller\BaseController;
class ComController extends BaseController{
    /**
     * 获取上传凭证
     */
    public function uploadToken(){
        $this->getlogin()->reqPost();
	    $this->ajaxReturn(D('Qiniu')->upToken());
    }
    
    /**
     * 获取下载凭证(下载链接)
     */
    public function downloadToken(){
        $this->getlogin()->reqPost(array('key'));
        $this->ajaxReturn(D('Qiniu')->downToken(I('post.key')));
    }
}