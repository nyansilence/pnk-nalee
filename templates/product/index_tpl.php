<div class="container">
	<div class="">
		<div class="top-filter">
				<?php 
				include _template."layout/product-filter.php"
			?>
			</div>
		<div class = "left-column">
			
				<div class="wrap-all-product">
				<div class="title-global">
					<h1><?=$title_cat?></h1>
				</div>
				<?php 
					if(isset($titlex['noidung_'.$lang])){
						echo '<div class="description">';
							echo $titlex['noidung_'.$lang];
						
						echo '</div>';
					}
				?>
				<div class="clearfix"></div>
				<div id="product-wrap">
					
						<div class="row inner row-8">
							<?php foreach($product as $k=>$v){ 
								$model->showProduct($v,array(),$k);
							} ?>
							<div class="clearfix"></div>
						</div>
						<div class="paging-place">	
							<?=$paging?>
						</div>
				 
					<!-- end col-xs-12-->
					<div class="clearfix"></div>
				</div>
			</div>
			</div>
			
		
	</div>


</div>
