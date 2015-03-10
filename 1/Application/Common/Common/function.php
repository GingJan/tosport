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






function sendEmail($toEmail,$title,$content){
    vendor('PHPMailer.PHPMailerAutoload');//引入PHPMailer的核心文件
    $mail=new PHPMailer();
    
    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
//     $mail->SMTPDebug = 1;
    
    $mail->isSMTP();// 设置PHPMailer使用SMTP服务器发送Email;使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等
    
    $mail->Host=C('MAIL_SMTP'); // 设置SMTP服务器,链接qq域名邮箱的服务器地址
    
    $mail->SMTPAuth=true;// //smtp需要鉴权 这个必须是true
    
    $mail->SMTPSecure = 'ssl';//设置使用ssl加密方式登录鉴权,或者'tls'
    
    $mail->Port = 465;//设置ssl连接smtp服务器的远程服务器端口号 可选'ssl':465,'tls':587端口
    
    $mail->CharSet='UTF-8';// 设置邮件的字符编码，若不指定，则为'UTF-8'
    
    $mail->isHTML(true);//邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    
    $mail->addAddress($toEmail); // 添加收件人地址，可以多次使用来添加多个收件人,//设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    //$mail->addAddress($address2,'optional'); //添加多个收件人 则多次调用方法即可
                                 
    $mail->Body=$content;//添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    
    $mail->From=C('MAIL_ADDRESS');// 设置邮件头的From字段。
    
    $mail->FromName=C('MAIL_SENDER');// 设置发件人名字
    
    $mail->Subject=$title;// 设置邮件标题
    
    $mail->Username=C('MAIL_LOGINNAME'); // 设置用户名。
    
    $mail->Password=C('MAIL_PASSWORD'); // 设置密码。
    
    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    //$mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    //$mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
    //$mail->Helo = 'Hello smtp.qq.com Server';//设置smtp的helo消息头 这个可有可无 内容任意
    //$mail->Hostname = 'tosport.com';//设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    //$mail->AddCC("cc@ccdomain"); //抄送给，即同时发给
    //$mail->AddBCC("bcc@bccdomain"); //暗抄送给，即同时暗地发送给
    
    //发送命令 返回布尔值
    //PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
    $status=$mail->send();// 发送邮件。
    
    if($status){
        return true;
    }
//     return $status.$mail->ErrorInfo;//错误信息显示,调试用
    return false;
    
}

/**
 * 生成一个伪随机数
 * @param int $length
 */
function random_str(int $length)
{
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));//生成3个数组（range生成一个0-9共10个元素的数组）并且合并
    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++){
        $rand = mt_rand(0, $arr_len-1);//生成一个伪随机数
        $str.=$arr[$rand];
    }
    return $str;
}


/**
 * 自动填充
 * @param array $data
 */
function autofill(array &$data){
    foreach ($data as $key=>$value){
        $data[$key] = $value? : session('user.'.$key);//可以把第二表达式写成  session('user'.$key)? : $with 
    }
    return $this;
}