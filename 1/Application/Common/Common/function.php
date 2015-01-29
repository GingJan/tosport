<?php
/**
 * 封装(处理)错误的json格式
 * @param string $msg 错误提示消息
 * @param number $error_code 错误码
 * @return multitype:number string
 */
function spt_json_error($msg='operate error',$error_code=40000){
    return array('error_code'=> $error_code,'msg'=>$msg);
}

/**
 *  封装处理成功的json格式
 * @param mixed $data
 * @param number $code  默认20000
 * @return multitype:number unknown
 */
function spt_json_success($data='operate successfully',$code=20000){
    return array('code'=> $code,'response'=>$data);
}

/**
 * 常用的请求方法错误
 * @return Ambigous <multitype:number, multitype:number string >
 */
function spt_json_error_request(){
    return spt_json_error('Request method error',40001);
}

/**
 * 试着获取登录用户的信息,如果没登录，则无法获取
 */
function spt_getLoginUser(){//能否只能想取的字段的值,该处可以优化
    if(session('?user')){
        return session('user');
    }
    return false;
}