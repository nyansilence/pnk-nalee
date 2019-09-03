<?php 
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    if ($_SERVER['PHP_AUTH_USER'] != 'root' ||   $_SERVER['PHP_AUTH_PW'] != 'xadmin') {

        header('WWW-Authenticate: Basic realm="Protected area"');
        header('HTTP/1.0 401 Unauthorized');

        die('Login failed!');
    }else{
		define("_lib","Location");
		include "config.php";
		echo '<pre>';
		print_r($config);
		
	}
}
?>