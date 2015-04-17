<?php
/**
 * 此配置文件为公共配置文件，需要适用于本地的配置，请在local_config.php文件中配置，配置格式如下
 //请根据本地环境，在local_config.php文件中配置数据库密码
 */
$common_config = array(
	//'配置项'=>'配置值'
	
    //公共配置
	'APP_DEBUG'			   => true, // 开启调试模式
	'URL_MODEL'            => 2,			//URL模式为REWRITE模式,此模式可以不用输入入口文件
	'TMPL_TEMPLATE_SUFFIX' => '.html',      //模板后缀名
    'URL_HTML_SUFFIX'      => 'html|phtml', //伪静态后缀名设置
    'URL_CASE_INSENSITIVE' => true,         //不区分URL大小写
    'DB_DEBUG'             => true,         //调试模式
    'LOG_TYPE'             => 'File',       //日志记录类型 默认为文件方式
    'URL_CASE_INSENSITIVE' => true,         //不区分URL大小写
//     'SESSION_TYPE'         => 'Db',         //用数据库的形式存储session
    
    
    //邮箱配置
    'MAIL_ADDRESS'          => 'forgetpassword@egerla.com', // 邮箱地址
    'MAIL_SMTP'             => 'smtp.qq.com', // 邮箱SMTP服务器
    'MAIL_LOGINNAME'        => '1873866421', // 邮箱登录帐号
    'MAIL_PASSWORD'         => '123456aa', // 邮箱密码
    'MAIL_SENDER'           => '约运动', //发件人名字
    
    
    
    //七牛云存储配置
    'ACCESSKEY'             => 'gd4ZebkZHJvrSLD-YHZTyc2RZsEF1lnXFJWnyJ2d',
    'SECRETKEY'             => 'xhlFWwIEpLCSeOli1XrsfqOmaqWvRn4HP9xQnzhx',
    'BUCKET'                => 'tosport',
    'DOMAIN'                => 'tosport.qiniudn.com',
);


//以下为配置文件的合成
//CONF_PATH 公共配置路径： APP_PATH . 'Common' . 'Conf/'
// $local_config = CONF_PATH.'local_config.php';
// if(file_exists($local_config)){
//     $config = require($local_config);
//     return array_merge($common_config,$config);
// }

//     return array_merge($common_config,array(
// 	    //默认数据库配置
// 		'DB_TYPE'              => 'mysql',
// 		'DB_HOST'              => 'localhost',  //主机名
// 		'DB_PORT'              =>  3306,        //端口
// 		'DB_NAME'              => 'tosport',    //数据库名称
// 		'DB_CHARSET'           => 'utf8',       //字符集
// 		'DB_PREFIX'            => 'spt_',       //表前缀
//         'DB_USER'			   => 'root',		//默认数据库用户名
//         'DB_PWD'			   => '123'			//数据库密码    
//     ));
    
    /*coding.net数据库配置信息*/
    if($_ENV['VCAP_SERVICES']){
        $mysql_config = json_decode($_ENV['VCAP_SERVICES'],true);
        $mysql_config=$mysql_config['mysql'][0]['credentials'];
    }
    return array_merge($common_config,array(
        'DB_TYPE'               => 'mysql', // 数据库类型
        'DB_HOST'               => $mysql_config['hostname'], // 服务器地址
        'DB_NAME'               => $mysql_config['name'], // 数据库名
        'DB_USER'               => $mysql_config['username'], // 用户名
        'DB_PWD'                => $mysql_config['password'], // 密码
        'DB_PORT'               => $mysql_config['port'], // 端口
        'DB_PREFIX'             => 'spt_'
    ));
    
    
    
    
    
    
    
    
    
    
    
    