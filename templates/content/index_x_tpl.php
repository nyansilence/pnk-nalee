<div class="container">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="title-global"><h1><span><?=$title_cat?></span></h1></div>
	
	<div id="list-news" class="">
		<div class="row-8">
			<?php 
				$i=0;
				foreach($tintuc as $k=>$v){
					$i++;
					?>
					<div class="col-xs-6 col-md-4 col-8 ">
						<div class="item">
							<div class="img">
								<a href="<?=$com?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
									<img src="thumb/365x205/1/<?=_upload_news_l.$v['photo']?>" alt="<?=$v['ten_'.$lang]?>" />
								</a>
							</div>
							<div class="desc">
								
								<h2><a href="<?=$com?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a></h2>
								<div class="date">
									<i class="glyphicon glyphicon-time"></i>&nbsp;<?=date("d-m-Y h:i",($v['ngaytao']))?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$v['luotxem']?> View
								</div>
								<div class="inner-desc">
									<?=cutString(strip_tags($v['mota_'.$lang]),170)?>								
								</div>								
							</div>
						</div>					
					</div>					
					<?php 
					if($i%2==0){
						echo '<div class="visible-sm visible-xs clearfix"></div>';
					}
					if($i%3==0){
						echo '<div class="visible-lg visible-md clearfix"></div>';
					}
				}			
			?>
<div class="clearfix"></div>			
		</div>
		<?=$paging['paging']?>
	</div>

</div>

