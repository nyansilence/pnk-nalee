<?php
$d->reset();
$d->query("select * from #_slider where hienthi = 1	and type='slider' order by stt,id desc");
$slider = $d->result_array();
?>





<div id="slider-wrapper">
		<div id="layerslider" style="width:100%;height:465px;max-width: 1366px;">
			
			<?php 
				foreach($slider as $k=>$v){?>
			<div class="ls-slide" data-ls="slidedelay:4000;transition2d:4;">
				<img src="<?=_upload_hinhanh_l.$v['photo']?>" class="ls-bg" alt="Slide background"/>
				<p class="ls-l" style="top:40%;left:20%;font-weight: 300;font-size:30px;color:#ffffff;white-space: nowrap;text-align:left" >
					introducing
				</p>
				<p class="ls-l" style="top:50%;left:20%;font-weight: 300;font-size:50px;color:#ffffff;white-space: nowrap;text-align:left">
					PARALLAX LAYERS
				</p>
				
			</div>
				<?php } ?>
				
		</div>
	</div>