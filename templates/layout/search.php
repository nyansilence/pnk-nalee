<div class="col-xs-12">
<div id="advance-search">
	<div class="row">
		<div class="col-xs-12 col-md-4 pull-right">
			<div class="hotline-wrapper">
			<div class="xc"><i class="fa fa-phone" aria-hidden="true"></i></div>
				<span><?=$rs_hotline['hotline_'.$lang]?></span>
				<div>8:00AM - 17:00PM</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-8">
			<div class="search-form">
				<form id="adv-search">
					<input type="text" name="keyword" value="<?=@$_GET['keyword']?>" placeholder="Nhập từ khóa cần tìm" />
					<select name="category">
						<option value="0">Danh mục sản phẩm</option>
						<?php 
							$d->query("select id,ten_$lang as name from #_product_danhmuc where hienthi > 0 order by noibat desc,stt desc");
							foreach($d->result_array() as $k=>$v){
								$slt = (@$_GET['category']==$v['id']) ? 'selected' : '';
								echo '<option value="'.$v['id'].'" '.$slt.'>'.$v['name'].'</option>';
							}
						?>
					</select>
					<select name="price">
						<option value="0">Chọn giá</option>
						<?php 
							$d->query("select id,ten_$lang as name from #_product_price where hienthi > 0 order by stt desc");
							foreach($d->result_array() as $k=>$v){
								$slt = (@$_GET['price']==$v['id']) ? 'selected' : '';
								echo '<option value="'.$v['id'].'" '.$slt.'>'.$v['name'].'</option>';
							}
						?>
					</select>
					<button type="submit">Tìm kiếm</button>
					
				
				</form>
			</div>
		</div>
		<div class="clearfix"></div>
		
		
	
	</div>

</div>
</div>
<div class="clearfix"></div>