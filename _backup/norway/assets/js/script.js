$(document).ready(function(){

	// var _url = "https://customizer.blindsave.com/api.php";

	var _url = "https://customizer.blindsave.com/norway/api.php";

	var _colors = {
		"1":"000000",
		"2":"FFFFFF",
		"3":"00693F",
		"4":"E00000",
		"5":"006EB3",
		"6":"FFEA34",
		"7":"FF9100",
		"8":"512682",
		"9":"11AEE2",
		"10":"BD3584",
		"11":"808080",
		"12":"00FF00",
		
	}

	var svg_fill = "fill";

	var _current_uniform = "";
	_current_uniform = $(".uniform-svg:not(hidden)").attr("data-uniform");
	$("input[name='c_uniform']").val(_current_uniform);
	initBlackUniform2();


	//alert(_current_uniform);
	$(".uniform-change-button").off("click").on("click",function(e){
		e.preventDefault();
		var uniform = $(this).attr("data-uniform");
		
		changeUniform(uniform);

		
	});

	function changeUniform(uniform){
		if (_current_uniform!=uniform){

			_current_uniform = uniform;
			$("input[name='c_uniform']").val(_current_uniform);

			
			TweenLite.to($(".uniform-svg"), 0, {ease:Power1.easeOut, opacity:1, x: 0, delay: 0, onComplete: function(){}});
			TweenLite.to($(".uniform-parts-list"), 0.3, {ease:Power1.easeOut, opacity:0, x: 0, delay: 0, onComplete: function(){}});

			TweenLite.to($(".uniform-svg"), 0.3, {ease:Power1.easeOut, opacity:0, x: -100, delay: 0, onComplete: function(){
				$(".uniform-svg").addClass("hidden");	
				$(".uniform-parts-list").addClass("hidden");
				$("."+uniform).removeClass("hidden");
				$(".uniform-parts-list[data-uniform='"+uniform+"']").removeClass("hidden");
				TweenLite.to($("."+uniform), 0, {ease:Power1.easeOut, opacity:0, x: 100, delay: 0, onComplete: function(){}});
				TweenLite.to($("."+uniform), 0.3, {ease:Power1.easeOut, opacity:1, x: 0, delay: 0, onComplete: function(){}});

				TweenLite.to($(".uniform-parts-list[data-uniform='"+uniform+"']"), 0, {ease:Power1.easeOut, opacity:0, x: 0, delay: 0, onComplete: function(){}});
				TweenLite.to($(".uniform-parts-list[data-uniform='"+uniform+"']"), 0.3, {ease:Power1.easeOut, opacity:1, x: 0, delay: 0, onComplete: function(){}});
			}});

		}
	}


	$("input[type='checkbox']").change(function(e){
		if ($(this).closest(".checkbox-field").find("input:checked").length==0){
			$(this).closest(".checkbox-field").removeClass("checked");	
		}else{
			$(this).closest(".checkbox-field").addClass("checked");
		}
	});

	$(".printing-checkbox input").change(function(e){
		if ($(this).closest(".checkbox-field").find("input:checked").length==0){
			$(".printing-expand").removeClass("open");	
			//setTotalPrice($(".total-wrap").data("main-price"));
		}else{
			$(".printing-expand").addClass("open");	
			//setTotalPrice($(".total-wrap").data("main-price"));
		}
	});
	function checkPrice(){
		addPrice = 0;
		if($("select[name='number']").val()!=""){
			//addPrice+=20;
			addPrice = 25;
		}
		if($("input[name='print-name']").val()!=""){
			//addPrice+=20;
			addPrice = 25;
		}
		setTotalPrice($(".total-wrap").data("main-price")+addPrice);
	}
	// $("select[name='number']").change(function(e){
	// 	checkPrice();
	// });
	// $("input[name='print-name']").keyup(function(e){
	// 	checkPrice();
	// });
	// $("input[name='print-name']").change(function(e){
	// 	checkPrice();
	// });

	function setTotalPrice(price){
		var main_price = $(".total-wrap").data("main-price");
		$(".total-wrap").find(".total").html(price);
		$("input[name='total_price']").val(price);
	}
	setTotalPrice(3699);

	$(".uniform-parts-item .title").click(function(e){
		e.preventDefault();

		if ($(this).closest(".uniform-parts-item").hasClass("open")){
			$(".uniform-parts-item").removeClass("open");
		}else{
			$(".uniform-parts-item").removeClass("open");
			$(this).closest(".uniform-parts-item").addClass("open");
		}
	});


	$(".uniform-design-button").click(function(e){
		e.preventDefault();
		$(".uniform-design-button").removeClass("selected");
		$(this).addClass("selected");

		var design = $(this).data("design");
		var uniform = $(this).data("uniform");

		if (_current_uniform!=uniform){
			changeUniform(uniform);

			$(".design-buttons").closest(".uniform-parts-item").addClass("open");
		}

		$(".uniform-design-button[data-uniform='"+uniform+"'][data-design='"+design+"']").addClass("selected");

		if (uniform == "svg-uniform-1"){
			if (design == "black"){ initBlackUniform1(); }
			if (design == "white"){ initWhiteUniform1(); }
		}
		if (uniform == "svg-uniform-2"){
			initBlackUniform2(); 
		}
		

	});

	$(".uniform-parts-item .colors a").click(function(e){
		e.preventDefault();
		var part = $(this).closest(".colors").data("part");
		var color = $(this).data("color");
		color = _colors[color];

		$(this).closest(".colors").find("a").removeClass("selected");
		$(this).addClass("selected");

		if (part=="shoulders"){ setShoulderColor(color); }
		if (part=="chest"){ setChestColor(color); }
		if (part=="logo-line"){ setLogoLineColor(color); }
		if (part=="other-logos-1"){ setLogo1Color(color); }
		if (part=="other-logos-2"){ setLogo2Color(color); }
		if (part=="other-logos-3"){ setLogo3Color(color); }
		if (part=="other-logos-4"){ setLogo4Color(color); }
		if (part=="belly"){ setBellyColor(color); }
		if (part=="tights"){ setTightsColor(color); }
		if (part=="shins"){ setShinsColor(color); }
		if (part=="lines"){ setLinesColor(color); }

		if (part=="jersey"){ setJerseyAndArmsTopColor(color); }
		if (part=="jersey-2"){ setJerseyAndArmsBottomColor(color); }
		if (part=="elbow-armpit"){ setElbowAndArmpitColor(color); }
		if (part=="sleeve"){ setSleeveColor(color); }
		if (part=="shins-2"){ setShins2Color(color); }
		if (part=="shins-3"){ setShins3Color(color); }
		
		
		
	});

	$(".next-button").click(function(e){
		e.preventDefault();
		$(".main").addClass("submit-step");
		if ( $(window).width() <= 800 ) {
			$('html').animate({
	                // scrollTop: 0
	                scrollTop: $(".form-wrapper").offset().top
	        }, 500, function(){ });
       	}
	});
	$(".change-colors").click(function(e){
		e.preventDefault();
		$(".main").removeClass("submit-step");
	});


	$(".submit-form").submit(function(e){
		e.preventDefault();
	});
	$(".order-button").click(function(e){
		e.preventDefault();


		var input_len = $(".input-field.required").length;

		var total_ok = true;

		for (var i=0; i<input_len; i++){
			var ok = true;	
			var elem = $(".input-field.required").eq(i);
			if (elem.hasClass("required-input")){
				var val = elem.find("input").val();
				if (val==""){ ok=false; }
			}
			if (elem.hasClass("required-select")){
				var val = elem.find("select").val();
				if (val==""){ ok=false; }
			}

			if (elem.hasClass("validate-email")){
				if (!validateEmail(val)){ ok=false; }
			}

			if (!ok){ elem.addClass("wrong"); total_ok = false; }
		}

		
		if (total_ok){
				

			function initSubmitForm(){

				//var svg = $(".uniform-svg").html();

				var svg = $("."+_current_uniform).html();


				var svg_base = btoa(svg);
				var svg_base2 = "";
				var svg_base_array = Array();
				
				var i=0;
				var chunk_size = 1024*100;
				while (svg_base2!=svg_base){
					var a = svg_base.substring(i*chunk_size,chunk_size*(i+1));
					svg_base_array.push(a);
					svg_base2+=a;
					i++;
					if(i==100) break;
				}

				var svg_part_i = 0;

				$(".popup").addClass("display");
				$(".loading-popup").addClass("visible");
				setTimeout(function(){
					$(".popup").addClass("visible");
				},10);


				function submitSVGParts(calback){
					if (svg_part_i>=svg_base_array.length){
						calback();
					}else{
						$.ajax({
					        url: _url,
					        type: "POST",
					        // async: false,
					        data: {"act": "svg_part", "part_id": svg_part_i , "data":svg_base_array[svg_part_i]},
					        success: function(r) {
					        	svg_part_i++;
					           	submitSVGParts(calback);
					        },
					        error: function(r){ showConnectionError(); }
					    });
					}
				}

				function clearBeforeSVGParts(success){
					$.ajax({
				        url: _url,
				        type: "POST",
				        async: false,
				        data: {"act": "svg_part_cleanup", "part_id": svg_part_i , "data":svg_base_array[svg_part_i]},
				        success: function(r) {
				        	success();
				        },
				        error: function(r){ showConnectionError(); }
				    });
				}
				
				clearBeforeSVGParts(function(){
					submitSVGParts(function(){
						var serialArray = $(".submit-form").serializeArray();
						$.ajax({
					        url: _url,
					        type: "POST",
					        // async: false,
					        data: serialArray,
					        cache: false,
					        contentType: "application/x-www-form-urlencoded",
					        success: function(r) {
					           	// alert("Login "+r);
					            var data = JSON.parse(r);
					            console.log(data['messages']);
					            if (data['success']){
					                $(".accepted-popup").addClass("display");
					                $(".loading-popup").removeClass("visible");
									setTimeout(function(){
										$(".accepted-popup").addClass("visible");
									},10);
					            }
					        },
					        error: function(r){ showConnectionError(); }
					    });
					});
				});

			}

			initSubmitForm();

			

		}else{
			$(".form-alert-note").addClass("visible");

		}

		
		
		//serialArray.push({"name":"uniform-svg", "value":svg_base});
		//serialArray.push({"name":"uniform-svg2", "value":svg_base2});

		

		

		setTimeout(function(){
			$(".input-field").removeClass("wrong");
			$(".form-alert-note").removeClass("visible");
		},2000);
	});
	
	function setSleeveColor(color){
		// $("input[name='c_sleeve']").val(color);
		// $(".sleeve-accent-2").css(svg_fill, "#"+color);
		// $(".chest-accent-2").css(svg_fill, "#"+color);
		//$(".chest").css(svg_fill, "#"+color);
		
		// $(".sleeve-accent-2").css(svg_fill, "#"+color);
	// .sleeve-accent-1 { fill: violet; }
 //                    .sleeve-accent-2 { fill: pink; }
 //                    .chest-accent-1 { fill: teal; }
 //                    .chest-accent-2 { fill: blue; }
 //                    .shirt-logo { fill: red; }*/
	}
	function setJerseyAndArmsTopColor(color){
		$("input[name='c_jersey']").val(color);
		$(".sleeve").css(svg_fill, "#"+color);
		$(".chest").css(svg_fill, "#"+color);
	}
	function setJerseyAndArmsBottomColor(color){
		$("input[name='c_jersey_2']").val(color);
		// $(".sleeve").css(svg_fill, "#"+color);
		$(".sleeve-accent-2").css(svg_fill, "#"+color);
		$(".chest-accent-2").css(svg_fill, "#"+color);
	}
	function setElbowAndArmpitColor(color){
		$("input[name='c_elbow_armpit']").val(color);
		$(".sleeve-accent-1").css(svg_fill, "#"+color);
		$(".chest-accent-1").css(svg_fill, "#"+color);
	}







	function setShoulderColor(color){
		$("input[name='c_shoulder']").val(color);
		$("#uniform-svg-sh-r-f").css(svg_fill, "#"+color);
		$("#uniform-svg-sh-l-f").css(svg_fill, "#"+color);
		$("#uniform-svg-sh-b").css(svg_fill, "#"+color);
	}
	function setChestColor(color){
		$("input[name='c_arms']").val(color);
		$("#uniform-svg-chest").css(svg_fill, "#"+color);
		$("#uniform-svg-back").css(svg_fill, "#"+color);
	}
	function setLogoLineColor(color){
		$("input[name='c_logo_line']").val(color);
		$("#uniform-svg-logo-line-f").css(svg_fill, "#"+color);
		$("#uniform-svg-logo-line-r-b").css(svg_fill, "#"+color);
		$("#uniform-svg-logo-line-l-b").css(svg_fill, "#"+color);
	}
	function setLogo1Color(color){
		$("input[name='c_logo_1']").val(color);

		if (_current_uniform=='svg-uniform-1'){
			$("#uniform-svg-chest-logo-small").css(svg_fill, "#"+color);
		}
		if (_current_uniform=='svg-uniform-2'){
			$("input[name='c_logo_2']").val(color);
			$(".shirt-logo").css(svg_fill, "#"+color);
		}

		
	}
	function setLogo2Color(color){
		$("input[name='c_logo_2']").val(color);

		if (_current_uniform=='svg-uniform-1'){
			for(var i=1;i<=9;i++){
				$("#uniform-svg-chest-logo-"+i).css(svg_fill, "#"+color);
			}
		}
	}
	function setLogo3Color(color){
		$("input[name='c_logo_3']").val(color);
		if (_current_uniform=='svg-uniform-1'){
			for(var i=1;i<=18;i++){
				$("#uniform-svg-tight-logo-"+i).css(svg_fill, "#"+color);
			}
		}
		if (_current_uniform=='svg-uniform-2'){
			$(".pants-front-logo").css(svg_fill, "#"+color);
		}
		
	}
	function setLogo3BackgroundColor(color){
		for(var i=1;i<=2;i++){
			$("#uniform-svg-tight-logo-b-"+i).css(svg_fill, "#"+color);
		}
	}
	function setLogo4Color(color){
		$("input[name='c_logo_4']").val(color);

		if (_current_uniform=='svg-uniform-1'){
			for(var i=1;i<=18;i++){
				$("#uniform-svg-shin-logo-"+i).css(svg_fill, "#"+color);
			}
		}
		if (_current_uniform=='svg-uniform-2'){
			$(".pants-back-logo").css(svg_fill, "#"+color);
		}
		
	}
	function setBellyColor(color){
		$("input[name='c_waist']").val(color);
		$("#uniform-svg-belly").css(svg_fill, "#"+color);
	}
	function setTightsColor(color){
		$("input[name='c_tights']").val(color);

		if (_current_uniform=='svg-uniform-1'){
			for(var i=1;i<=15;i++){
				$("#uniform-svg-tights-"+i).css(svg_fill, "#"+color);
			}
		}
		if (_current_uniform=='svg-uniform-2'){
			
				$(".pants-peace-2").css(svg_fill, "#"+color);
				$(".pants-peace-3").css(svg_fill, "#"+color);
				$(".pants-peace-9").css(svg_fill, "#"+color);
				$(".pants-peace-10").css(svg_fill, "#"+color);
				// $(".pants-peace-11").css(svg_fill, "#"+color);
				// $(".pants-peace-4").css(svg_fill, "#"+color);
			
		}
	}
	function setShinsColor(color){
		$("input[name='c_shins']").val(color);
		if (_current_uniform=='svg-uniform-1'){
			for(var i=1;i<=4;i++){
				$("#uniform-svg-shins-"+i).css(svg_fill, "#"+color);
			}
		}
		if (_current_uniform=='svg-uniform-2'){
			$(".pants-peace-1").css(svg_fill, "#"+color);
			$(".pants-peace-8").css(svg_fill, "#"+color);
			
		}
	}
	function setShins2Color(color){
		$("input[name='c_shins_2']").val(color);
		if (_current_uniform=='svg-uniform-2'){
			$(".pants-peace-4").css(svg_fill, "#"+color);
		}
	}
	function setShins3Color(color){
		$("input[name='c_shins_3']").val(color);
		if (_current_uniform=='svg-uniform-2'){
			$(".pants-peace-6").css(svg_fill, "#"+color);
			$(".pants-peace-7").css(svg_fill, "#"+color);

			$(".pants-peace-11").css(svg_fill, "#"+color);
			$(".pants-peace-12").css(svg_fill, "#"+color);
		}
	}
	function setLinesColor(color){
		$("input[name='c_lines']").val(color);
		
		if (_current_uniform=='svg-uniform-1'){
			for(var i=1;i<=29;i++){
				$("#uniform-svg-lines-f-"+i).css(svg_fill, "#"+color);
			}
		}
		if (_current_uniform=='svg-uniform-2'){
			$(".lines").css(svg_fill, "#"+color);
			
		}
	}
	function setMainLinesColor(color){
		for(var i=1;i<=25;i++){
			$("#uniform-svg-main-lines-"+i).css(svg_fill, "#"+color);
		}
	}
	
	function initBlackUniform1(){
		
		$("input[name='c_design']").val(1);
		setShoulderColor("000000");
		setChestColor("000000");
		setLogoLineColor("FFFFFF");
		setLogo1Color("FFFFFF");
		setLogo2Color("000000");
		setLogo3Color("000000");
		setLogo3BackgroundColor("FFFFFF");
		setLogo4Color("FFFFFF");
		setBellyColor("000000");
		setTightsColor("000000");
		setShinsColor("000000");
		setLinesColor("FFFFFF");
		setMainLinesColor("FFFFFF");
	}
	function initWhiteUniform1(){
		$("input[name='c_design']").val(2);
		setShoulderColor("FFFFFF");
		setChestColor("FFFFFF");
		setLogoLineColor("000000");
		setLogo1Color("000000");
		setLogo2Color("FFFFFF");
		setLogo3Color("FFFFFF");
		setLogo3BackgroundColor("000000");
		setLogo4Color("000000");
		setBellyColor("FFFFFF");
		setTightsColor("FFFFFF");
		setShinsColor("FFFFFF");
		setLinesColor("000000");
		setMainLinesColor("000000");
	}
	
	function initBlackUniform2(){
		$("input[name='c_design']").val(1);
		// setSleeveColor("000000");
		setJerseyAndArmsTopColor("000000");
		setJerseyAndArmsBottomColor("676865");
		setElbowAndArmpitColor("FFFFFF");
		setTightsColor("000000");
		setLinesColor("FFFFFF");
		setShinsColor("000000");
		setShins2Color("FFFFFF");
		setShins3Color("676865");
		setLogo1Color("FFFFFF");
		setLogo3Color("FFFFFF");
		setLogo4Color("000000");

		
	}

	function initColors(){

		

		//initBlackUniform1();

		$(".uniform-parts-item .colors a").each(function(){
			var color = $(this).data("color");
			$(this).find(".color").css("background-color", "#"+_colors[color]);
		});

		setTimeout(function(){
			$("body").append('<style>svg path,svg polygon, svg g{-webkit-transition: all 400ms; -moz-transition: all 400ms; -ms-transition: all 400ms; -o-transition: all 400ms; transition: all 400ms;}</style>');
		},100);
		

	}
	initColors();
});


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}