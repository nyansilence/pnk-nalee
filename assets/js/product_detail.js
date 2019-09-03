

var stepper = function(s, dp) {
    if (s && typeof s == 'string') s = parseFloat(s)
    if (dp && typeof dp == 'string') dp = parseFloat(dp)
    if (arguments.length == 1) dp = -1
    this.s = s
    this.dp = dp
    this.running = true;
    this.validate()
    return this
}
stepper.prototype = {
    validate: function() {
        if (parseFloat(this.setDP(this.s)) == 0) {
            alert("The decimal places cannot be shorter than the PIP.\ndp = " + this.dp + ", pip = " + this.s)
        }
    },
    mul: function() {
        return Math.pow(10, this.dp == -1 ? 1 : this.dp)
    },
    upToInt: function(n) {
        return Math.round(n * this.mul())
    },
    downToFloat: function(n) {
        return (n / this.mul())
    },
    setDP: function(n) {
        var r = n.toString()
        if (this.dp == -1) return r
        if (this.dpLen(r) == -1 && this.dp > 0) r += ".0"
        else if (this.dpLen(r) == -1 && this.dp == 0) return r
        if (this.dpLen(r) > this.dp) {
            var i = r.indexOf('.')
            r = r.substring(0, i) + '.' + r.substring(i + 1, i + 1 + this.dp)
        } else {
            while (this.dpLen(r) < this.dp) r += "0"
        }
        return r
    },
    dpLen: function(n) {
        if (n.indexOf('.') == -1) return -1
        else
            return (n.length) - (n.indexOf('.') + 1)
    },
    step: function(n) {
        if (arguments.length) {
            if (arguments[0] && typeof arguments[0] == 'string') {
                this.n = parseFloat(arguments[0])
            } else if (arguments[0] == NaN) {
                this.n = 0
            } else {
                this.n = arguments[0]
            }
        } else {
            alert("stepper::step expects a float value")
            return
        }
        var n = this.upToInt(this.n)
        var s = this.upToInt(this.s)
        var r = this.setDP(this.downToFloat(n - (n % s) + s))
        return r
    }
}
jQuery.fn.mousehold = function(timeout, f) {
    if (timeout && typeof timeout == 'function') {
        f = timeout;
        timeout = 100;
    }
    if (f && typeof f == 'function') {
        var timer = 0;
        var fireStep = 0;
        return this.each(function() {
            jQuery(this).mousedown(function() {
                fireStep = 1;
                var ctr = 0;
                var t = this;
                timer = setInterval(function() {
                    ctr++;
                    f.call(t, ctr);
                    fireStep = 2;
                }, timeout);
            })
            clearMousehold = function() {
                clearInterval(timer);
                if (fireStep == 1) f.call(this, 1);
                fireStep = 0;
            }
            jQuery(this).mouseout(clearMousehold);
            jQuery(this).mouseup(clearMousehold);
        })
    }
}
function addCart() {
    $("#add-cart").click(function() {
		
        $color = 0;
        $size = 0;
        $id = $(this).data("id");
        $qty = parseInt($("input#qty").val());
        if ($("#p_color").length) {
             if ($("#p_color .color_item.active").length  > 0) {
                $color = $("#p_color .color_item.active").data("id");
            } else {
                showMsg("warning", _lang.error_pick_color);
               $("body,html").animate({scrollTop:$("#p_color").offset().top-20});
                return false;
            }
        }
       if (!$("#p_size").hasClass("hide")) {
            if ($("#p_size .size_item.active").length  > 0) {
				$size = $("#p_size .size_item.active").data("id");
            } else {
                showMsg("warning", _lang.error_pick_size);
                $("body,html").animate({scrollTop:$("#p_size").offset().top-20});
                return false;
            }
        }
		
        doAddCart($(this).data("name"), $id, $qty,$size,$color,$("input#product-price").val());
        return false;
    });
}
function controlProductQty() {
   
    $(".product-qty .controls button").unbind("mousehold");
    $(".product-qty .controls button").mousehold(function() {
        a = $(this);
        c = $(this).parent().find("input");
        v = parseInt(c.val());
        if (a.hasClass("is-up")) {
            v++;
        } else {
            v--;
        }
        if (v < 1) {
            v = 1;
        }
        c.val(v);
    })
}
function initShare(){
$("#shareRoundIcons").jsSocials({
    showLabel: false,
    showCount: false,
	 shareIn: "popup",
    shares: ["email", "twitter", "facebook", "googleplus", "pinterest"]
});
}
function initSly(){
	hor = 1;
	if($(window).width() >=768){
		$("#gal1").css({height:$(".wrap-on-image").height()});
		hor=0;
	}
	
		var $frame  = $('#gal1');
		var $slidee = $frame.children('ul').eq(0);
		var $wrap   = $frame.parent();
	
	
		// Call Sly on frame
		$frame.sly({
			horizontal:hor ,
			itemNav: 'basic',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 3,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 1,
			pagesBar: $wrap.find('.pages'),
			activatePageOn: 'click',
			speed: 300,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,

		});
	
	
	
}
$().ready(function(){
	initSly();
	addCart();
	//initShare();
	
						    controlProductQty();
							function refreshImage($image){
					
					if($image.length > 0){
						first = false;
						$str = '';
						$.each($image,function(index,item){
							item = base_url+item;
							if(!index){
								first = item;
							}
							
							$str+='<li><a data-zoom-id="Zoom-1" data-zoom-type="zoom"  href="'+item+'" data-image="'+item+'" ><img  data-zoom-type="zoom" srcset="'+item+'" src="'+item+'" alt="" /></a></li>'
							
						})
						$strx='<div class="wrap-on-image"><a id="Zoom-1" class="MagicZoom" data-options="zoomPosition: inner" title="" href="'+first+'"	><img src="'+first+'" alt=""/></a></div>	';
						$strx+='<div id="gal1"><ul id="carousel" class="bx-slides">'+$str+"</ul></div><div class='clearfix'></div>";
						
						
					
					$("#x_refesh").html($strx);
					initSly();
					
					}else{
					
						refreshImage(image_default);
						
						
					}
					MagicZoom.refresh();
							}
					
			
							$("#qty").change(function(){
								if(!parseInt($(this).val(), 10)){
										$(this).val(1);									
								}
								if(parseInt($(this).val()) < 1){
									$(this).val(1);
								}
							})
							 $(".tab-category li a").click(function() {
								$(".tab-category li").removeClass("active");
								$id = $(this).attr("href");
								$(this).parent().addClass("active");
								$(".tab-category .tab").hide();
									$(".tab-category .tab" + $id).fadeIn(function(){
										$(".tab-category .tab" + $id).show();
									});
									
								
								
							
								return false;
							})
						
							$(".color_item").click(function(){
								
								$("#p_size").addClass("hide");
								$(".color_item").removeClass("active");
								$(this).addClass("active");
								$size = eval("size_"+$(this).data("id"));
								
								if($size.length){
									$("#p_size .wrap-size").empty();
									$.each($size,function(index,item){
										
										$str = '<div class="size_item" data-price="'+item.price+'" data-quantity="'+item.quantity+'" data-sold="'+item.sold+'" data-id="'+item.id_size+'">';
                                        $str+= item.size_name;
                                        $str+=  '</div>';
										$("#p_size .wrap-size").append($str);
										
									})
									$("#p_size").removeClass("hide");
									$("#p_size .size_item").unbind("click");
									$("#p_size .size_item").click(function(){
										$("input#product-price").remove();
										$("#p_size .size_item").removeClass("active");
										$price = parseFloat($(this).data("price"));
										$sold = parseInt($(this).data("sold"));
										$quantity = parseInt($(this).data("quantity"));
										$stock = ($quantity) - ($sold);
										if($stock <= 0){
											$stt = "Hết hàng";
										}else{
											$stt = "Còn hàng <span class='small'>("+$stock+" sản phẩm)</span>";
										}
										$(".header-detail .text-success").html($stt);
										$("body").append("<input id='product-price' type='hidden'>");
										$("input#product-price").val($price);
										$('.price .new-price').html(numberFormat($price));
										$(this).addClass("active");
										
									})
								}
								try{
									$g = eval("color_image_"+$(this).data("id"));
									refreshImage($g);
								}catch(e){
									$g = image_default;
									refreshImage($g);
									console.log(e);
								}
							})
							
							
			
				})