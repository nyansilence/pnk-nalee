<?php 
	
	if(isset($_GET['id_danhmuc'])){
	$d->query("select ten_$lang,id from #_content_danhmuc where hienthi = 1 and type = 'outsource' and tenkhongdau='".mysql_real_escape_string($_GET['id_danhmuc'])."'  order by stt desc");
	}else{
	$d->query("select ten_$lang,id from #_content_danhmuc where hienthi = 1 and type = 'outsource'  order by stt desc");
	}
	
	foreach($d->result_array() as $k=>$v){
		?>
		<div class="container" id="outsource-content">
		
			<div class="title"><?=$v['ten_'.$lang]?></div>
			<div class="content">
				<div class="row-8">
				<?php 
					$d->query("select ten_$lang,photo,id,link from #_content where id_danhmuc = '".$v['id']."' and hienthi  = 1 order by stt desc");
					
					$xtotal = $d->result_array();
					$total = count($xtotal);
					$cls = "col-xs-12 col-md-12 col-8 xbox";
					if($total == 2){
						$cls = "col-xs-12 col-md-6 col-8 xbox";
					}
					if($total == 3){
						$cls = "col-xs-6 col-md-4 col-8 xbox";
					}
					if($total == 4){
						$cls = "col-xs-6 col-md-3 col-8 xbox";
					}
					foreach($xtotal as $k2=>$v2){
						echo "<div class='$cls'>";
							echo '<div class="box">';
								echo '<a href="'.$v2['link'].'" title="'.$v2['ten_'.$lang].'"><img class="img-max" src="'._upload_news_l.$v2['photo'].'" /></a>';
							echo '</div>';
						
						echo "</div>";
						
					}
				
				?>
			
				</div>
			</div>
		
		
		
		
		
		
		
		</div>
		<?php 
	}

?>