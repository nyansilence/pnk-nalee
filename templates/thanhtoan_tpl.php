<link href="assets/css/cart.css" type="text/css" rel="stylesheet" />

<style>
	table#tt td
	{
		height:30px;
	}
	table#tt td input.t
	{
		width:300px;
		height:20px;
		margin:3px 0px 5px 0px;
		border:1px solid #DDD;
	}
	table#tt span
	{
		color:red;

	}
</style>
<div class="container">

<div class="box_containerlienhe shop">
<div class="">
		<div class="row form-group">
			<div class="col-xs-12">
				<ul class="nav nav-pills nav-justified thumbnail setup-panel">
					<li class="disabled"><a href="javascript:void(0)">
						<h4 class="list-group-item-heading"><?=_step?> 1</h4>
						<p class="list-group-item-text"><?=_xacnhandonhang?></p>
					</a></li>
					<li class="active"><a href="javascript:void(0)">
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
<div class="title-global"><h2><?=_checkout?></h2><div class="clearfix"></div></div> 
	<div class="content ">

	
	
	<div class="cus-info">
	
    <form method="post" class="form-horizontal from-thanhtoan" name="frm_order" action="" enctype="multipart/form-data" role="form" >          
	<div class="row" id="step-2">
		<div class="col-xs-12 col-lg-6 bill_form">
			<div class="title"><?=_thongtinthanhtoan?></div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_fullname?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[name]" id="ten" required type="text" value="<?=@$m['fullname']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_phone?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[phone]" id="dienthoai" type="text" required  value="<?=@$m['phone']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label" ><?=_address?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[address]"  id="diachi" type="text" required value="<?=@$m['address']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">E-Mail<span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[email]" id="email" type="email" required value="<?=@$m['email']?>" />
				
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">&nbsp;</label>
				<div class="col-sm-9">
					 <div class="checkbox">
				<label>
				  <input type="checkbox" name="same-address"  value="1"> <?=_same_as_received?>
				</label>
			</div>
				</div>
			</div>
			
			
		</div>
		
		
		<div class="col-xs-12 col-lg-6 receive_form">
			<div class="title"><?=_recenved_info?></div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_fullname?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[name]" id="ten"  type="text" value="<?=@$m['fullname']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_phone?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[phone]" id="dienthoai" type="text"   value="<?=@$m['contact_phone']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label" ><?=_address?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[address]"  id="diachi" type="text"  value="<?=@$m['contact_address']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">E-Mail<span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[email]" id="email" type="email"  value="<?=@$m['email']?>" />
				
				</div>
			</div>
			<div  class="col-xs-offset-3" >
			 <div class="checkbox" style="margin-left:9px">
				<label>
				
				</label>
			</div>
			</div>
			
		</div>
	<div class='clearfix'></div>
		<div class="text-right col-xs-12">
			<button type="button" class="btn btn-success next-step" style="padding-bottom: 7px;height: auto;padding: 7px 17px;font-weight: bold;text-transform: uppercase;border-radius: 4px;"><?=_next?></button>
		
		</div>
	</div>
	
	
	
	
	<div class="row hide" id="step-3">
		
	<div class="col-xs-12 col-lg-6 payment">
			<div class="title"><?=_hinhthucthanhtoan?></div>
			<?php 
			
			
			
			$d->query("select ten_$lang,id,mota_$lang from #_hinhthucthanhtoan where hienthi = 1 order by stt desc");
			$pay = $d->result_array();
			foreach($pay as $k=>$v){?>
			<div class="radio">
			  <label>
				<input type="radio" name="trans" id="optionsRadios1" value="<?=$v['id']?>" <?=(!$k) ? 'checked' : ''?>>
				<?=$v['ten_'.$lang]?>
			  </label>
			</div>
			<?php } ?>
			<div class="desc">
				<?php 
					foreach($pay as $k=>$v){?>
						<div class="desc-payments desc-<?=$v['id']?> <?=($k) ? 'hide' : ''?>">
							<p><strong><?=$v['ten_'.$lang]?></strong></p>
							<?=convertString($v['mota_'.$lang])?>
						</div>
					<?php 
					}
				
				?>
			
			</div>
			
	</div>
	<script>	
		$(".payment input").click(function(){
			$(".payment .desc-payments").addClass("hide");
			$(".payment .desc-"+$(this).val()).removeClass("hide");
		})
	
	</script>
		<div class="col-xs-12 col-lg-6 trans-type">
			<div class="title">Hình thức vận chuyển</div>
			<?php 
			
			
			
			$d->query("select ten_$lang,id,gia from #_hinhthucvanchuyen where hienthi = 1 order by stt desc");
			$pay = $d->result_array();
			foreach($pay as $k=>$v){?>
			<div class="radio">
			  <label>
				<input type="radio" name="trans2" data-price="<?=$v['gia']?>" id="optionsRadios1" value="<?=$v['id']?>" <?=(!$k) ? 'checked' : ''?>>
				<?=$v['ten_'.$lang]?> - <strong><?=myformat($v['gia'])?></strong>
			  </label>
			</div>
			<?php } ?>
			
	</div>
	<div class='clearfix'></div>
	
	
	
  
      
    
	
	
	
	

	<hr />
	
	<div class="descript col-xs-12 ">
		<div class="form-group">
		<div class="title">Lời nhắn</div>
		
		<textarea class="form-control" rows="5" name="content"></textarea>
	  </div>
	
	</div>
	
	
	
	
	
	
	
	
	<div class="shopcart" id="box-shopcart">
                    <?php 
					
                    if(is_array($_SESSION['cart']) & count($_SESSION['cart']) > 0){
						?>
						<div class="column-labels">
						<label class="product-image">Hình ảnh</label>
						<label class="product-details">Sản phẩm</label>
						<label class="product-price">Đơn giá</label>
						<label class="product-quantity">Số lượng</label>
						<label class="product-removal hide">Xóa</label>
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
                    if($q==0) continue;
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
						?>
					  </p>
					</div>
					<div class="product-price"><?=myformat($v['price'])?></div>
					<div class="product-quantity">
						<b><?=$q?></b> sản phẩm
					  
					</div>
					<div class="product-removal hide ">
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
    <div class="totals-item totals-item-total total_cart_max">
     
	   <label>Tổng giá</label>
	   <div class="totals-value all-price" id="cart-total"><span class="price"><?=myformat($c['price'])?></span></div>

	   <label>Ship</label>
	   <div class="totals-value all-ship" id="cart-total"><span class="price">0</span></div> 
	   
	   <label>Tổng tiền thanh toán</label>
	   <div class="totals-value all-price-all" id="cart-total"><span class="price"><?=myformat($c['price'])?></span></div>
	   
	   
	 
    </div>
  </div>
	<div class="pull-right footer-cart">
                        
  <button title='tiếp tục' class="btn xbtn" type="submit"  value="" style="cursor:pointer;"/>Xác nhận và thanh toán <i class="fa fa-sign-in"></i></button>
</div>	
<div class="clearfix"></div>
                    <?php 
                    }else{
                   
                    echo "<div class='alert alert-danger'>Không có sản phẩm nào trong giỏ hàng!</div>";
                    }
                    ?>
                	
			
	
		
 </div>  
		
		
		
		</form>
		
 </div>  
 
 </div>
 </div>
 </div>
 </div>
 
 
 <script>
		$().ready(function(){
			$(".next-step").click(function(){
				
				
				$("#step-2").addClass("hide");
				$("#step-3").removeClass("hide");
				$(".setup-panel li").eq(1).removeClass("active");
				$(".setup-panel li").eq(1).addClass("disabled");
				$(".setup-panel li").eq(2).addClass("active");
				$(".setup-panel li").eq(2).removeClass("disabled");
				
				
			})
			$(".bill_form input").keyup(function(){
				if($("input[name=same-address]").is(":checked")){
				$id = $(this).attr("id");
				
				$val = $(this).val();
				$(".receive_form #"+$id).val($val);
				}
			})
			$("input[name=same-address]").change(function(){
				$(".bill_form input").trigger("keyup");
			})
			$("input[name=same-address]").trigger("click");
			$(".trans-type input").click(function(){
				NProgress.start();
				$price = $(this).data("price");
				$.ajax({
					url:"ajax/update-transtype.html",
					data:{price:$price,id:$(this).val()},
					type:"post",
					dataType:"json",
					success:function(data){
						$(".total_cart_max .all-price .price").html(data.price);
						$(".total_cart_max .all-ship .price").html(data.ship);
						$(".total_cart_max .all-price-all .price").html(data.all);
						NProgress.done();
						
					}
				})
			})
			$(".trans-type input").first().trigger("click");
			
		})
	
	</script>