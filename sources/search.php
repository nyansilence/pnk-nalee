<?php  if(!defined('_source')) die("Error");
		$class_bg = "";
		$bread->add("Tìm kiếm",getCurrentPageURL());
		if(isset($_GET['keyword'])){
			$cat = "";
			$tukhoa =  $_GET['keyword'];
			
			$tukhoa = trim(strip_tags($tukhoa));    	
    		if (get_magic_quotes_gpc()==false) {
    			$tukhoa = mysql_real_escape_string($tukhoa);    			
    		}	
				
			if(@$_GET['category']!=0){
				$cat = " and id_danhmuc = '".mysql_real_escape_string(@$_GET['category'])."'";
			}
			if(@$_GET['price']!=0){
				$id_p = mysql_real_escape_string(@$_GET['price']);
				check($_GET);
				$d->query("select min_price,max_price from #_product_price where id = '$id_p'");
				$r = $d->fetch_array();
				$cat.= " and gia between ".$r['min_price']." and ".$r['max_price'];
			}
			$sql= "select * from #_product where ((ten_".$lang." LIKE '%$tukhoa%') or (noidung_".$lang." LIKE '%$tukhoa%') or (mota_".$lang." LIKE '%$tukhoa%') or (maso LIKE '%$tukhoa%') )  and hienthi=1 ".$cat." order by stt desc";		
			
			$d->query($sql);
			$product = $d->result_array();	
			
			$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
			$url=getCurrentPageURL();
			$maxR=$global_setting['product_paging'];
			$maxP=5;
			$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
			$product=$paging['source'];
			
			$template = "search/product";
			
		}	
		
?>