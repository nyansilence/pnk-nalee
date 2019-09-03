
		<div class="container" id="promotion-content">
		
			
			<div class="content">
				<div class="row-8">
				<?php 
					$d->query("select * from  #_discount where end_date> ".time()."  order by stt desc");
					
					$xtotal = $d->result_array();
					$total = count($xtotal);
					
					foreach($xtotal as $k2=>$v2){
						echo "<div class='col-xs-12 col-md-6 col-8 max-box'>";
							echo '<div class="box">';
								echo '<a href="khuyen-mai/'.changeTitle($v2['name']).'-'.$v2['id'].'.html" title="'.$v['name'].'"><img class="img-max" src="'._upload_news_l.$v2['photo'].'" /></a>';
							echo '</div>';
							echo '<div class="name">';
							echo '<a href="khuyen-mai/'.changeTitle($v2['name']).'-'.$v2['id'].'.html" title="'.$v['name'].'">'.$v2['name'].'</a>';
							echo '</div>';
						echo "</div>";
						if(($k2+1)%2==0){
							echo '<div class="clearfix"></div>';
						}
						
					}
				
				?>
			
				</div>
			</div>
		
		
		
		
		
		
		
		</div>
	