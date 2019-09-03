
                <div class="shopcart" id="box-shopcart">
                   
						<div class="column-labels">
						<label class="product-image">Hình ảnh</label>
						<label class="product-details">Sản phẩm</label>
						<label class="product-price">Đơn giá</label>
						<label class="product-quantity">Số lượng</label>
						
						<label class="product-line-price full">Tổng cộng</label>
						<div class="clearfix"></div>
						</div>
						<?php 
						$total=0;
                    foreach($_SESSION['cart'] as $k=>$v){
					$code  =$k;
                    $pid=$v['productid'];
                    $q=$v['qty'];					
                    $color = $v['color'];
                    $size = $v['size'];
                    $info=getProductInfo($pid);
                    $pname=get_product_name($pid);
                    $image = $config_url."/"._upload_sanpham_l.$info['thumb'];
                    if($color){
                    $img = getProductThumbnailWidthColor($pid,$color);
                    if($img){
						$image = $config_url.$img;
                    }
                    }
					$mx = $v['price']*$v['qty'];
					$total+=$mx;
                    if($q==0) continue;
                    ?>
					<div class="product" data-code="<?=$k?>" data-pid="<?=$pid?>">
					<div class="product-image">
					  <a href="<?=$config_url?>/san-pham/<?=changeTitle($pname)?>-<?=$pid?>.html"><img src="<?=$image?>"></a>
					</div>
					<div class="product-details">
					  <div class="product-title"><?=$pname?></div>
					  <p class="product-description ">
					  <?php
						if ($color) {
							
							echo '<div class="product-option">Màu sắc:&nbsp;'.$model->getColor($color,"name").'<div class="clearfix"></div></div>';
						}
						if ($size) {
							echo '<div class="product-option">Kích thước:&nbsp;'.$model->getSize($size,"name").'<div class="clearfix"></div></div>';
						}
						?>
					  </p>
					</div>
					<div class="product-price"><?=myformat($v['price'])?></div>
					<div class="product-quantity">
						<b><?=$q?></b> sản phẩm
					  
					</div>
					
					<div class="product-line-price full"><?=myformat($mx)?></div>
					<div class="clearfix"></div>
				  </div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
                   
<?php
}
$c = $model->getTotalPriceCart();
?>
<div class="totals">    
    <div class="totals-item totals-item-total total_cart_max">
     
	   <label>Tổng giá</label>
	   <div class="totals-value all-price" id="cart-total"><span class="price"><?=myformat($c['price'])?></span></div>

	   <label>Ship</label>
	   <div class="totals-value all-ship" id="cart-total"><span class="price"><?=myformat($ship)?></span></div> 
	   
	   <label>Tổng tiền thanh toán</label>
	   <div class="totals-value price-all" id="cart-total"><span class="price"><?=myformat($c['price']+$ship)?></span></div>
	   
	   
	 
    </div>
  </div>
	
<div class="clearfix"></div>
	
 </div>  
 
 