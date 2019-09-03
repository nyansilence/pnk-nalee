<?php if(!isAjaxRequest()){
echo '<link href="assets/css/cart.css" type="text/css" rel="stylesheet" />';

if (@$_REQUEST['command'] == 'delete' && @$_REQUEST['pid'] > 0) {
    remove_product($_REQUEST['pid']);
} else if (@$_REQUEST['command'] == 'clear') {
    unset($_SESSION['cart']);
} else if (@$_REQUEST['command'] == 'update') {
    $max = count($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
        $pid = $_SESSION['cart'][$i]['productid'];
        $q = intval($_REQUEST['product' . $pid]);
        if ($q > 0 && $q <= 999) {
            $_SESSION['cart'][$i]['qty'] = $q;
        } else {
            $msg = 'Some proudcts not updated!, quantity must be a number between 1 and 999';
        }
    }
}
?>
<script language="javascript">
    function del(pid) {
        if (confirm('Do you really mean to delete this item')) {
            document.form1.pid.value = pid;
            document.form1.command.value = 'delete';
            document.form1.submit();
        }
    }
    function clear_cart() {
        if (confirm('This will empty your shopping cart, continue?')) {
            document.form1.command.value = 'clear';
            document.form1.submit();
        }
    }
    function update_cart() {
        document.form1.command.value = 'update';
        document.form1.submit();
    }

    function goBack()
    {
        window.history.back()
    }
</script>
<div class="container">












<div class="shop container">
	
    <div class="box_containerlienhe"> 
	
	<div class="">
		<div class="row form-group">
			<div class="col-xs-12">
				<ul class="nav nav-pills nav-justified thumbnail setup-panel">
					<li class="active"><a href="javascript:void(0)">
						<h4 class="list-group-item-heading"><?=_step?> 1</h4>
						<p class="list-group-item-text"><?=_xacnhandonhang?></p>
					</a></li>
					<li class="disabled"><a href="javascript:void(0)">
						<h4 class="list-group-item-heading"><?=_step?> 2</h4>
						<p class="list-group-item-text"><?=_thongtinthanhtoan?></p>
					</a></li>
					<li class="disabled"><a href="javascript:void(0)">
						<h4 class="list-group-item-heading"><?=_step?> 3</h4>
						<p class="list-group-item-text"><?=_hinhthucthanhtoan?></p>
					</a></li>
				</ul>
			</div>
		</div>
	
	</div>	
	
	 <div class="title-global"><h2><?= _giohang ?></h2><div class="clearfix"></div></div>
        <div class="content " id="box-shopcart">
		<?php }
		
			
		
		?>

            <form name="form1" method="post">
                <div class="shopcart" id="box-shopcart">
                    <?php 
					
                    if(is_array($_SESSION['cart']) & count($_SESSION['cart']) > 0){
						?>
						<div class="column-labels">
						<label class="product-image">Hình ảnh</label>
						<label class="product-details">Sản phẩm</label>
						<label class="product-price">Đơn giá</label>
						<label class="product-quantity">Số lượng</label>
						<label class="product-removal ">Xóa</label>
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
                    $image = _upload_sanpham_l.$info['thumb'];
                    if($color){
                    $img = getProductThumbnailWidthColor($pid,$color);
                    if($img){
                    $image = $config_url.$img;
                    }
                    }
					$mx = $v['price']*$v['qty'];
					$total+=$mx;
                   
                    ?>
					<div class="product" data-code="<?=$k?>" data-pid="<?=$pid?>">
					<div class="product-image">
					  <img src="<?=$image?>">
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
					
						$max_qty = $model->checkProductAvailable($pid,$color,$size);
						
						?>
						
						<div class="available red small">Tối đa <?=$max_qty?> sản phẩm</div>
					  </p>
					</div>
					<div class="product-price"><?=myformat($v['price'])?></div>
					<div class="product-quantity">
					  <input type="number" class="" max="<?=$max_qty?>"  name="product[<?=$code?>]" value="<?=$q?>" min="1">
					  <button class="is_update" onclick="updateCart()"><i class="fa fa-refresh"></i></button>
					</div>
					<div class="product-removal ">
					  <button class="remove-product " onclick="deleteCart('<?= $k ?>')">
						<i class="fa fa-trash"></i>&nbsp;Xóa
					  </button>
					</div>
					<div class="product-line-price full"><?=myformat($mx)?></div>
					<div class="clearfix"></div>
				  </div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
                   
<?php
}
$c = $model->getTotalPriceCart();
?>
<div class="totals">    
    <div class="totals-item totals-item-total">
      <label>Tổng cộng</label>
      <div class="totals-value" id="cart-total"><?=myformat($c['price'])?></div>
    </div>
  </div>
	<div class="pull-right footer-cart">
                        
                            <button type="button" onclick="window.location = '<?= $config_url ?>/san-pham.html'" class="button"><i class="fa fa-shopping-bag"></i>&nbsp;<?=_muatiep?></button><button type="button" onclick="clearCart()" class="button"><i class="fa fa-times"></i>&nbsp;<?= _xoatatca ?></button><button type="button" onclick="updateCart()" class="button"><i class="fa fa-refresh"></i>&nbsp;<?= _capnhat ?></button><button type="button" onclick="window.location = '<?= $config_url ?>/thanh-toan.html'" class="button"><i class="fa fa-credit-card-alt"></i>&nbsp;<?= _thanhtoan ?></button>
</div>	
<div class="clearfix"></div>
                    <?php 
                    }else{
                   
                    echo "<div class='alert alert-danger'>Không có sản phẩm nào trong giỏ hàng!</div>";
                    }
                    ?>
                	
			
            </form>
			<?php if(!isAjaxRequest()){ ?>
			</div>
			<div class="clearfix"></div>
			</div>
</div>
</div>
























</div>

	<?php } ?>