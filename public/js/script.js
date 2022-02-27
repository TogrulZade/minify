
var csrf = document.querySelector('meta[name="csrf-token"]').content;
$(document).ready(function(){

	var h = $('.shop-desc').height();
	// $(".shop-img").css("height",h+31);
	// alert(send_message);
	// $(".absolute").css("top",send_message);



	$(".unsave").hover(function(){
		$(this).removeClass("far").addClass("fa");
	});
	
	$(".drop-down a").on("click", function(e){
		e.preventDefault();
		if($(".subcategory").hasClass('hide')){
			$(".subcategory").removeClass('hide').addClass("show");
		}else{
			$(".subcategory").removeClass('show').addClass("hide");
		}
	});

	$(".ul_subcategory li").hover(function(){
		$(this).next("ul").removeClass("hide").addClass("show");
	});

	$(".sub_item li").hover(function(){
		$(this).next("ul").removeClass("hide").addClass("show");
	},function(){
		$(".sub_item").find("ul").removeClass("show").addClass('hide');
	});

	$(".unsave").on('click',function(){
		$(this).removeClass("far unsave").addClass("fa save");
		
	});

	const mini_close = ()=>{
		$('.mini-slide-cover').css('visibility','hidden');
		$('.full-opacity').css('visibility','hidden');
		$('body').css("overflow","visible");
		$('.modalBox').hide();
		$(".promotion-modal.vip").hide();
	}

	const right = ()=>{
		index++;
		if(index > count_photos){index = 0;}
		if(index == 0) img = $(".cover-photo img").attr('src');
		else img = $("#mini-gallery div").find('[data-index="'+(index)+'"]').attr('src');
		$('.mini-slide').find('img').attr('src',img);
	}
	
	const left = ()=>{
		index--;
		if(index < 0){index = count_photos;}
		if(index == 0) img = $(".cover-photo img").attr('src');
		else img = $("#mini-gallery div").find('[data-index="'+(index)+'"]').attr('src');
		$('.mini-slide').find('img').attr('src',img);	
	}

	$(document).on('keydown', function(e) {
		if (e.key == "Escape") {
			mini_close();
		}
		if (e.key == "ArrowRight") {
			right();
		}
		if (e.key == "ArrowLeft") {
			left();
		}
	});

	const width = $(window).width();
	const height = $(window).height();
	$("#mini-gallery img").each(function(x){
		count_photos = x;
	})

	$(".mini-slide img").css("height",height+"px")

	$('#mini-gallery img').on("click", function(){
		const image = $(this).attr('src');
		index = $(this).data('index');
		$('.mini-slide').find('img').attr('src',image);
		$('body').css("overflow","hidden");
		$('.mini-slide-cover').css('visibility','visible');
		$('.full-opacity').css('visibility','visible');
	});

	$('.mini-photo li').hover(function(){
		$(".make_cover").removeClass('show');
		$(this).find('.make_cover').addClass('show');
	}, function(){
		$(".make_cover").removeClass('show');
	});

	$(".make_cover").on('click', function(){
		let pic = $(this).data('id');

		$.ajax({
			url: '/makeCover',
			type:'post',
			data: {_token: csrf, pic: pic},

			success: function(res){
				alert(JSON.stringify(res));
			},
			error: function(error){
				alert(error.responseText);
			}
			
		})
	});

	$('.mini-close').on("click", function(){
		$('.mini-slide-cover').css('visibility','hidden');
		$('.full-opacity').css('visibility','hidden');
		$('body').css("overflow","visible");
	});


	$('.right').on('click', function(){
		right();
	});

	$('.left').on('click', function(){
		left();	
	});

	$(".drawer_close").on('click',function(){
		$(".drawermenu").css('transform','translateX(-120%)');
		$('.full-opacity').css('visibility','hidden');
	});
	
	$(".drawermenu_button").on('click',function(){
		$('.full-opacity').css('visibility','visible');
		$(".drawermenu").css('transform','translateX(0%)');
	});
	
	$(".full-opacity").on('click',function(){
		$('.full-opacity').css('visibility','hidden');
		$(".drawermenu").css('transform','translateX(-120%)');
		mini_close();
	});

	$(".sticky-wrapper li").on("mouseenter",function(){
		$(this).find("ul").css({'visibility':'visible','right':'55px','opacity':'1'});
	});
	$(".sticky-wrapper li").on("mouseleave",function(){
		$(this).find('ul').css({'visibility':'hidden','right':'65px','opacity':'0'});
	});

	const add_favorite = (the)=>{
		const product_id = the.data('product_id');

		const that = the;
		$.ajax({
			url: '/addFavs',
			type:'post',
			data: {_token: csrf, product_id: product_id},
			success: function(res){
				if(res == 'redirect/login'){
					window.location.href = '/login';
				}else if(res == 'unfavorite'){
					if(that.hasClass('bookmarks')){
						that.removeClass('fas').addClass('far');
					}else{
						that.css('color',"#a0a0a0");
					}

					if(that.hasClass('btn-pink')){
						that.removeClass('btn-pink').addClass('btn-pink-outline')
					}
				}else{

					if(that.hasClass('bookmarks')){
						that.removeClass('far').addClass('fas');
					}else{
						that.css('color','red');
					}
					
					// alert('followed');
				}
			},
			error: function(error){
				console.log(JSON.stringify(error));
			}
		})
	}

	const sevimli = (the)=>{
		const product_id = the.data('product_id');

		const that = the;
		$.ajax({
			url: '/addFavs',
			type:'post',
			data: {_token: csrf, product_id: product_id},
			success: function(res){
				if(res == 'redirect/login'){
					window.location.href = '/login';
				}else if(res == 'unfavorite'){
					if(that.hasClass('btn-pink')){
						that.removeClass('btn-pink').addClass('btn-pink-outline')
					}
				}else{

					if(that.hasClass('bookmarks')){
						that.removeClass('far').addClass('fas');
					}else{
						that.removeClass('btn-pink-outline').addClass('btn-pink');
					}
					
					// alert('followed');
				}
			},
			error: function(error){
				console.log(JSON.stringify(error));
			}
		})
	}

	$(".add_favorite").on('click', function(e){
		e.preventDefault();
		add_favorite($(this));
	});

	$(".sevimli").on('click', function(e){
		e.preventDefault();
		sevimli($(this));
	});

	$(".bookmarks").on('click', function(e){
		e.preventDefault();
		add_favorite($(this));
	});

	$(".sticky-item.favorite").on('click',function(e){
		e.preventDefault();
		if($(this).hasClass('show-sticky')){
			$(this).removeClass('show-sticky');
			$(".right-sticky").css('right',"0");
			$(".sticky-body").css('right',"-400px");
			$(this).removeClass('active-sticky');
		}else{
			$(this).addClass('show-sticky');
			$(".right-sticky").css('right',"397px");
			$(".sticky-body").css('right',"0");
			$(this).addClass('active-sticky');
		}
	});


	var hash = window.location.hash;
	if(hash){
		hash = hash.replace('#','');
		$('.tab-body').hide();
		$("."+hash+"-body").show();
		$('.tab-item a').removeClass('active');
		$('.'+hash+'-link a').addClass('active');
	}else{
		$(".aktiv-link").addClass('active');
		$('.tab-body').hide();
		$('.aktiv-body').show();
	}

	$('.yoxlanilan-link').on('click', function(){
		$(".tab-item a").removeClass('active');
		$(this).find('a').addClass('active');
		$('.tab-body').hide();
		$(".yoxlanilan-body").show();
	});

	$('.aktiv-link').on('click', function(){
		$(".tab-item a").removeClass('active');
		$(this).find('a').addClass('active');
		$('.tab-body').hide();
		$(".aktiv-body").show();
	});

	$('.duzelis-link').on('click', function(){
		$(".tab-item a").removeClass('active');
		$(this).find('a').addClass('active');
		$('.tab-body').hide();
		$(".duzelis-body").show();
	});

	$(".search-bar input").on("input",function(){
		if($(this).val()){
			$(".icon-search").css({'color':'#1396ff'});
		}else{
			$(".icon-search").css('color','#494949');
		}
	});

	$('.navbar-menu a').on("click", function(e){
		if($('.navbar-menu-open').hasClass('show')){
			$(".navbar-menu-open").removeClass("show");
		}else{
			$(".navbar-menu-open").addClass("show");
		}
	});

	$('.navbar-menu-open.show').on("focusout",function(){
		$(".navbar-menu-open").removeClass("show");
	});


	// 
	// var current = $(window).position().top;
	// alert(current);

	// $(window).scroll(function (event) {
	// 	var top = $("#autoloadPremium").offset().top;
	// 	var scroll = $(window).scrollTop();
	// 	var height = $(window).height();
	// 	$(".pan").text("Scroll: "+scroll+" Autoload: "+(top-height-10));
	// 	// if(scroll == top-height-10){
	// 		if(Math.ceil($(window).scrollTop()) 
	// 	   == Math.ceil(($(document).height() - $(window).height()))){
	// 		$("#autoloadPremium").before('<div class="col-md-3 col-sm-4 col-xs-6"><a href="/product/259-xiaomi-redmi-note-8-64gb" class="card"><div class="card-img"><img src="http://127.0.0.1:8000/storage/products/60bcd3286cf00.png" alt=""><div class="add_favorite" data-product_id="259" style=""><i class="fas fa-heart"></i></div></div><div class="card-title">678 AZN</div><div class="card-body"><strong class="mb-0">Xiaomi Redmi Note 8, 64GB</strong></div><div class="card-footer"><p>2021-06-06 13:52:52</p></div></a></div>');
	// 	   }
	// 	// }
	// });

	// var p = 1;
	//    $(window).scroll(function() {
	// 	if(Math.ceil($(window).scrollTop()) 
	// 	   == Math.ceil(($(document).height() - $(window).height()))) {
	// 		$.ajax({
	// 			url: '/loadProduct',
	// 			type:'get',
	// 			data: {_token: csrf, p: p},
	// 			beforeSend: function() {
	// 				$("#loading-image").show();
	// 			 },
	// 			success: function(res){
	// 			p = p+1;
	// 				res.map(data=>{
	// 					$("#autoload").before('<div class="col-md-3 col-sm-4 col-xs-6"><a target="_blank" href="/product/'+data.slug+'" class="card"><div class="card-img"><img src="/storage/'+data.product_cover+'" alt=""><div class="add_favorite" data-product_id="'+data.id+'" style=""><i class="fas fa-heart"></i></div></div><div class="card-title">'+data.product_price+' AZN</div><div class="card-body"><strong class="mb-0">'+data.product_name+'</strong></div><div class="card-footer"><p>'+data.started_at+'</p></div></a></div>');
	// 				})
	// 				$("#loading-image").hide();
					
	// 			},
	// 			error: function(){
	// 				alert('Error');
	// 			}
	// 		})
	// 	}
	// });



	$(".ireli-btn").on("click",function(){
		$('.modal-ireli').show();
		$(".full-opacity").css('visibility','visible');
	});

	// $(".vip-btn").on("click",function(){
	// 	$('.modal-vip').show();
	// 	$(".full-opacity").css('visibility','visible');
	// });

	$(".premium-btn").on("click",function(){
		$('.modal-premium').show();
		$(".full-opacity").css('visibility','visible');
	});

	$(".modal-header .fa-times").on("click", function(){
		mini_close();
	});

	$(".promo-btn.vip-btn").on("click", function(){
		vip = $(this).data('vip');
		$.ajax({
			url: '/checkVip',
			type: 'post',
			data: {id: vip, _token: csrf},
			success: function(res){
				$('.modal-vip').show();
				$(".full-opacity").css('visibility','visible');
				if(res !==''){
					date = new Date(res.closed_at);
					$('.modal-vip .activated').html("<p><small>"+date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+" tarixinə kimi ödənilib</small></p>");
				}
			},
			error: function(error){
				console.log(error.responseText)
			}
		})
	});


	$(".promo-btn.premium-btn").on("click", function(){
		premium = $(this).data('premium');
		$.ajax({
			url: '/checkPremium',
			type: 'post',
			data: {id: premium, _token: csrf},
			success: function(res){
				$('.modal-premium').show();
				$(".full-opacity").css('visibility','visible');
				if(res !==''){
					date = new Date(res.closed_at);
					$('.modal-premium .activated').html("<p><small>"+date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+" tarixinə kimi ödənilib</small></p>");
				}
			},
			error: function(error){
				console.log(error.responseText)
			}
		})
	});

	$(".vip-blank").on('click',function(){
		$(".full-opacity").css('visibility','visible');
		$(".promotion-modal.vip").show();
	});

	$(".promotion-modal.vip .click").on('click', function(){
		mini_close();
	});

	$(".vipEt-btn").on("click", function(){
		elan = parseInt($(".elan").val());
		if(elan < 0 || isNaN(elan)){
			alert('Zəhmət olmasa Elan nömrəsini doğruluğunu yoxlayın.')
			return false
		}

		$.ajax({
			url: 'makeVipWithNumber',
			type: 'POST',
			data: {id: elan, _token: csrf},

			success: function(res){
				window.location.href = '/product/'+res.slug+"/#vipModal";
			},
			error: function(error){
				alert(JSON.stringify(error));
			}
		})
		
	});
	
	if(window.location.hash == '#vipModal') {
		$(".full-opacity").css('visibility','visible');
		$('.modal-vip').show();
	}

	$(".form-search-mobile input").on('input',function(){
		let search = $(this).val();
		var array = [];
		if(search.length > 1){
			$.ajax({
				url: 'searching',
				type: 'GET',
				data: {search: search},
				
				success: function(res){
					console.log(JSON.stringify(res));
					var products = [];
					var categories = [];
					
					if(res != 'empty'){
						if(res.products.length > 0){
							products.push("<div class='result-title'>Məhsul və xidmətlər</div>");
							$.each(res.products, function( i, item ) {
								products.push("<a href='product/"+item.slug+"' class='result-item'>" + item.product_name + "</div>");
							});
						}
						if(res.categories.length > 0){
							categories.push("<div class='result-title'>Kateqoriyalar</div>");
							
							$.each(res.categories, function( i, item ) {
								categories.push("<a href='/c/"+item.slug+"/' class='result-item'><i class='fas "+item.icon+"' style='color: "+item.color+"' font-size: 18px></i> " + item.name + "</div>");
							});
						}
						$.merge(array, $.merge(products,categories))
						$('.box-result').show();
					}
					$( ".result" ).html( array );
				},
				error: function(error){
					console.log(error.responseText);
				}
			})
		}else{
			console.log('cleared')
			array.splice(0, array.length)
			$('.box-result').hide();
		}
	})


	// Yeni elan sell
	var category;

	$('select[name="product_category"]').on('change',function(){
		category = $(this).val();
		// alert(category);
		if(category == 32){
			$('.update_detail').html(
				"<select name='marka'><option value='0'>Marka</option><option value='1'>Apple iPhone</option></select><select name='model'><option value='0'>Model seç</option><option name='1'>11</option><option name='2'>12 Pro max</option></select><select name='reng'><option name='0'>Rəng seç</option><option value='1'>Qara</option></select><select name='yaddas'><option name='0'>Yaddaş seç</option><option value='1'>64 GB</option></select><select name='ram'><option name='0'>Ram seç</option><option value='1'>4</option></select>"
			);
		}else if(category == 51){
			$('.update_detail').html(
				"<select name='home_type'><option value='0'>Elanın tipi</option><option value='1'>Satılır</option><option value='2'>Kiryayə verilir</option></select>"
			);
		}else{
			$('.update_detail').html('');
		}
	});



});

// Isleyir. Scroll zamani headeri gizlemek ve gostermek
var lastScrollTop = 0;
	document.addEventListener('scroll',function(event){
	var st = $(this).scrollTop();
	if(st > 70){
		$(".header-mobile").css('transition',"all .1s linear");
		// $("nav").css('transition',"all .1s linear");
		// $('nav').css("display",'none');
		$('.header-mobile').css('margin-top',0);
	}else{
		// $('nav').css("display",'block');
		$('.header-mobile').css('margin-top',"50px");
	}
	if (st > lastScrollTop){
		// downscroll code
		// $('.brand').text('Asagi');
		$(".header-mobile").css('transition',"all .15s linear");
		// $("nav").css('transition',"all .15s linear");
		// $('nav').css("display",'none');
		$('.header-mobile').css('margin-top',0);
		$('.right-sticky').css('top',"50px");
	} else {
		// $('.brand').text('Yuxari');
		// upscroll code
		
		$(".header-mobile").css('transition',"all .15s linear");
		// $("nav").css('transition',"all .15s linear");
		// $('nav').css("display",'block');
		$('.header-mobile').css('margin-top',"58px");
		$('.right-sticky').css('top',"58px");
	}
	lastScrollTop = st;
	});


	// Canli izle

	function readURL(input) {
		files = [];
		// if (input.files && input.files[0]) {
		//  for (var i=0; i < input.files.length; i++) {
		[...input.files].map((file,index)=>{			
		  	var reader = new FileReader();
			const item = document.createElement('div');
		  	reader.onload = function(e) {
				item.className = 'item';
				item.innerHTML = `
					<img style='width: 100px; margin: 10px; height: 80px' src="${e.target.result}" />
					<div class='bar'> <span></span> </div>
					`;
					files.push({
						file,
						el: item
					});
				result.appendChild(item);
			}
			
			if (input.files[0]) {reader.readAsDataURL(input.files[index])}
		})
	  }
  
  
	  $("#imgfile").change(function() {
		readURL(this);
	  });

	  function fileUpload(index){
		// console.log(files);
		t = document.querySelector('.t').value;
		// console.log(fileInput);
		const {file, el} = files[index];
		const formData = new FormData();
		formData.append('image', file);
		formData.append('_token',csrf);
		formData.append('t',t);
		
		const request = new XMLHttpRequest();

		 request.addEventListener('load', function(){
			if (index + 1 < files.length){
				fileUpload(index+1);
			}else{
				files = [];
				$('.sell-share').attr('disabled',false)
				console.log('Yükləmə bitdi');
			}
		 });

		 request.upload.addEventListener('progress', function(e){
			let faiz = (e.loaded / e.total) * 100;
			$('.progress-box').html('<div class="progress"><div class="progress-bar" role="progressbar" style="width: '+faiz+'%" aria-valuenow="'+faiz+'" aria-valuemin="0" aria-valuemax="100"></div></div>');
		 });


		 
		 request.open("POST", '/uploadImage');
		 request.send(formData);
		 request.onreadystatechange = function(e) {
			if (this.readyState == 4 && this.status == 200) {
				console.log(this.responseText);
			}else{
				console.log(this.responseText, JSON.stringify(e));
			}
		}
	}
  
const fileInput = document.querySelector('#file') ? document.querySelector('#file') : null,
	  result = document.querySelector('.izle');
	
	  files = [];

	if(fileInput){
	fileInput.addEventListener('change', function(){
		$('.sell-share').attr('disabled',true);
		// alert('Changed');
		[...this.files].map((file, index)=>{
			if(file.name.match(/\.jpe?g|png|gif/)){
				const reader = new FileReader();
				reader.addEventListener('load', function(){
					const item = document.createElement('div');
					item.className = 'item';
					item.innerHTML = `<img style='width: 100px; margin: 10px; height: 80px' src='${this.result}' />`;
					result.appendChild(item);
					// files.push({
					// 	el: item
					// });
				});

				files.push({
					file,
				});

					reader.readAsDataURL(file);
			}else{
				alert('error');
			}
		})
	
		fileUpload(0);
	});
}
function isNum(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

	return true;
}