<?php

	$sql = "select * from #_letruot where hienthi = 1 and letruot = 'trai'";
	$d->query($sql);
	$rs = $d->result_array();

		$sql = "select * from #_letruot where hienthi = 1 and letruot = 'phai'";
	$d->query($sql);
	$rs2 = $d->result_array();
	?>	
<?php
if(count($rs) > 0){
	echo '<div class="adv advss" style="    -moz-transition: margin .2s;
    -webkit-transition: margin .2s;
    -ms-transition: margin .2s;
    -o-transition: margin .2s;
    transition: margin .2s;width:150px;top:0;z-index: 1;">';
	foreach($rs as $k=>$v){
	echo '<a href="'.$v['link'].'" target="_blank" ><img style="margin-bottom:5px" class="img-reponsive" src="'._upload_hinhanh_l.$v['photo'].'" /></a>';
	}
	echo '</div>';
	
}
if(count($rs2) > 0){
	echo '<div class="adv advss is-right" style="width:150px;top:0;z-index: 1;    -moz-transition: margin .2s;
    -webkit-transition: margin .2s;
    -ms-transition: margin .2s;
    -o-transition: margin .2s;
    transition: margin .2s;">';
	foreach($rs2 as $k=>$v){
	echo '<a href="'.$v['link'].'"  target="_blank"><img style="margin-bottom:5px" class="img-rpx img-responsive" sive"  src="'._upload_hinhanh_l.$v['photo'].'" /></a>';
	}
	echo '</div>';
	
}
	
?>
<script src="assets/js/advs.js" type="text/javascript"></script>