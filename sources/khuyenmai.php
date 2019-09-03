<?php  if(!defined('_source')) die("Error");
$assets->registerPackage("bx_slider");
$row = explode("&",getCurrentPageURL());
$rel_url =$row[0];


@$id =  addslashes($_GET['id']);
$bread->add(_khuyenmai,"javascript:void(0)");

#check($_GET);
if($id!='')
{
		$d->query("select * from #_discount where id = $id");
		if(!$d->num_rows()){
			load404();
		}
		$r = $d->fetch_array();
		$title_cat = $r['name'];
		$xcontent = $r['content'];
		$bread->add($r['name'],getCurrentPageURL());
	
	
		$sql  = "select p.* from #_product p,#_product_discount pd where pd.id_product = p.id and hienthi > 0 and pd.id_discount = $id order by stt desc";
		
		$page = 1;
		if(isset($_GET['p'])){
			$page = $_GET['p'];
		}
		$psize = $global_setting['product_paging'];
		$begin = $psize*$page - $psize;
		
		$d->query(str_replace(" p.* "," count(p.id) as num ",$sql));
		$r = $d->fetch_array();
		$total = $r['num'];
		
	
		
		$sql.= " limit $begin,$psize  ";
		$d->query($sql);
		
		$product = $d->result_array();
		$url = getCurrentPageURL();
		if(isset($_POST['url'])){
			$url = $_POST['url'];
		}
		
		$paging = pagination($total,$psize,$page,$url);
	

}
if(isset($_GET['id_danhmuc'])){
	$d->query("select id,ten_vi from #_product_brand where tenkhongdau = '".$_GET['id_danhmuc']."'");
	$r = $d->fetch_array();
	$bread->add($r['ten_vi'],getCurrentPageURL());
	$id_danhmuc = $r['id'];
	
}
