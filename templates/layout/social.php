<?php
	$d->reset();
	$d->query("select * from #_social where hienthi = 1"); 
	$social = $d->result_array();
	?>
	
	<div id="social-air">
		<?php foreach($social as $k=>$v){
			echo '<a href="'.$v['link'].'" title="'.$v['ten'].'" target="_blank"><i class="fa fa-'.$v['small_image'].'"></i></a>';		
		}
		?>
	<?php 

								$x = ($lang=="vi") ? 'en' : 'vi';

								$suf = ($x=="en") ? 'Engslish' : 'Vietnamese';

							?>

							 <a style="color:#fff" href="?com=ngonngu&lang=<?=$x?>" title="Choose <?=$suf?>"><i class="fa fa-globe"></i></a>
	</div>	
	