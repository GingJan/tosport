<?php
namespace Home\Model;

use Think\Model;
class AccountModel extends Model{
    protected $_validate=array(
        array('account','','Account can not be null',self::EXISTS_VALIDATE,'notequal',1),
        array('account','require','account has been existed',self::EXISTS_VALIDATE,'unique',1),
        array('password','','password can not be null',self::EXISTS_VALIDATE,'notequal',3),
        array('password','6,12','password length 6~12',self::EXISTS_VALIDATE,'length',3),
        array('repassword','password','The two passwords do not match, please re-enter',self::EXISTS_VALIDATE,'confirm',3), // 验证确认密码是否和密码一致
        array('email','','邮箱不能为空',self::EXISTS_VALIDATE,'notequal',3),
//         array('email','/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',3)
        array('email','email','邮箱格式不正确',self::EXISTS_VALIDATE,'regex',3)
    );       //邮箱正则需要改进          
    
    protected $_auto=array(
        array('password','md5',3,'function')
    );
    
    /**
     * TODO
     * @param unknown $to
     * @param unknown $title
     * @param unknown $body
     * @return boolean
     */
//     protected function sendemail($to,$title,$body){
//         $mail = new \Org\Util\PHPMailer\phpmailer;
//         $mail->isSMTP();
//         $mail->Host = 'smtp.qq.com;smtp.126.com;smtp.gmail.com';  // Specify main and backup SMTP servers
//         $mail->SMTPAuth = true;                               // Enable SMTP authentication
//         $mail->Username = '1873866421@qq.com';                 // SMTP username
//         $mail->Password = 'wzzh105aa';                           // SMTP password
//         $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//         $mail->Port = 465;                                    // TCP port to connect to,465 port support ssl
        
//         $mail->From = 'from@example.com';
//         $mail->FromName = 'Mailer';
// //         $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
//         $mail->addAddress($to);               // Name is optional
//         $mail->addReplyTo('1873866421@qq.com', 'admin');
//         $mail->addCC('cc@example.com');
//         $mail->addBCC('bcc@example.com');
        
// //         $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments,添加附件
// //         $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//         $mail->isHTML(false);                                  // Set email format to HTML 设置邮件格式为HTML
        
//         $mail->Subject = 'get password';//邮件主题
//         $mail->Body    = 'test1 password';//邮件内容主题
//         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';//邮件备用内容主题
//         if($mail->sent()){
//             return true;
// 		}
// 		return false;
//     }
    
    
    /**
     * 检测密码是否正确
     * @param string $account
     * @param string $password
     * @return boolean
     */
    protected function checkPassword($account,$password){
        if($this->where("account='%s' AND password='%s'",$account,$password)->find()){
            return true;
        }
        return false;
    }
    
    
    /**
     * Account表 注册
     */
    public function register($data){
        if($this->create($data)){
            if($this->add()){
                return spt_json_success('注册成功');
            }
            return spt_json_error('注册发生错误!');
        }
        return spt_json_error($this->getError());
    }
    
    /**
     * 登录
     */
    public function login($data){
        $where="account='%s' AND password='%s'";
        $res=$this->where($where,$data['account'],$data['password'])->find();
        if($res){
            session(array('session_id'=>session_id(),'expire'=>3600));//设置session过期的时间
            $userInfo=D('UserInfo');
            $info=$userInfo->getUserInfo($res['account']);
            session('user',$info['response']);
            $userInfo->where("u_id=%d",$info['response']['u_id'])->save($userInfo->create($res,4));
            return spt_json_success('登陆成功!');
        }
        return spt_json_error('用户不存在或者密码错误!');
    }
    
    /**
     * 修改密码
     */
    public function updatePassword($data){
        $validate_rules=array(
            array('password','','新密码不能为空',self::MUST_VALIDATE,'notequal',3),
            array('password','6,12','密码长度为6~12位',self::MUST_VALIDATE,'length',3),
            array('repassword','password','确认密码不一致，请重新输入',self::MUST_VALIDATE,'confirm',3) // 验证确认密码是否和密码一致
        );
        
        if($this->checkPassword($data['account'], $data['password'])){
            $res=$this->validate($validate_rules)->create(array('password'=>$data['newPassword'],'repassword'=>$data['repassword']));
            if($res){
                $this->where("account='%s'",$data['account'])->setField('password',$res['password']);
                return spt_json_success('密码修改成功!');
            }
            return spt_json_error($this->getError());
        }
        return spt_json_error('原密码错误!');
    }
    
    /**
     * 找回密码,暂未实现 TODO
     */
    public function forgetPassword($email){
        if($this->where("email='%s'",$email)->find()){
            $title='约运动——找回密码';
            $body='This is a test';
            if($this->sendemail($email, $title, $body)){
                return spt_json_success('找回密码邮件已发送');
            }
            return spt_json_error('error!!!!!!!!!!!!,email_function inner error');
        }
        return spt_json_error('This email does not register yet');
    }
    
}