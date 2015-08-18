<?php
/**
 * 配置信息
 * by xiaoming
 */
//常量
define('SELFTOKEN','qzone_tueur');

//错误代码
define('ERR_OK',0);
define('ERR_PARAMWRONG',1);
define('ERR_PARAMNOTFULL',2);
define('ERR_NODATA',3);
define('ERR_DATAEXIST',4);
define('ERR_ILIGAL',5);
define('ERR_UNKNOW',6);
define('ERR_REQUISITE',7);

//错误信息
global $error_msg;
$error_msg = array(
    'msg_0'=>'ok',
    'msg_1'=>'参数不正确',
    'msg_2'=>'参数缺失',
    'msg_3'=>'找不到数据',
    'msg_4'=>'数据已经存在',
    'msg_5'=>'非法操作',
    'msg_6'=>'未知错误',
    'msg_7'=>'非法请求'
);

//系统配置文件
define('WEBNAME','空间宝');
define('PAGE_SIZE',10);
define('ARTICLE_SIZE',8);
define('NAV_SIZE',10);
define('UPDIR','/uploads/');

//轮播器配置
define('RO_TIME',3);
define('RO_NUM',3);

//广告服务
define('ADVER_TEXT_NUM',5);
define('ADVER_PIC_NUM',3);
//不可修改的项目

//数据库配置文件
define('DB_HOST','localhost');
define('DB_USER','qzone_tueur');
define('DB_PASS','iMNcGB58');
define('DB_NAME','qzone');
define('DB_PORT',3306);

define('GPC',get_magic_quotes_gpc());
define('PREV_URL',$_SERVER["HTTP_REFERER"]);

//模板配置信息
define('TPL_DIR',ROOT_PATH.'/templates/');
define('TPL_C_DIR',ROOT_PATH.'/cache/templates_c/');
define('CACHE',ROOT_PATH.'/cache/');
define('MARK',ROOT_PATH.'/images/yc.png');


