

$(document).ready(function(){
	
	$(".unsave").hover(function(){
		$(this).removeClass("far").addClass("fa");
	});
	
	// $(".unsave").mouseleave(function(){
	// 	$(this).removeClass("fa").addClass("far");
	// });
	// 	$(this).removeClass("fa").addClass("far");

	$(".unsave").on('click',function(){
		$(this).removeClass("far unsave").addClass("fa save");
		
	});

	// Canli izle

	function readURL(input) {
	  if (input.files && input.files[0]) {
	   for (var i=0; i <= input.files.length; i++) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
       		$(".izle").append("<img style='width: 100px; margin: 10px; height: 80px' src="+e.target.result+" />");
	    }
	    
	    reader.readAsDataURL(input.files[i]);
	    }
	  }
	}

	$("#imgfile").change(function() {
	  readURL(this);
	});

	const mini_close = ()=>{
		$('.mini-slide-cover').css('visibility','hidden');
		$('.full-opacity').css('visibility','hidden');
		$('body').css("overflow","visible");
	  }

	  const right = ()=>{
		index++;
		if(index > count_photos){index = 0;}
		const img = $("#mini-gallery div").find('[data-index="'+(index)+'"]').attr('src');
		$('.mini-slide').find('img').attr('src',img);
	}
	
	const left = ()=>{
		index--;
		if(index < 0){index = count_photos;}
		const img = $("#mini-gallery div").find('[data-index="'+(index)+'"]').attr('src');
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

	$('#mini-gallery div').on("click", function(){
		const image = $(this).find('img').attr('src');
		index = $(this).find('img').data('index');
		$('.mini-slide').find('img').attr('src',image);
		$('body').css("overflow","hidden");
		$('.mini-slide-cover').css('visibility','visible');
		$('.full-opacity').css('visibility','visible');
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

	$('.mini-slide').on('swipeleft', function(event){
		left();
	});

	$('.mini-slide').on('swiperight', function(event){
		right();
	});

});

var lastScrollTop = 0;
	document.addEventListener('scroll',function(event){
	var st = $(this).scrollTop();
	if(st > 70){
		$(".header").css('transition',"all .1s linear");
		$("nav").css('transition',"all .1s linear");
		$('nav').css("display",'none');
		$('.header').css('margin-top',0);
	}else{
		$('nav').css("display",'block');
		$('.header').css('margin-top',"50px");
	}
	if (st > lastScrollTop){
		// downscroll code
		// $('.navbar-brand').text('Asagi');
		$(".header").css('transition',"all .15s linear");
		$("nav").css('transition',"all .15s linear");
		$('nav').css("display",'none');
		$('.header').css('margin-top',0);
	} else {
		// $('.navbar-brand').text('Yuxari');
		// upscroll code
		
		$(".header").css('transition',"all .15s linear");
		$("nav").css('transition',"all .15s linear");
		$('nav').css("display",'block');
		$('.header').css('margin-top',"50px");
	}
	lastScrollTop = st;
	});