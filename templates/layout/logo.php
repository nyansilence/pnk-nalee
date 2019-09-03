<section>

<?php
	$d->reset();
	$d->query("select * from #_doitac where hienthi = 1 order by stt,id desc");
	$logo = $d->result_array();

	
?>
<div id="wrap-logo">
<div class="" id="logo-partne">
<div class="">
<div class="title"><h2>
<?=_logo_doitac?>
</h2>

</div>
		<ul id="flexiselDemo3">
			<?php
			foreach($logo as $k=>$v){
				echo '<li class="wow fadeInUp " data-wow-offset="100" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s"><div><div class="inner-target"><a target="_blank" title="'.$v['ten'].'" href="'.$v['link'].'"><img src="thumb/200x140/2/'._upload_hinhanh_l.$v['photo'].'" /></a></div></div></li>';
			}
		
		
		?>
		
			
		</ul>    

		<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		</div>
</div>
		</section>