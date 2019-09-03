<div class="container">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h1><?=$title_cat?></h1><div class="clearfix"></div></div>
<div class="wrap-box-news">
	<div class="row-8">
 	<?php for($i = 0, $count_tintuc = count($tintuc); $i < $count_tintuc; $i++){ ?>
        <div class="col-xs-12 col-8">
		<div class="fix-haft-row">
		<div class='news-item'>
			<div class="row-5">
				
				
				<div class="col-xs-12 col-5">
					<a class="title" href="<?=$com?>/<?=$tintuc[$i]['tenkhongdau']?>-<?=$tintuc[$i]['id']?>.html" title="<?=$tintuc[$i]['ten_'.$lang]?>"><?=$tintuc[$i]['ten_'.$lang]?></a>                  
					<div class='date'><?=date("d/m/Y",$tintuc[$i]['ngaytao'])?></div>
					<p><?=(strip_tags($tintuc[$i]['mota_'.$lang]))?></p>
					<a class="chitiet hide" href="<?=$com?>/<?=$tintuc[$i]['tenkhongdau']?>-<?=$tintuc[$i]['id']?>.html"><?=_read_cotinue?></a>
				</div>	
				</div>	
				
			</div><!-- end row -->
			</div>
        </div><!---END .box_new-->
		<div class="clearfix"></div>
		<hr>
       
    <?php } ?>
 <div class="clear"></div>    
 </div>
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
</div>