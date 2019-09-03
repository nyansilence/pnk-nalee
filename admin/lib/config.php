<?php if(!defined('_lib')) die("Error");
error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$config['base_url'] = "https://".$_SERVER['HTTP_HOST'];
$config['base_url'] .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"", $_SERVER['SCRIPT_NAME']);
$config['base_url']  = substr($config['base_url'],0,-1);
$f = "";
$config_url =  "https://".$_SERVER['HTTP_HOST'].$f;
$relative_url = str_replace('/admin','',$config['base_url']);
/* lang config */
$config['AllLang'] = array('vi'=>'Tiếng Việt','en'=>'Tiếng Anh','cn'=>'Tiếng Trung Quốc');
$config['AllLang_fix'] = $config['AllLang'];
$config['lang'] = array('vi');
$config['dev'] = 1;
$config['responsive'] = false;
if(count($config['lang']) == 1){
	$config['AllLang'] = array('vi'=>'Nội dung');
}
/* ckfinder config */
$config['finder']['folder'] = $f;
$config['finder']['dir'] = "/upload/user/";
/* db config */
$config['database']['servername'] = 'localhost';
$config['database']['username'] = 'pnkmedia_fashionuser';
$config['database']['password'] = 'Phuctho@2019';
$config['database']['database'] = 'pnkmedia_begaushop';
$config['database']['refix'] = 'table_';
$config['database']['refix'] = 'table_';
$config['md5'] = md5($f.$config['database']['database']);
/* upload resize */
$config['max-width'] = 2048;
$config['max-height'] = 1080;
$config['web-name'] = ' Web Admin';

/*Config Firewall */
$config['defender'] = true;
$fw_conf['firewall']=false; //Bat tat firewall
if($_SERVER['SERVER_NAME']!='localhost'){
	$fw_conf['firewall']=true; //Bat tat firewall
}
$fw_conf['max_lockcount']=200;//So lan toi da phat hien dau hieu DDOS va khoa IP do vinh vien 
$fw_conf['max_connect']=300;//So ket noi toi da dc gioi han boi $fw_conf['time_limit']
$fw_conf['time_limit']=200;//Thoi gian dc thuc hien toi da $fw_conf['max_connect'] ket noi
$fw_conf['time_wait']=5;//Thoi gian cho de dc mo khoa khi IP bi khoa tam thoi
$fw_conf['email_admin']='mailpnkmedia@gmail.com';//Email lien lac voi Admin
$fw_conf['htaccess']=".htaccess";//Duong dan toi file htaccess tren server
$fw_conf['ip_allow']='127.0.0.1';
$fw_conf['ip_deny']='';

@define(_MAIL_USER,"noreply.pnkmailserver@gmail.com");
@define(_MAIL_PWD,"rvwcnezzttbixmzs");
@define(_MAIL_IP,"");
?>