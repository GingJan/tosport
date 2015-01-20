<?php
return array(
	//'配置项'=>'配置值'
	'URL_MODEL'            => 2,			//URL模式为REWRITE模式,此模式可以不用输入入口文件
	'TMPL_TEMPLATE_SUFFIX' => '.html',      //模板后缀名
    'URL_HTML_SUFFIX'      => 'html|phtml', //伪静态后缀名设置
    'URL_CASE_INSENSITIVE' => true,         //不区分URL大小写
    'DB_DEBUG'             => true,         //调试模式
    
    //数据库
    'DB_TYPE'              => 'mysql',
    'DB_HOST'              => 'localhost',  //主机名
    'DB_PORT'              =>  3306,        //端口
    'DB_NAME'              => 'tosport',    //数据库名称
    'DB_CHARSET'           => 'utf8',       //字符集
    'DB_PREFIX'            => 'spt_',       //表前缀
    'DB_USER'              => 'root',       //数据库用户名
    'DB_PWD'               => '123',        //密码
);