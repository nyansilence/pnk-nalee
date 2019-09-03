<?php  if(!defined('_source')) die("Error");
$assets->registerPackage("bx_slider");
$row = explode("&",getCurrentPageURL());
$rel_url =$row[0];

$class_bg = "";
@$id_danhmuc =  addslashes($_GET['id_danhmuc']);
@$id_list =  addslashes($_GET['id_list']);
@$id_cat =  addslashes($_GET['id_cat']);
@$id =  addslashes($_GET['id']);
$bread->add(_hanggiacong,"hang-gia-cong.html");

#check($_GET);
if($id!='')
{
	$assets->registerPackage("product_detail");
	$assets->registerPackage("jssocials");
	
    #các s?n ph?m khác======================
    $sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE id ='".$id."'";
    $d->query($sql_lanxem);
    $sql_detail = "select * from #_product where hienthi=1 and id='".$id."'";
    $d->query($sql_detail);
    $row_detail = $d->fetch_array();
    $product_detail = $row_detail;
	if($product_detail['id_brand']){
		$d->query("select * from #_product_brand where id = ".$product_detail['id_brand']." and hienthi = 1");
		if($d->num_rows()){
			$brand = $d->fetch_array();
			$d->reset();
			$d->query("select id,tenkhongdau from #_product_danhmuc where id = ".$product_detail['id_danhmuc']);
			$danhmuc = $d->fetch_array();
		}
	}
    $title_bar=$row_detail['ten_'.$lang].' - ';
	addingSeo($row_detail);
    $sql = "select * from #_product where hienthi=1 and id_danhmuc='".$row_detail['id_danhmuc']."' and type='hang-gia-cong'";
	if($row_detail['id_list']){
		$sql.=" and id_list ='".$row_detail['id_list']."'";
	}
	$sql.= "   order by stt desc limit 8";
    $d->query($sql);
    $product = $d->result_array();
	if(isAjaxRequest() | @$_GET['iframe']==1){
		include _template."product/quick_detail_tpl.php";
		die;
	}
	

	if($row_detail['id_danhmuc']){
		$d->query("select ten_$lang,id,tenkhongdau from #_product_danhmuc where id = '".$row_detail['id_danhmuc']."'");
		$rx = $d->fetch_array();
		$bread->add($rx['ten_'.$lang],$com."/".$rx['tenkhongdau']."/");
	}
	if(@$rx & $row_detail['id_list']){
		$d->query("select ten_$lang,id,tenkhongdau from #_product_list where id = '".$row_detail['id_list']."'");
		$r = $d->fetch_array();
		$bread->add($r['ten_'.$lang],$com."/".$rx['tenkhongdau']."/".$r['tenkhongdau']."/");
	}
	if(@$rx & @$r & $row_detail['id_cat']){
		$d->query("select ten_$lang,id,tenkhongdau from #_product_cat where id = '".$row_detail['id_cat']."'");
		$rs = $d->fetch_array();
		$bread->add($rs['ten_'.$lang],$com."/".$rx['tenkhongdau']."/".$r['tenkhongdau']."/".$rs['tenkhongdau']);
	}

	$bread->add($row_detail['ten_'.$lang],getCurrentPageURL());

}
else{
	
	
	
	
	
	
	
	



		$title_bar= _product.' - ';
		$title_cat= _product.'';
		$data = array();
		$data['color'] = magic_quote(@$_REQUEST['color']);
		$data['size'] = magic_quote(@$_REQUEST['size']);
		$data['price'] = magic_quote(@$_REQUEST['price']);
		
		$data_filter = $data;
	
	
		$_SESSION['search'][$com] = array("size"=>@$_POST['size'],"color"=>@$_POST['color'],"order"=>@$_POST['order']);
		
		#check($_POST);
		$list_id = array();
		$table = array();
		$table[] = "#_product p";
		$condition = array();
		
		if($data['size']){
			$size = $data['size'];
			if(is_array($size)){
				$size = implode(",",$size);
			}
			$table[]  = "#_product_size_condition ps";
			$condition[] = "ps.id_product  = p.id";
			$condition[] = "ps.id_size in ($size)";
		}
		if($data['color']){
			
			$color = $data['color'];
			
			if(is_array($color)){
				$color = implode(",",$color);
			}
			$table[]  = "#_product_color_condition pc";
			$condition[] = "pc.id_product  = p.id";
			$condition[] = "pc.id_color in ($color)";
			
			
		}
		
		
		if($data['price']){
				$id_p = $data['price'];
				if(is_array($id_p)){
					$id_p = implode(",",$id_p);
				}
				
				$d->query("select min(min_price) as min_price, max(max_price)  as max_price from #_product_price where id in (".$id_p.")");
				$r = $d->fetch_array();
			
				$condition[] = " gia between ".$r['min_price']." and ".$r['max_price'];
			}
		//check($condition);
		//echo implode(" and ",$condition);
		$sql="select p.* from ".implode(",",$table)." where 1 ".((count($condition)) ? "  and type='hang-gia-cong' and ".implode(" and ",$condition) : '')."  and p.hienthi = 1 ";
		
		if(isset($ptype)){
			$sql.= " and type='$ptype' ";

		}
		if($com=="sale"){
		$list_[] = 0;
		$d->query("select id_product from #_product_discount pd,#_discount d where d.id = pd.id_discount  and end_date > ".time()." and hienthi = 1 ");
		foreach($d->result_array() as $k=>$v){
				$list_[] = $v['id_product'];
			
		}
		
		$sql.= " and p.id in(".implode(",",$list_).") ";
		
		}
		if(@$data['keyword']){
			$sql.=" and ten_$lang like '%".$data['keyword']."%'";
		}
		
		if($id_danhmuc){
		
			//if(!isAjaxRequest()){
				$xsql = "select ten_$lang,id,noidung_$lang,seo_title,seo_keyword,seo_description from #_product_danhmuc where tenkhongdau='$id_danhmuc' ";
				$d->query($xsql);
				$titlex = $d->fetch_array();
				$title_bar = $titlex['ten_'.$lang].' - ';
				$title_cat = $titlex['ten_'.$lang];
				addingSeo($titlex);
				$d->reset();
				$bread->add($title_cat,getCurrentPageURL());
				$id_danhmuc = $titlex['id'];
			//}
			
			
				$sql.=" and id_danhmuc = $id_danhmuc";
			
			$template="product/index";
		}
		if($id_list){
			
			//if(!isAjaxRequest()){
				$xsql = "select ten_$lang,id,noidung_$lang,seo_title,seo_keyword,seo_description,id_danhmuc from #_product_list where tenkhongdau='$id_list' ";
				$d->query($xsql);
				$titlex = $d->fetch_array();
				$title_bar = $titlex['ten_'.$lang].' - ';
				$title_cat = $titlex['ten_'.$lang];
				addingSeo($titlex);
				$d->reset();



				if($titlex['id_danhmuc']){
					$d->query("select ten_$lang,id,tenkhongdau from #_product_danhmuc where id = '".$titlex['id_danhmuc']."'");
					$rx = $d->fetch_array();
					$bread->add($rx['ten_'.$lang],$com."/".$rx['tenkhongdau']."/");
				}
				$id_list = $titlex['id'];
				$bread->add($title_cat,getCurrentPageURL());
				
			//}
			$template="product/index";
			$sql.=" and id_list = $id_list";
		}
		
		
		
				$order = " stt desc ";
			
		switch(@$_POST['order']){
			case 1:
				$order = " stt desc ";
				break;
			case 2:
				$order = " new desc,stt desc ";
				break;
			case 3:
				$order = " gia asc,stt desc ";
				break;	
			case 4:
				$order = " gia desc,stt desc ";
				break;	
				
				
				
		}
		if($com=="sale"){
			$list_ = array();
			$d->query("select id_product from #_product_discount pd,#_discount d where d.id = pd.id_discount  and end_date > ".time()." and hienthi = 1 ");
			foreach($d->result_array() as $k=>$v){
					$list_[] = $v['id_product'];
				
			}
			if(count($list_) > 0){
				$sql.= " and p.id in(".implode(",",$list_).") ";
			}
			
		
		}
		if(isset($type)){
		$sql.= " and $type = 1 ";
		}
		
		
		$sql2 = $sql." group by id order by $order";
		
		$d->query($sql2);
		
		$page = 1;
		if(isset($_GET['p'])){
			$page = $_GET['p'];
		}
		$psize = $global_setting['product_paging'];
		$begin = $psize*$page - $psize;
		
		$d->query(str_replace(" p.* "," count(p.id) as num ",$sql));
		$r = $d->fetch_array();
		$total = $r['num'];
		
	
		
		$sql.= " group by p.id order by $order limit $begin,$psize  ";
		$d->query($sql);
		$product = $d->result_array();
		$url = getCurrentPageURL();
		if(isset($_POST['url'])){
			$url = $_POST['url'];
		}
		$paging = pagination($total,$psize,$page,$url);
		
		$data = array();
		
		if(isAjaxRequest()){
			sleep(1);
			foreach($product as $k=>$v){
					$_ar[] =array();
					/*if($_POST['bcom']=="sale" | $_POST['bcom']=="san-pham-moi"){
						$_ar['class']='item-product col-xs-6 col-md-3 col-sm-4';
					}*/
					
						$data[] = $model->showProduct($v,array(),$k,false);
			}
			

			echo json_encode(array("data"=>$data,"paging"=>$paging,"sql"=>$sql));
			die;
		}
		

}
/*
elseif($id_cat!='')
{

    $sql = "select ten_$lang,id,noidung_$lang from #_product_cat where id='$id_cat' ";
    $d->query($sql);
    $titlex = $d->fetch_array();
    $title_bar = $titlex['ten_'.$lang].' - ';
    $title_cat = $titlex['ten_'.$lang];
	addingSeo($titlex);
    $sql = "select * from #_product where hienthi=1 and id_cat='$id_cat' order by stt desc";
    $d->query($sql);
    $product = $d->result_array();
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
    $product = $paging['source'];
}

elseif($id_danhmuc!='')
{
    $sql = "select * from #_product_danhmuc where tenkhongdau='$id_danhmuc'";
	if(isset($_GET['brand'])){
		$brand = magic_quote($_GET['brand']);
		$d->query("select * from #_product_brand where tenkhongdau ='".$brand."'");
		if($d->num_rows()){
			$brand = $d->fetch_array();			
		}
	}
    $d->query($sql);
    $titlex = $d->fetch_array();
	$id_danhmuc = $titlex['id'];
    $title_bar = $titlex['ten_'.$lang].' - ';
    $title_cat = $titlex['ten_'.$lang];
	addingSeo($titlex);
	$sql = "select * from #_product where hienthi=1 and id_danhmuc='$id_danhmuc' order by stt desc";
	if(isset($brand)){
		$title_bar = $titlex['ten_'.$lang].' - '.$brand['ten_'.$lang];
		$title_cat = $titlex['ten_'.$lang]." - ".$brand['ten_'.$lang];
		$sql = "select * from #_product where hienthi=1 and id_danhmuc='$id_danhmuc' and id_brand = '".$brand['id']."' order by stt desc";
		
	}
	$bread->add($title_cat,getCurrentPageURL());
    $d->query($sql);
    $product = $d->result_array();

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
    $product = $paging['source'];
	
}
elseif($id_list!='')
{

    $sql = "select * from #_product_list where tenkhongdau='$id_list'";
    $d->query($sql);
    $titlex = $d->fetch_array();
	$id_list= $titlex['id'];
    $title_bar = $titlex['ten_'.$lang].' - ';
    $title_cat = $titlex['ten_'.$lang];
	addingSeo($titlex);
    $sql = "select * from #_product where hienthi=1 and id_list='$id_list' order by stt desc";
    $d->query($sql);
    $product = $d->result_array();

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
   $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
    $product = $paging['source'];
	



}
else
{

   


    $d->reset();
	  $sql = "select * from #_product where hienthi=1 ";
	if(isset($type)){
		$sql.= " and $type = 1 ";
		$title_bar= $pfix.' - ';
		$title_cat= $pfix;
	}
	if(isset($promotion)){
		$sql.= " and ((gia > 0) and (giacu > 0) ) ";
		$title_bar= $pfix.' - ';
		$title_cat= $pfix;
	}
	$sql.= ' order by stt desc';
    $d->query($sql);
  
	
    $product = $d->result_array();
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
    $product = $paging['source'];
 
	

}

*/