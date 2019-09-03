<?php
$d->reset();
if($com=="hang-gia-cong"){
	$slider_type = "out";
}
$stype = (isset($slider_type)) ? $slider_type : 'slider';
$d->query("select * from #_slider where hienthi = 1	and type='$stype' order by stt,id desc");
$slider = $d->result_array();
?>
<div id="slider-camera-wrapper">


	<div class="left-slider">
	<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
		<ul>
		<?php 
			foreach($slider as $k=>$v){
			?>
			<li><a href="<?=$v['link']?>" title="<?=$v['ten']?>"><img src="<?=_upload_hinhanh_l.$v['photo']?>" alt="<?=$v['ten']?>" style="width:100%" /></a></li>
		
			<?php 
		}
		?>
		</ul>
    </div><!-- #camera_wrap_1 -->
    </div>
    <div class="right-slider">
		<?php 
			$d->query("select link,photo from #_slider where type='ads' and hienthi > 0 order by stt desc limit 2");
			foreach($d->result_array() as $k=>$v){
				echo '<div class="item"><a href="'.$v['link'].'" title="'.$v['ten'].'"><img src="thumb/500x0/1/'._upload_hinhanh_l.$v['photo'].'" class="img-responsive"></a></div>';
			}
		?>
    	
    </div>

<div class="clearfix"></div>

</div>

