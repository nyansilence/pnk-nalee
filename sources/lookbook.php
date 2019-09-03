<?php  if(!defined('_source')) die("Error");
$assets->registerPackage("bx_slider");
$row = explode("&",getCurrentPageURL());
$rel_url =$row[0];

$title_bar= 'Lookbook - ';
		$title_cat= 'Lookbook';

@$id =  addslashes($_GET['id']);
$bread->add("Lookbook","javascript:void(0)");

#check($_GET);
if($id!='')
{
		$d->query("select * from #_content where id = $id and hienthi > 0");
		if(!$d->num_rows()){
			redirect("index");
		}
		$tintuc_detail = $d->fetch_array();
		$d->query("update #_content set luotxem = luotxem + 1 where id = $id");
		$title_bar=$tintuc_detail['ten_'.$lang].' - ';
		$title_cat=$tintuc_detail['ten_'.$lang];
		addingSeo($tintuc_detail);
		$bread->add($tintuc_detail['ten_'.$lang],getCurrentPageURL());

}
if(isset($_GET['id_danhmuc'])){
	$d->query("select id,ten_vi from #_product_brand where tenkhongdau = '".$_GET['id_danhmuc']."'");
	$r = $d->fetch_array();
	$bread->add($r['ten_vi'],getCurrentPageURL());
	$id_danhmuc = $r['id'];
	
}
