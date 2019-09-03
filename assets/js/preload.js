$ar = Array(
'/assets/bootstrap/js/bootstrap.min.js',
'/assets/plugins/wow/dist/wow.min.js',
'/assets/plugins/notify/js/jquery.notify.min.js',
'/assets/plugins/fancybox-v3/v2/jquery.fancybox.js'
);

	$.each($ar,function(index,item){
		
		var tag = document.createElement("script");
		tag.src = base_url+item;
		document.getElementsByTagName("head")[0].appendChild(tag);
	})
