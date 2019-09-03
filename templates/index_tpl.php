
<?php 
	$d->query("select photo,ten,link from #_slider where type='index' and hienthi > 0 order by stt desc");
	$banners = $d->result_array();
	if(count($banners) > 0){
		?>
		<section id="index-banner">
			<div class="container">
				<div class='row'>
				<?php 
					foreach($banners as $k=>$v){
						?>
						
						<div class="col-md-4 col-sm-4 col-xs-6 item-banner">
							<div class="inner">
								<a href="<?=$v['link']?>" title='<?=$v['ten']?>'><img src="thumb/500x370/1/<?=_upload_hinhanh_l.$v['photo']?>" class="img-responsive" alt='<?=$v['ten']?>' /></a>
							</div>	
						</div>
						<?php 
					}
				
				
				?>
				<div class='clearfix'></div>
			</div>
			</div>
		</section>
		<?php 
	}
	?>
<section id="new-product">
	<div class="container">
		<div class='title-global'><h2>Sản phẩm noi bat</h2></div>
		<div class="clearfix"></div>
		<div class="row-8">
			<?php 
				$d->query("select ten_$lang,id,giacu,gia,photo,photo2,new,tenkhongdau from #_product where noibat > 0 and hienthi > 0 and new > 0 order by stt desc");
				foreach($d->result_array() as $k=>$v){
					$model->showProduct($v,array("class"=>"col-xs-12 col-md-3 col-sm-4 item-product col-8"),$k);
					
				}
			
			?>
		
		</div>
	
	</div>


</section>
<section id="new-product">
	<div class="container">
		<div class='title-global'><h2>Sản phẩm mới</h2></div>
		<div class="clearfix"></div>
		<div class="row-8">
			<?php 
				$d->query("select ten_$lang,id,giacu,gia,photo,photo2,new,tenkhongdau from #_product where hienthi > 0 and new > 0 order by stt desc");
				foreach($d->result_array() as $k=>$v){
					$model->showProduct($v,array("class"=>"col-xs-12 col-md-3 col-sm-4 item-product col-8"),$k);
					
				}
			
			?>
		
		</div>
	
	</div>


</section>


<section id="new-product">
	<div class="container">
		<div class='title-global'><h2>Sản phẩm bán chạy</h2></div>
		<div class="clearfix"></div>
		<div class="row-8">
			<?php 
				$d->query("select ten_$lang,id,giacu,gia,photo,photo2,new,tenkhongdau from #_product where hienthi > 0 and noibat > 0 order by stt desc");
				foreach($d->result_array() as $k=>$v){
					$model->showProduct($v,array("class"=>"col-xs-12 col-md-3 col-sm-4 item-product col-8"),$k);
					
				}
			
			?>
		
		</div>
	
	</div>


</section>



<section id="customer-gallery">
	<div class="container">
		<div class='title-global'><h2 class="no-after"><i class="fa fa-heart"></i>&nbsp;Album Bé Gấu Shop&nbsp;
		<i class="fa fa-heart"></i></h2></div>
		<div class="clearfix"></div>
		<div class="row-5" id="list-customer">
			
			<?php 
				foreach(getPhoto("customer") as $k=>$v){
					echo '<div class="item col-md-4 col-sm-4 col-xs-6 col-5 wow fadeInUp" 
					data-wow-offset="100" data-wow-duration="1" data-wow-delay="'.(0.1*$k).'s">
						<div class="ads-item-wrapper"><div class="ads-item">
						<a href="'._upload_hinhanh_l.$v['photo'].'" rel="fancybox"><img class="img-max" 
						src="thumb/373x0/1/'._upload_hinhanh_l.$v['photo'].'"/></a>
					</div></div></div>';
					
					
				}
			
			?>
			
		</div>
	
	</div>


</section>
<section id="newsletter-c">
	<div class="min-container container">
		<?php 
			$b = getBaiviet(20);
		?>
		<div class="row">
		<div class="col-md-8 col-xs-12">
			<a href="bai-viet/<?=$b['tenkhongdau']?>-<?=$b['id']?>.html" title="<?=$b['ten_'.$lang]?>"><img src="<?=_upload_news_l.$b['photo']?>" alt="<?=$b['ten_'.$lang]?>" class="img-max"/></a>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="form-letter text-center">
				<form class="newsletter-form">
					<div class="has-icon"><i class="fa fa-envelope-o"></i></div>
					<div class="title">THEO DÕI NHỮNG THÔNG TIN MỚI NHẤT CỦA CHÚNG TÔI</div>
					<div class="input">
						<input type="email" required name="email" placeholder="Nhập địa chỉ email" />
					</div>
					<div class="button">
						<button type="submit">THEO DÕI</button>
					</div>
					<div class="desc">
						Theo dõi để cập nhật những bộ sưu tập và các chương trình khuyến mãi nhanh nhất!
					</div>
				</form>
			</div>
		</div>
		</div>
		
	</div>

</section>
