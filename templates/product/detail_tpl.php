<script type="application/ld+json">
    {
    "@context": "http://schema.org/",
    "@type": "Product",
    "name": "<?= $row_detail['ten_' . $lang] ?>",
    "image": "<?$config_url?>/thumb/640x480/1/<?= _upload_sanpham_l . $row_detail['photo'] ?>",
    /*"brand": {
    "@type": "Thing",
    "name": "ACME"
    },*/
    "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.4",
    "ratingCount": "<?= $row_detail['luotxem'] ?>"
    },
    "offers": {
    "@type": "AggregateOffer",
    "lowPrice": "<?= $row_detail['price_0']?>",
    "highPrice":  "<?= $row_detail['price_0'] ?>",
    "priceCurrency": "VND"
    }
    }
</script>
<div class="container">
	
    <div class="">
        <div class="" id="product-detail">
            <div id="detail">
                <div  class="row">
                    <div class="col-xs-12 col-md-8" id="main-detail">
                        <div class="">
                            <div id="x_refesh">
								<div class="scrollbar">
	<div class="handle"></div>
</div>
                               
                                <div class="wrap-on-image">
                                    <a id="Zoom-1" class="MagicZoom" data-options="zoomPosition: inner" title="<?= $row_detail["ten_" . $lang] ?>" href="<?= _upload_sanpham_l . $row_detail["photo"] ?>"	>
                                        <img src="<?= _upload_sanpham_l . $row_detail["photo"] ?>" alt="<?= $row_detail["ten_" . $lang] ?>"/>
                                    </a>
                                </div>
								 <div id="gal1" class=''>
                                    <ul id="carousel" class="bx-slides">
                                        <li>
                                            <a data-zoom-id="Zoom-1" data-zoom-type="zoom"  href="<?= _upload_sanpham_l . $row_detail['photo'] ?>" data-image="<?= _upload_sanpham_l . $row_detail['photo'] ?>" >
                                                <img  data-zoom-type="zoom" srcset="<?= _upload_sanpham_l . $row_detail['photo'] ?>" src="<?= _upload_sanpham_l . $row_detail['thumb'] ?>" alt="<?= $row_detail["ten_" . $lang] ?>" />
                                            </a>
                                        </li>

                                        <?php
                                        $ar = json_decode($row_detail['gallery']);
                                        if (count($ar) > 0) {
                                            foreach ($ar as $k => $v) {
                                                ?>
                                                <li>
                                                    <a data-zoom-id="Zoom-1" href="<?= $config_url . $v ?>" data-image="<?= $config_url . $v ?>" >
                                                        <img srcset="thumb/160x0/2<?= $v ?>" src="thumb/160x0/2<?= $v ?>" alt="<?= $row_detail["ten_" . $lang] ?>" />
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!--zoom-section end-->
                    </div>

                    <div class="col-xs-12 col-md-4 main-product-detail">
                        <div class="">
                            <div class="header-detail">
                                <div class="code"><?= _masp ?>: <?= $row_detail['maso'] ?></div>
                                <div class="status"><?= _status ?>: <span class="text-success">Còn hàng</span></div>

                            </div>
							<?php 
								$discount = checkInPrice($row_detail);
								if($discount['status']){
										$row_detail['giacu'] = $row_detail['gia'];
										$row_detail['gia'] = $discount['data']['price'];
								}
							
							?>
                            <div class="title"><h1><?= $row_detail['ten_' . $lang] ?></h1></div>
                            <div class="wrap-raty">
                                <div class="raty" data-score="<?=$row_detail['score']?>"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="content">
                                <div class="price">
                                    <?php
									$type = (isset($_SESSION['member_log'])) ? $_SESSION['member_log']['type'] : 0;
                                    echo '<span class="new-price">' . myformat($row_detail['gia']) . '</span>';
									
                                    /*if ($row_detail['giacu']) {
                                        echo '<span class="old-price">' . myformat($row_detail['giacu']) . '</span>';
                                    }*/
                                    ?>
                                </div>
<input id='product-price' type='hidden' value='<?=$row_detail['gia']?>'>
                                    <?php
                                    $colors = getColorByProductId($row_detail['id']);
									
                                    if (count($colors) > 0) {
                                        $x = json_decode($row_detail['gallery'], true);
                                        $x[] = "/" . _upload_sanpham_l . $row_detail['photo'];
                                        echo '<script> var image_default = ' . json_encode($x) . '; </script>';
                                      
                                        foreach ($colors as $k => $v) {
                                            echo '<script> var color_image_' . $v['id_color'] . ' = ' . ($v['image']) . ';</script>';
                                        }
                                      

                                       
                                    }
                                    $colors = $model->generateSizeColor($row_detail['id']);
								

                                    if (is_array($colors) & count($colors) > 0) {
                                      
                                        echo '<div id="p_color"><div class="xtitle">Màu sắc</div><div class="clearfix"></div>';
                                        foreach ($colors as $k => $v) {
										
											echo '<script> var size_'.$k.' = ' . json_encode($v) . '; </script>';
                                            echo '<div class="wrap-color-item" >';
                                            echo '<div title="'. $model->getColor($k,'name').'" data-toggle="tooltip" class="color_item" data-id="' . $k . '" style="background-color:' .$model->getColor($k,'bg_color') . '">';
                                            echo '</div>';
                                            echo '<div class="clearfix"></div>';
                                            echo '<span class="color-name">' . $model->getColor($k,'name') . '</span>';
                                            echo '<div class="clearfix"></div>';
                                            echo '</div>';
                                        }
                                        echo '<div class="clearfix"></div>';

                                        echo '</div>';
                                    }
									
									
									
									
									
									
                                    ?>

                                <?php
                                
                                    echo '<div id="p_size" class="hide"><div class="xtitle">Kích cỡ</div><div class="clearfix"></div>';
									echo '<div class="wrap-size">';
                                   
									echo '</div>';
                                    echo '<div class="clearfix"></div>';

                                    echo '</div>';
                                
                                ?>	
                                <div class="product-qty ">


                                    <div class="controls pull-left">
                                        <div class="rel pull-left">
                                            <input type="text" value="1"  id="qty" /><button >-</button><button class="is-up">+</button></div>
                                        <div class="cart pull-left"><button class="add-cart" id="add-cart" data-id="<?= $row_detail['id'] ?>" data-name="<?= $row_detail['ten_' . $lang] ?>"><?= _addcart ?> <i class="fa fa-cart-plus"></i></button>  </div>
                                        <div class="clearfix"></div>	
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="tool-product ">
                                    <div class="row-5">
                    <!--                <div class="col-xs-12 box col-5">
                                            <a href="javascript:void(0)" class="add-to-wishlist" data-id="<?=$row_detail['id']?>" title="<?= _add_wish_list ?>"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp;<?= _add_wish_list ?></a>
                                        </div> -->
                                        <div class="col-xs-12 col-md-5 box col-5 hide">
                                            <a href="" title="<?= _compare_product ?>"><i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp;<?= _compare_product ?></a>
                                        </div>	
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                                <div class="tool-share">

                                    <div id="shareRoundIcons"></div>
                                </div>
                                <div class="box-description">
                                    <div class="xtitle"><?= _mota ?></div>
                                    <div class="inner-form">
<?= nl2br($row_detail['mota_' . $lang]) ?>
                                    </div>

                                </div>

                            </div><!-- end main-product-detail -->
                        </div>
                        <div class="clearfix"></div>
						
                    </div>
                </div>
<?php 
		include _template."layout/share.php";
	?>
		<div>
			<div> 
				<h2> Chi tiết sản phẩm </h2>
			</div>
			<?=$row_detail['noidung_'.$lang]?>
		</div>
                <div class="tab-category">
                    <!-- Nav tabs -->
                    <ul class="tab-nav" >

						<li class="active">
							<a href="#propose"><?= _propose_product ?></a>
							
                            
                        </li>
                        <li>
                            <a href="#new"><?= _new_product ?></a>
                        </li>
                        <li>							
                            <a href="#hotseller"><?= _hotseller_product ?></a>
                        </li>



                    </ul>

                    <div class='clearfix'></div>
                    <div class="tab-content" style="margin-top:20px">

                        <div class="tab active" id="propose">
                            <div class="row row-8">
									<?php 
									foreach ($product as $k => $v) {
										$model->showProduct($v, array("class"=>"item-product col-xs-6 col-sm-4 col-md-3 col-8","max"=>1), $k);
									}
									?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
						<div class="tab" id="new">
                            <div class="row row-8">
									<?php 
									foreach ($model->getNewProduct($row_detail['id']) as $k => $v) {
										$model->showProduct($v, array("class"=>"item-product col-xs-6 col-sm-4 col-md-3 col-8","max"=>1), $k);
									}
									?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
						<div class="tab" id="hotseller">
                            <div class="row row-8">
									<?php 
									foreach ($model->getFeatureProduct($row_detail['id']) as $k => $v) {
										$model->showProduct($v, array("class"=>"item-product col-xs-6 col-sm-4 col-md-3 col-8","max"=>1), $k);
									}
									?>
                                <div class="clearfix"></div>
                            </div>
                        </div>


                    </div>
                </div><!-- nav-tabs-->



            </div>


        </div>
    </div>
</div><!-- end container -->