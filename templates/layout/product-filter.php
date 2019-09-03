<section id="product-search">
<form id="form-filter">
<!--	<div class="big-title"><?=_filter_to?></div> 
	<div class="clearfix"></div> -->
	<section class="block color-box">
		<div class="title text-upper"><span><?=_cungdm?></span></div> 
		<div class="clearfix"></div>
		<div class="content">
			<ul class="category">
			<?php 
				if($com=="san-pham"){
					
					
					$d->query("select id,tenkhongdau,ten_$lang from #_product_cat where hienthi > 0 and type='product' group by tenkhongdau order by stt desc ");
						if($d->num_rows()){
								foreach($d->result_array() as $k=>$v){
									echo '<li'.(($v['tenkhongdau']==@$_GET['id_cat']) ? ' class="active"' : '').'><a href="san-pham/category/'.$v['tenkhongdau'].'/" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
								}
							
							
						}
					
		
				}
				else{
					$d->query("select id,tenkhongdau,ten_$lang from #_product_cat where hienthi > 0 and type='product' group by tenkhongdau order by stt desc ");
						if($d->num_rows()){
								foreach($d->result_array() as $k=>$v){
									echo '<li'.(($v['tenkhongdau']==@$_GET['id_cat']) ? ' class="active"' : '').'><a href="san-pham/category/'.$v['tenkhongdau'].'/" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
								}
							
							
						}
					/*	
					$d->query("select id,ten_$lang,tenkhongdau from #_product_danhmuc where hienthi = 1 and type='out' order by stt desc");
					if($d->num_rows()){
						echo '<ul class="category">';
						foreach($d->result_array() as $k=>$v){
							
						?>
						<li class="top-heading <?=($_GET['id_danhmuc']==$v['tenkhongdau']) ? 'active' : ''?>">
						 <a href="hang-gia-cong/<?=$v['tenkhongdau']?>/" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a>
						
						<?php 
					
						echo ' <ul class="xnav">';
						$d->query("select id,ten_$lang,tenkhongdau from #_product_list where hienthi = 1 and type='out'  and id_danhmuc = ".$v['id']." order by stt desc");
							if($d->num_rows()){
								
									foreach($d->result_array() as $k2=>$v2){
										echo '<li class="t '.(($_GET['id_list']==$v2['tenkhongdau']) ? 'active' : '').'"><a href="hang-gia-cong/'.$v['tenkhongdau'].'/'.$v2['tenkhongdau'].'/" title="'.$v2['ten_'.$lang].'">&raquo;&nbsp;'.$v2['ten_'.$lang].'</a></li>';
									}
								
							}
						echo '</ul>';
						?>
					   
						
						<?php 
						echo '</li>';
					}
					echo '</ul>';
					}
					*/
				}
				?>
				</ul>
		</div>
	
	</section>
	
	<section class="block color-box" style="z-index:4">
	<div class="title"><span><?=_color?></span></div> 
		<div class="clearfix"></div>
		<div class="content">
			<?php 
			
				$d->query("select * from #_product_color where hienthi = 1 and noibat > 0 order by stt desc");
				$_xdata = array();
				if(isset($data_filter['color'])){
					$_xdata = explode(",",$data_filter['color']);
				}
				foreach($d->result_array() as $k=>$v){
						
					?>
						<div class="item">
							<div class='select-item color'>
							<label>
								<input type="checkbox" <?=(in_array($v['id'],$_xdata)) ? 'checked' : ''?> name="color[]" value="<?=$v['id']?>"/>
								
								<?=$v['ten_'.$lang]?>
							</label>
							</div>
						</div>
					
					<?php 
				}
			?>
		</div>
	
	</section>
	
	<section class="block price-box" style="z-index:3">
		<div class="title"><span><?=_price?></span></div> 
		<div class="clearfix"></div> 
		<div class="content transform">
			<?php 
				$_xdata = array();
				if(isset($data_filter['price'])){
					$_xdata = explode(",",$data_filter['price']);
				}
				$d->query("select * from #_product_price where hienthi = 1 order by stt desc");
				foreach($d->result_array() as $k=>$v){
					
					?>
					<div class="item">
						<div class='select-item'>
					<label>
					<input class="c-form-control-checkbox__input" <?=(in_array($v['id'],$_xdata)) ? 'checked' : ''?> id="filter-price-<?=$v['id']?>" type="checkbox" value="<?=$v['id']?>" name="price[]" >
						
<!--							<span class="c-form-control-checkbox__custom-box"></span> -->
						
								<?=$v['ten_'.$lang]?>
								
							
						</label>
						</div>
					</div>
					<?php
					/*
					<div class="price-line">
								<label for="poll-<?=$v['id']?>-price">
									<input type="radio" value="<?=$v['id']?>" name="price" id="poll-<?=$v['id']?>-price" > <span><?=$v['ten_'.$lang]?></span>
								</label>
							</div>	
					*/
					 
				}
				
			?>
			
		</div>
	
	</section>
	
	<section class="block size-box" style="z-index:2">
	<div class="title"><span>Size</span></div>
		<div class="clearfix"></div>
		<div class="content">
			<?php 
				$_xdata = array();
				if(isset($data_filter['size'])){
					$_xdata = explode(",",$data_filter['size']);
				}
				$d->query("select * from #_product_size where hienthi = 1 order by stt desc");
				foreach($d->result_array() as $k=>$v){
					?>
						<div class="item">
							<div class='select-item size'>
							<label>
								<input type="checkbox" <?=(in_array($v['id'],$_xdata)) ? 'checked' : ''?> name="size[]" value="<?=$v['id']?>"/>
								<?=$v['ten_'.$lang]?>
							</label>
							</div>
							<div class="clearfix"></div>
						</div>
						
					
					<?php 
				}
			?>
		</div>
	
	</section>
	<div class="clearfix"></div>
	<input type="hidden" name="ajaxfilter" />
	<input type="hidden" name="url" />
	<input type="hidden" name="token" value="<?=session_id()?>" />
	</form>
	<section class="hide">
		<div class="big-title"><?=_my_shopcart?></div>
		<section class="block white">
			<?=_alert_shopcart?>
		</section>
	
	
	</section>
	
<section class="hide">
		<div class="big-title"><?=_product_compare?></div>
		<section class="block white">
			<?=_alert_compare?>
		</section>
	
	
	</section>
	
	<section class="hide">
		<div class="big-title"><?=_keyword_featured?></div>
		<section class="block white">
			
		</section>
	
	
	</section>
	<?php 
					$d->query("select id,mota_$lang from #_content_danhmuc where hienthi = 1 order by stt desc limit 1");
					if($d->num_rows()){
						$r = $d->fetch_array();
					?>
	<section class="hide">
		<div class="big-title"><span>COMMUNITY POLL</span></div>
		<section class="block white">
		
			<div class="polling transform">
				<form method="post" action="" id="polling-form">
					<div class="poll-content"><?=nl2br($r['mota_'.$lang])?></div>
					<div class="clearfix"></div>
						<div class="col-xs-12">
					<?php 
						$d->query("select * from #_content where id_danhmuc  = ".$r['id']." and hienthi = 1 order by stt desc");
						foreach($d->result_array() as $k=>$v){
							?>
							<div class="line xline">
								<label for="poll-<?=$v['id']?>">
									<input type="radio" value="<?=$v['id']?>" name="pool" id="poll-<?=$v['id']?>" > <span><?=$v['ten_'.$lang]?></span>
								</label>
							</div>	
							<?php 
						}
					
					?>
					</div>
					<div class="poll-result">
						<div class="inner-result">
						
						</div>
						<div class="pick-result">
						<input type="hidden" name="cate" value="<?=$r['id']?>" />
						<input type="hidden" class="action" />
							<button type="button"  class="pull-left btn" data-act="submit"><?=_vote?></button>
							<button type="button" class="pull-right btn" data-act="view"><?=_view_result?></button>
							<div class="clearfix"></div>
							<div class="loading-spin">
							<i class="fa fa-spinne fa-spinner fa-spin"></i> Loading...
							</div>
						</div>
						
					
					</div>
				</form>
			</div>	
		</section>
	
					<?php } ?>
	
	</section>
	

	<input type="hidden" id='rel_url' value="<?=$rel_url?>" />
</section>