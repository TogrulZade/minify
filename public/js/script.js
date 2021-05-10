$(document).ready(function(){
	
	$(".unsave").hover(function(){
		$(this).removeClass("far").addClass("fa");
	});
	
	// $(".unsave").mouseleave(function(){
	// 	$(this).removeClass("fa").addClass("far");
	// });
	// 	$(this).removeClass("fa").addClass("far");

	$(".unsave").click(function(){
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