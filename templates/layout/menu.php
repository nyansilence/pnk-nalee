
<nav class="hidden-xs hidden-sm">
<div class="menu">
	<ul id="main-nav">
	
		
			<li class=""><a href="" title="<?=_home?>"><?=_home?></span></a></li>
			<li class="<?php if($com=='gioi-thieu'){ echo 'active';}?>"><a href="gioi-thieu.html" title="<?=_about?>"><?=_about?></span></a></li>
					
		
			
		<?php 
			$d->query("select id,ten_$lang,tenkhongdau,photo from #_product_danhmuc where hienthi = 1 and type='product' order by stt desc");
						if($d->num_rows()){
							
						
							$xp = $d->result_array();
								foreach($xp as $k=>$v){
									echo '<li class="f static"><a href="category/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
										$d->query("select id,ten_$lang,tenkhongdau,mini from #_product_list where hienthi = 1 and type='product'  and id_danhmuc = ".$v['id']." order by stt desc");
										if($d->num_rows()){
											$data = array();
											foreach($d->result_array() as $kx=>$vx){
												$data[($vx['mini']) ? 1 : 0][] = $vx;
												
											}
											
											$is_visible = 0;
											echo '<div class="menu"><ul>';
												foreach($data[0] as $k2=>$v2){
													echo '<li class="t"><h3>'.$v2['ten_'.$lang].'</h3>';
														$d->query("select id,ten_$lang,tenkhongdau from #_product_cat where hienthi = 1 and type='product'  and id_list = ".$v2['id']." order by stt desc");
														if($d->num_rows()){
															echo '<ul  class="menu-ca">';
																foreach($d->result_array() as $k3=>$v3){
																	echo '<li class="t"><a href="category/'.$v3['tenkhongdau'].'-'.$v3['id'].'.html" title="'.$v3['ten_'.$lang].'">'.$v3['ten_'.$lang].'</a></li>';
																}
															
															echo '</ul>';
														}
													
													
													echo '</li>';
													if($k2==2 && count($data[1])){
													
															echo '<li class="t">';
															foreach($data[1] as $k2=>$v2){
																echo '<div class="mini"><h3>'.$v2['ten_'.$lang].'</h3>';
																	$d->query("select id,ten_$lang,tenkhongdau from #_product_cat where hienthi = 1 and type='product'  and id_list = ".$v2['id']." order by stt desc");
																	if($d->num_rows()){
																		echo '<ul  class="menu-ca">';
																			foreach($d->result_array() as $k3=>$v3){
																				echo '<li class="t"><a href="category/'.$v3['tenkhongdau'].'-'.$v3['id'].'.html" title="'.$v3['ten_'.$lang].'">'.$v3['ten_'.$lang].'</a></li>';
																			}
																		
																		echo '</ul>';
																	}
																	echo '</div>';
																
																
																
															}
															echo '</li>';
															$is_visible = 1;
														}
													}
												
												if(!count($data[0]) || !$is_visible){
													echo '<li class="t">';
													foreach($data[1] as $k2=>$v2){
														echo '<div class="mini"><h3>'.$v2['ten_'.$lang].'</h3>';
															$d->query("select id,ten_$lang,tenkhongdau from #_product_cat where hienthi = 1 and type='product'  and id_list = ".$v2['id']." order by stt desc");
															if($d->num_rows()){
																echo '<ul   class="menu-ca">';
																	foreach($d->result_array() as $k3=>$v3){
																		echo '<li class="t"><a href="category/'.$v3['tenkhongdau'].'-'.$v3['id'].'.html" title="'.$v3['ten_'.$lang].'">'.$v3['ten_'.$lang].'</a></li>';
																	}
																	
																echo '</ul>';
															}
															echo '</div><div class="clearfix"></div>';
														
														
														
													}
													echo '</li>';
												}
											echo '</ul><div class="img-real"><img src="thumb/500x0/1/'._upload_product_l.$v['photo'].'" /></div></div>';
											?>
											
											
											
											<?php 
										}
										}
									
									echo '</li>';
								}
						
							
							
							?>
			
		
			

	<li  class=" <?php if($com=='khuyen-mai'){ echo 'active';}?>">
			<a href="khuyen-mai.html" title="<?=_promotion?>"><span><?=_promotion?></span></a>		
						
	</li>
	
	<li class=" <?php if($com=='tin-tuc'){ echo 'active';}?>"><a href="tin-tuc.html" title="<?=_news?>"><span><?=_news?></span></a></li>

			<li  class=" <?php if($com=='lien-he'){ echo 'active';}?>"	><a href="lien-he.html" title="<?=_contact?>"><span><?=_contact?></span></a></li>
			

	</ul>
	<div class="clearfix"></div>
</div>
	
	
</nav>

