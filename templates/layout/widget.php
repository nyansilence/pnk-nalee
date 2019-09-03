<?php 
	if($template=="product/detail"){?>
	
	
	
	<div id="nav-best-product">
					<div class="tab-control">
						<div class="container">
							<ul>
								<li class="active">
									<a href="#new" title="<?=_otherproducts?>">
										<?=_otherproducts?>
									</a>
								</li>
								
							</ul>
						</div>
					</div>
					<div class="tab-content">
						<div class="container">
						<div class='tab active' id='new'>
							<div class="list">
							<?php 
								
								foreach($same_product as $k=>$v){
									showProduct($v,array("class"=>"item item-product"));
								}
							
							?>
							</div>
						
						</div>
						
						<div class="clearfix"></div>
						</div><!-- end container -->
					</div>
					
				</div>
	
	
	
	
	
	
	
	<?php } ?>


<div class="container">
<div id="widget">
	<div class="row">
		<div class="col-xs-12 col-md-9 ">
			<div class="mini-fi">
				<div class="row">
					<div class="desc col-xs-12 col-md-8">
						<span><?=_phuongcham?></span>
					</div>
					<div class="link col-xs-12 col-md-4">
						<a href="lien-he.html" title="Liên hệ"><?=_lienhe_vschungtoi?></a>
					</div>
					<div class="clearfix"></div>	
	
				</div>

			</div><!-- end minifi -->
			<div class="clearfix"></div>
			
			<div id="newsletter-widget">
				<div class="">
					<div class="col-xs-12 col-md-5" style="border-right:1px solid #ccc">
						<div class="box">
						<div class="small-title"><?=_project?></div>
						<div class="content">
							<div class="list-feedback">
								<?php 
									$d->query("select ten_$lang,mota_$lang,tenkhongdau,id,ngaytao,photo from #_content where type='feedback' and hienthi = 1 order by stt desc ");
									foreach($d->result_array() as $k=>$v){
										?>
										<div class="item">
											<div class="row-5">
												<div class="col-xs-12 col-5">
													<img src="thumb/400x200/1/<?=_upload_news_l.$v['photo']?>" class="img-responsive" alt="<?=$v['ten_'.$lang]?>" />
												</div>	
												<div class="col-xs-12 col-5">
													<span class="name"><a href="cong-trinh-tieu-bieu/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a></span>
													<div class="clearfix"></div>
													<div class="desc">
														<?=$v['mota_'.$lang]?>
													</div>
												
												</div>
												<div class="clearfix"></div>
												
											</div>
										</div>
										
										<?php 
									}
								
								?>
							
							</div>
						
						</div>
					</div><!--- end box-->
					</div>
					
					<div class="col-xs-12 col-md-7">
						<div class="box">
						<div class="small-title">Video</div>
						<div class="content ">
							
							<?php 
					$d->query("select * from #_video where hienthi = 1 order by stt desc");
					$rs_video  =$d->result_array();
													
					echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" id="iframe"  src="https://www.youtube.com/embed/'.getYoutubeIdFromUrl($rs_video[0]['link']).'" frameborder="0" allowfullscreen></iframe></div>';
				 ?>
					<select class="form-control" id="video-control">
					<?php 
					foreach($rs_video as $k=>$v){
					echo '<option value="'.getYoutubeIdFromUrl($v['link']).'">'.$v['ten_'.$lang].'</option>';
					   }
					?>
					</select>
					<script>
						$().ready(function(){
						$("#video-control").change(function(){
						$("#iframe").attr("src","https://www.youtube.com/embed/"+$(this).val()+"?autoplay=1");									})
													})
					</script>
						
						</div>
						</div><!-- end box-->
					</div>
					
					<div class="clearfix"></div>
				
				</div>
			
			</div>
			
		</div>
		<div class="col-xs-12 col-md-3" id="news" style="padding-top: 15px;">
			<div class="big-title"><?=_hotnews?></div>
			<div class="content">
	<div class="news-list-ow">
	
				<?php 
					$d->query("select ten_$lang,tenkhongdau,id,photo,mota_$lang from #_content where type='news' and hienthi = 1 order by noibat desc,stt desc limit 5");
foreach($d->result_array() as $k=>$v){
	echo '<div class="item">';
		echo '<div class="item-news">';
			echo '<div class="img"><a href="tin-tuc/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'"><img src="thumb/250x110/1/'._upload_news_l.$v['photo'].'" alt="'.$v['ten_'.$lang].'" /></a></div><!-- end img-->';
			echo '<div class="desc">
					<h3><a href="tin-tuc/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h3>
					'.cutString(strip_tags($v['mota_'.$lang]),150,' ').'


					</div><!-- end desc-->';

echo '</div>';
	echo '</div>';
}

				?>


				
			</div><!-- end news-list-ow-->
			</div>

		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>