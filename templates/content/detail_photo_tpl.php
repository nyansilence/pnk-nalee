<link href="assets/plugins/unitegallery/css/unite-gallery.css" type="text/css" rel="stylesheet" />
<link href="assets/plugins/unitegallery/themes/default/ug-theme-default.css" type="text/css" rel="stylesheet" />
<script src="assets/plugins/unitegallery/js/unitegallery.min.js"></script>
<script src="assets/plugins/unitegallery/themes/default/ug-theme-default.js"></script>

<div class="box_containerlienhe">
<div class="">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div></div>


<div class="clearfix"></div>
<div class="">

			
			
			<div class="">
			<div id="gal_11161" class="md-gallery" style="display:none">
			
			<?php
				$gal = objectToArray(json_decode($tintuc_detail['gallery']));
				$i=0;
				foreach($gal as $k=>$v){
					
					echo '<img data-image="'.$config_url."/".$v.'" src="'.$config_url."/".$v.'" />';
				
					
					
				}
			
			?>
			
			</div>

		</div>
</div>
<div class="clear"></div>
</div>
</div>
<script>
$().ready(function(){
	$(".md-gallery").unitegallery({
		gallery_width:880,							//gallery width		
		gallery_height:650,							//gallery height
		thumb_fixed_size:false,
		slider_scale_mode:'fit',
		
	
		
	});
		
		
});


</script>
