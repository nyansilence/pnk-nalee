<link rel="stylesheet/less" type="text/css" href="assets/css/less/news.less">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
<div class="container">
<div class="news-content">
	<div class="">
		<div class="title-global">
			<h1><?=$tintuc_detail['ten_'.$lang]?></h1>
			
			<?php include _template."layout/share.php";?>
		</div>
		
  
<div class="clearfix"></div>

<?php 

	$d->query("select * from #_lookbook where id_content = '".$tintuc_detail['id']."' order by id asc");
	$data = $d->result_array();
	
	foreach($data as $k=>$v){
		echo '<div class="row"><div class="item item-'.$v['typex'].'">';
		$img = explode(",",$v['photos']);
		$link = explode(",",$v['links']);
		$desc = json_decode($v['mota_'.$lang],true);
		if($v['typex']==1){
			
			?>
				<div class="item item-1 item-1a col-xs-4 col-xs-offset-1  left-item">
						
						<div class="desc desc-1a"><?=$desc[0]?></div>
						<div class="img">
							
							<a href="<?=-$link[0]?>"><img class="img-responsive" src="<?=$img[0]?>" /></a>
						</div>
						<div class="bigdesc desc-1">
							<?=$v['mota_big_'.$lang]?>
						</div>				
				</div>				
				<div class="col-xs-5  right-item">
					<div class="img">
						<div class="desc desc-1b"><?=$desc[1]?></div>
						<img class="img-responsive" src="<?=$img[1]?>" />
						
					</div>
				</div>
				
				
					
			
			
			<?php 
		}
		
		if($v['typex']==2){
			
			?>
				<div class="col-xs-5 col-xs-offset-1 left-item">
					<div class="img">
						<div class="desc desc-2a"><?=$desc[0]?></div>
						<a href="<?=-$link[0]?>"><img class="img-responsive" src="<?=$img[0]?>" /></a>
					</div>
					<div class="space"></div>
					<div class="img">
						<div class="desc desc-2b"><?=$desc[1]?></div>
						<a href="<?=-$link[1]?>"><img class="img-responsive" src="<?=$img[1]?>" /></a>
					</div>
					<div class="space"></div>
					<div class="img">
						<div class="desc desc-2c"><?=$desc[2]?></div>
						<a href="<?=-$link[2]?>"><img class="img-responsive" src="<?=$img[2]?>" /></a>
					</div>						
				</div>			
				<div class="col-xs-5  right-item">
					<div class="bigdesc desc-2">
							<?=$v['mota_big_'.$lang]?>
					</div>
					<div class="img">
						<div class="desc desc-2d"><?=$desc[3]?></div>
						<a href="<?=-$link[3]?>"><img class="img-responsive" src="<?=$img[3]?>" /></a>
					</div>
									
				</div>
				
				
					
			
			
			<?php 
		}
		
		if($v['typex']==3){
			
			?>
				<div class="col-xs-10 col-xs-offset-1">
					<div class="bigdesc desc-3">
							<?=$v['mota_big_'.$lang]?>
					</div>
					<div class="img">
						<div class="desc desc-3"><?=$desc[0]?></div>
						<a href="<?=-$link[0]?>"><img class="img-responsive" src="<?=$img[0]?>" /></a>
					</div>
															
				</div>			
				
					
			
			
			<?php 
		}
		if($v['typex']==4){
			
			?>
				
				<div class="item-4a col-xs-5 left-item col-xs-offset-1">
						<div class="img">
							<div class="desc desc-4a"><?=$desc[0]?></div>						
							<a href="<?=-$link[0]?>"><img class="img-responsive" src="<?=$img[0]?>" /></a>

						</div>
						
				</div>				
				<div class="item item-4 item-4b col-xs-4  ">
					<div class="bigdesc desc-4">
							<?=$v['mota_big_'.$lang]?>
					</div>
					<div class="img">
						<div class="desc desc-4b"><?=$desc[1]?></div>
						<a href="<?=-$link[1]?>"><img class="img-responsive" src="<?=$img[1]?>" /></a>
					
					</div>
						
				</div>
				
				
					
			
			
			<?php 
		}
		if($v['typex']==5){
			
			?>
					
				<div class="col-xs-5 left-item col-xs-offset-1">
				<div class="bigdesc desc-5">
							<?=$v['mota_big_'.$lang]?>
				</div>	
						<div class="img">
							<div class="desc desc-5a"><?=$desc[0]?></div>
							<a href="<?=-$link[0]?>"><img class="img-responsive" src="<?=$img[0]?>" /></a>
						</div>
						
				</div>				
				<div class="col-xs-5   right-item">
					<div class="img">
						<div class="desc desc-5b"><?=$desc[1]?></div>
						<a href="<?=-$link[1]?>"><img class="img-responsive" src="<?=$img[1]?>" /></a>
					
					</div>
							
				</div>
				
				
					
			
			
			<?php 
		}
		if($v['typex']==6){
			?>
				<div class="col-xs-5 col-xs-offset-1 left-item">
					<div class="img">
						<div class="desc desc-6a"><?=$desc[0]?></div>
						<a href="<?=-$link[0]?>"><img class="img-responsive" src="<?=$img[0]?>" /></a>
					
					</div>
					<div class="space"></div>
					<div class="img">
						<div class="desc desc-6b"><?=$desc[1]?></div>
						<a href="<?=-$link[1]?>"><img class="img-responsive" src="<?=$img[1]?>" /></a>
					</div>
					<div class="space"></div>
										
				</div>			
				<div class="col-xs-5  right-item">
					<div class="bigdesc desc-6">
							<?=$v['mota_big_'.$lang]?>
					</div>				
					<div class="img">
						<div class="desc desc-6c"><?=$desc[2]?></div>
						<a href="<?=-$link[2]?>"><img class="img-responsive" src="<?=$img[2]?>" /></a>
					</div>
					
				</div>
				
				
					
			
			
			<?php 
		}
		
		?>
		
		
		
		
		
		
		<?php 
		echo '<div class="clearfix"></div>';
		echo '</div></div>';
	}

?>

		<div class="content">   
			
			<?=$model->autoAddSeoTags($tintuc_detail['noidung_'.$lang])?> 
<div id="fb-root"></div>
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=580130358671180&version=v2.3";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
								
			
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
