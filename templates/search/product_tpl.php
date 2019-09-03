<div class="container">
<div class="wrap-all-product container">
    <div class="">
        <div class="title-global">
            <h1><?=_search_result?></h1>
            <div class='clearfix'></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="product-wrap">
        <div class='ooz '>
            <div class="row-8">
                <?php foreach($product as $k=>$v){ 								$model->showProduct($v, array("class"=>"col-xs-12 col-md-3 col-sm-4 item-product col-8","max"=>true), $k);				} ?>
                <div class="clearfix"></div>
            </div>
			<?=$paging[ 'paging']?>
        </div>
        <!-- end col-xs-12-->
        <div class="clearfix"></div>
    </div>
</div>
</div>