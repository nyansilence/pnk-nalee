<?php  if(!defined('_source')) die("Error");		
	
	$list = $model->getContentWithTag($_GET['slug']);
	$data = array();
	$title_cat = "Tag ".$list['name'];
	if(count($list['id']) > 0){
		$d->query("select * from #_content where id in (".implode(",",$list['id']).") order by stt desc");
		$data = $d->result_array();
	
	
	}
	
	
	
	
	
	