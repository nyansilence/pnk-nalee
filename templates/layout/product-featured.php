
<div id="featured-product" class='rel'>
	<div class='wrap-title'>
		<div class="title"><a href="san-pham-tieu-bieu.html" title="Sản phẩm tiêu biểu">Sản phẩm tiêu biểu</a></div>
	</div>
	<div class="inner">
		<div class="list">
<?php 
		$d->query("select ten_$lang,photo,id,tenkhongdau from #_product where hienthi = 1 and noibat > 0 order by stt desc limit 10");
		foreach($d->result_array() as $k=>$v){
			?>
			<div class="item">
				<div class="inner-item">
					<div class="rel">
						<a href="san-pham/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
							<img src="thumb/250x180/2/<?=_upload_sanpham_l.$v['photo']?>" alt="<?=$v['ten_'.$lang]?>"/>
						</a>
						<div class="name">
							<h3><a href="san-pham/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a></h3>
						</div>
					</div>
				</div>
			</div>
			
			<?php 
			
		}
	?>
		</div>
	</div>
</div>	
	