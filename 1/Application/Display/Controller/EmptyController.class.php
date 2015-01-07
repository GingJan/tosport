<?php
namespace Display\Controller;

use Think\Controller;
class EmptyController extends Controller{
    /**
     * test function
     */
    public function _empty($name){
        //把所有操作解析到test方法
//         $this->test($name);
        
        $controllerName = CONTROLLER_NAME;
//         echo $controllerName,$name;
        $this->display($controllerName.'/'.$name);//调用对应的控制下的操作方法的模板
    }
    
//     protected function test($name){
        
//     }

}