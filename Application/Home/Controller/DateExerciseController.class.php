<?php
namespace Home\Controller;

use Common\Controller\BaseController;

class DateExerciseController extends BaseController{
    /**
     * 创建一条约运动
     */
    public function create(){
        $this->getlogin()->reqPost(array('sport_type','sport_place','sport_time','people_amount'));
        $data=I('post.');
        $data['creator_id']=session('user.u_id');
        $data['creator_region']=session('user.region');
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
        $this->ajaxReturn(D('DateExercise')->listsSpeDE(I('post.de_id')));
    }
    
    /**
     * 显示同城的约运动
     */
    public function listsCityDE($page = 1,$limit = 10){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('DateExercise')->listsCityDE(session('user.region'),$page,$limit));
    }
    
    /**
     * 显示热门的约运动
     */
    public function listsHotDE($page = 1,$limit = 10){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('DateExercise')->listsHotDE(session('user.region'),$page,$limit));
    }
    
    /**
     * 预约 / 取消预约
     */
    public function toDate(){
        $this->getlogin()->reqPost(array('de_id','creator_id'));
        $data=I('post.');
        $data['me_id']=session('user.u_id');
        $this->ajaxReturn(D('DateExercise')->toDate($data));
    }
    
    /**
     * 列出约我的人
     */
    public function listsDateGuy($page = 1,$limit = 10){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('DateExercise')->listsDateGuy(session('user.u_id'),$page,$limit));
    }
       
    /**
     * 列出我参加的约运动
     */
    public function listsJoin($page = 1,$limit = 10){
        $this->getlogin()->reqPost();
        $this->ajaxReturn(D('DateExercise')->listsJoin(session('user.u_id'),$page,$limit));
    }
}