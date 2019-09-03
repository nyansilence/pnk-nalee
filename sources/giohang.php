<?php  if(!defined('_source')) die("Error");
	$bread->add(_shopcart,getCurrentPageUrl());
		$assets->addCss("assets/css/new-cart.css");
	
	
	
	if(isAjaxRequest()){
		include _template."giohang_tpl.php";
		die;
		
	}
	
?>