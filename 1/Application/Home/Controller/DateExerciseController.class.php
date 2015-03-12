<?php
namespace Home\Controller;

use Common\Controller\BaseController;

class DateExerciseController extends BaseController{
    /**
     * 创建一条约运动
     */
    public function create(){
        $this->getlogin()->reqPost(array('sport_type','sport_place','sport_time','content','people_amount','picture'));
        $data=I('post.');
        $data['creator_id']=session('user.u_id');
        $this->ajaxReturn(D('DateExercise')->createDE($data));
    }
    
    /**
     * 删除一条约运动
     */
    public function delete(){
        $this->getlogin()->reqPost(array('de_id'));
        $de_id=I('post.de_id');
        $creator_id=session('user.u_id');
        $this->ajaxReturn(D('DateExercise')->deleteDE($de_id,$creator_id));
    }
    
    /**
     * 显示 指定某条约运动
     */
    public function listsSpeDE(){
        $this->getlogin()->reqPost(array('de_id'));
        $de_id=I('post.de_id');
        $this->ajaxReturn(D('DateExercise')->listsSpeDE($de_id));
    }
    
    /**
     * 显示同城的约运动
     */
    public function listsCityDE($page = 1,$limit = 10){
        $this->getlogin()->reqPost(array('my_region'));
        $my_region=I('post.my_region');
        $this->ajaxReturn(D('DateExercise')->listsCityDE($my_region,$page,$limit));
    }
    
    /**
     * 显示热门的约运动
     */
    public function listsHotDE($page = 1,$limit = 10){
        $this->getlogin()->reqPost('my_region');
        $my_region=I('post.my_region');
        $this->ajaxReturn(D('DateExercise')->listsHotDE($my_region,$page,$limit));
    }
    
    /**
     * 约ta
     */
    public function dateIt(){
        $this->getlogin()->reqPost(array('de_id','creator_id'));
        $data=I('post.');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('DateExercise')->dateIt($data));
    }
    
    /**
     * 取消预约
     */
    public function cancelDate(){
        $this->getlogin()->reqPost(array('de_id'));
        $data['de_id']=I('post.de_id');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('DateExercise')->cancelDate($data));
    }
    
    /**
     * 列出约我的人
     */
    public function listsDateGuy($page = 1,$limit = 10){
        $this->getlogin();
        $creator_id=session('user.u_id');
        $this->ajaxReturn(D('DateExercise')->listsDateGuy($creator_id,$page,$limit));
    }
}