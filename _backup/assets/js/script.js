$(document).ready(function(){

	// var _url = "https://customizer.blindsave.com/api.php";

	/* dev */
	var _url = "https://customizer.blindsave.com/api.php";

	// var blindsaveShopifyCart = "https://blindsave.com/cart/";
	var blindsaveShopifyCart = "https://www.blindsavefloorball.com/cart/";
	var qty = "1";
	var withoutPrint = true;
	// var withoutPrintId = "19953940660337";
	// var withPrintId = "21527128080497";
	var withoutPrintId = "31293072212099";
	var withPrintId = "31293072212099";
	var clientInfo = "";

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

	var info = {};
	var link = $("#add-to-cart-button").attr("href");
	$(".input-field.required").find("input").focusout(function() {
		var name = $(this).attr("name");
		switch(name) {
			case "email":
				info.email 		= "checkout[email]=" + $(this).val();
				break;
			case "first-name":
				info.firstName 	= "checkout[shipping_address][first_name]=" + $(this).val();
				break;
			case "last-name":
				info.lastName 	= "checkout[shipping_address][last_name]=" + $(this).val();
				break;
			case "address":
				info.address 	= "checkout[shipping_address][address1]=" + $(this).val();
				break;
			case "city":
				info.city 		= "checkout[shipping_address][city]=" + $(this).val();
				break;
			case "postal":
				info.postal 	= "checkout[shipping_address][zip]=" + $(this).val();
				break;
		}
		clientInfo = "?";
		$.each(info, function(key, val) {
			clientInfo += val+"&";
		});
		clientInfo = clientInfo.substring(0,clientInfo.length - 1);
		var longLink = link+clientInfo;
		$("#add-to-cart-button").attr("href", longLink);
	});

	$(".printing-checkbox input").change(function(e){
		if ($(this).closest(".checkbox-field").find("input:checked").length==0){
			// without print
			withoutPrint = true;
			$(".printing-expand").removeClass("open");	
			//setTotalPrice($(".total-wrap").data("main-price"));
			var newLink = blindsaveShopifyCart+withoutPrintId+":"+qty;
			if (clientInfo.length) {
				newLink = newLink+clientInfo;
			}
			$("#add-to-cart-button").attr("href", newLink);
		}else{
			// with print
			withoutPrint = false;
			$(".printing-expand").addClass("open");	
			//setTotalPrice($(".total-wrap").data("main-price"));
			var newLink = blindsaveShopifyCart+withPrintId+":"+qty;
			if (clientInfo.length) {
				newLink = newLink+clientInfo;
			}
			$("#add-to-cart-button").attr("href", newLink);
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
	setTotalPrice(350);

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
		// e.preventDefault();
		if ( navigator.cookieEnabled ) {
			// cookies work

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

			/* dev */
			// var total_ok = true;
			
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

					console.log("parts");
					console.log(svg_base_array);

					var svg_part_i = 0;

					$(".popup").addClass("display");
					$(".loading-popup").addClass("visible");
					setTimeout(function(){
						$(".popup").addClass("visible");
					},10);

					/* work-around for pop-up-blocked from browser */
					var shopifyUrl = blindsaveShopifyCart+withoutPrintId+":"+qty;

					if ( !withoutPrint ) {
						shopifyUrl = blindsaveShopifyCart+withPrintId+":"+qty;
					}

					if (clientInfo.length) {
						shopifyUrl = shopifyUrl+clientInfo;
					}

					var win = window.open(shopifyUrl, '_blank');
					win.opener = null;
					/**/

					function submitSVGParts(calback){
						if (svg_part_i>=svg_base_array.length){
							calback();
						}else{
							$.ajax({
						        url: _url,
						        type: "POST",
						        async: false,
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
						        async: false,
						        data: serialArray,
						        cache: false,
						        contentType: "application/x-www-form-urlencoded",
						        success: function(r) {
						           	// alert("Login "+r);
						            var data = JSON.parse(r);
						            console.log(data['messages']);
						            if (data['success']){
						            	console.log("YES");
						                $(".accepted-popup").addClass("display");
						                $(".loading-popup").removeClass("visible");
										setTimeout(function(){
											$(".accepted-popup").addClass("visible");
										},10);

								  		/* work-around for pop-up-blocked from browser */
								  		win.location = shopifyUrl;
								  		/**/

										// var win = window.open();
										// win.location = 'https://blindsave.com/cart/19953940660337:1';
										// win.opener = null;
										// win.blur();
										// window.focus();

										// $(".popup").removeClass("display");
										// $(".loading-popup").removeClass("visible");
										// setTimeout(function(){
										// 	$(".popup").removeClass("visible");
										// },10);
						            }
						        },
						        error: function(r){ showConnectionError(); }
						    });
						});
					});

				}

				initSubmitForm();
				// return true;
				return false;

			}else{
				$(".form-alert-note").addClass("visible");

				setTimeout(function(){
					$(".input-field").removeClass("wrong");
					$(".form-alert-note").removeClass("visible");
				},2000);

				return false;
			}
			
			//serialArray.push({"name":"uniform-svg", "value":svg_base});
			//serialArray.push({"name":"uniform-svg2", "value":svg_base2});

			setTimeout(function(){
				$(".input-field").removeClass("wrong");
				$(".form-alert-note").removeClass("visible");
			},2000);

		} else {
			// cookies don't work
			$(".popup").addClass("display");
			$(".loading-popup").addClass("visible");
			setTimeout(function(){
				$(".popup").addClass("visible");
			},10);

			setTimeout(function(){
				$(".problem-popup").addClass("display");
	            $(".loading-popup").removeClass("visible");
				setTimeout(function(){
					$(".problem-popup").addClass("visible");
				},10);
			},1000);
			return false;
		}
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

	/**********************************************************************************************************************/
	/************************************************* SHOPIFY (NOT USED) *************************************************/
	/**********************************************************************************************************************/

	  // var scriptURL = 'https://sdks.shopifycdn.com/buy-button/latest/buy-button-storefront.min.js'; //.min
	  // var clearedCache = false;

	  // if (window.ShopifyBuy) {
	  //   if (window.ShopifyBuy.UI) {
	  //     ShopifyBuyInit();
	  //   } else {
	  //     loadScript();
	  //   }
	  // } else {
	  //   loadScript();
	  // }

	  // function loadScript() {
	  //   var script = document.createElement('script');
	  //   shopifyScript = document.createElement('script');
	  //   shopifyScript.async = true;
	  //   shopifyScript.src = scriptURL;
	  //   (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(shopifyScript);
	  //   shopifyScript.onload = ShopifyBuyInit;
	  // }

	  // function ShopifyBuyInit() {
	  //   // idNum = typeof idNum !== 'undefined' ? idNum : 1993886597233;  //= 1993886597233

	  //   var client = ShopifyBuy.buildClient({
	  //     domain: 'blindsave.myshopify.com',
	  //     storefrontAccessToken: '5a2227b8fd2d2ef56d0bcc4c2cc1f03c',
	  //   });

	  //   // add-to-cart-button

	  //   // without printing
	  //   ShopifyBuy.UI.onReady(client).then(function (ui) {

	  //   	// console.log(ui);

	  //   	// ui.components.cart[0].lineItemCache = [];
	  //   	// console.log("-----------------------");
	  //   	// console.log(ui);

	  //     ui.createComponent('product', {
	  //       id: [1993886597233], // without printing
	  //       // id: [idNum],
	  //       node: document.getElementById('product-component-2a426705a80'),
	  //       // node: document.getElementById('add-to-cart-button'),
	  //       moneyFormat: '%24%7B%7Bamount%7D%7D',
	  //       options: {
	  //         "product": {
	  //           // "buttonDestination": "onlineStore",
	  //           "variantId": "all",
	  //           "width": "100%",
	  //           "contents": {
	  //             "img": false,
	  //             "imgWithCarousel": false,
	  //             "title": false,
	  //             "variantTitle": false,
	  //             "price": false,
	  //             "description": false,
	  //             "buttonWithQuantity": false,
	  //             "quantity": false
	  //           },
	  //           "styles": {
	  //             "product": {
	  //               "text-align": "left",
	  //               "overflow": "visible",
	  //               "@media (min-width: 601px)": {
	  //                 "max-width": "100%",
	  //                 "margin-left": "0",
	  //                 // "margin-bottom": "50px"
	  //               }
	  //             },
	  //             "buttonWrapper": {
	  //               "position": "relative",
	  //               "margin-top": "0px"
	  //             },
	  //             "button": {
	  //               "position": "absolute",
	  //               "width": "100%",
	  //               "padding": "16px",
	  //               "font-size": "16px",
	  //               "background-color": "#0FAEE2",
	  //               "border-radius": "0px",
	  //               ":hover": {
	  //                 "background-color": "#0FAEE2",
	  //                 "text-decoration": "underline"
	  //               },
	  //               ":focus": {
	  //                 "background-color": "#0FAEE2",
	  //                 "text-decoration": "underline"
	  //               }
	  //             },
	  //             "compareAt": {
	  //               "font-size": "12px"
	  //             }
	  //           },
	  //           "events": {
	  //             addVariantToCart: function (product) {

	  //               // console.log("=======================");
	  //               // console.log(this);
	  //               // console.log("=======================");
	                
	  //               // console.log(this.props.client.checkout);
	  //               // this.props.client.checkout.addLineItems();

	  //               // ui.components.cart[0].empty();
	  //               // console.log(ui.components.cart);
	  //               // $(".shopify-buy__cart").empty();

	  //               var input_len = $(".input-field.required").length;

			// 		var total_ok = true;

			// 		for (var i=0; i<input_len; i++){
			// 			var ok = true;	
			// 			var elem = $(".input-field.required").eq(i);
			// 			if (elem.hasClass("required-input")){
			// 				var val = elem.find("input").val();
			// 				if (val==""){ ok=false; }
			// 			}
			// 			if (elem.hasClass("required-select")){
			// 				var val = elem.find("select").val();
			// 				if (val==""){ ok=false; }
			// 			}

			// 			if (elem.hasClass("validate-email")){
			// 				if (!validateEmail(val)){ ok=false; }
			// 			}

			// 			if (!ok){ elem.addClass("wrong"); total_ok = false; }
			// 		}

					
			// 		if (total_ok){

			// 			product.selectedQuantity = 1;

			// 			function initSubmitForm(){

			// 				//var svg = $(".uniform-svg").html();

			// 				var svg = $("."+_current_uniform).html();


			// 				var svg_base = btoa(svg);
			// 				var svg_base2 = "";
			// 				var svg_base_array = Array();
							
			// 				var i=0;
			// 				var chunk_size = 1024*100;
			// 				while (svg_base2!=svg_base){
			// 					var a = svg_base.substring(i*chunk_size,chunk_size*(i+1));
			// 					svg_base_array.push(a);
			// 					svg_base2+=a;
			// 					i++;
			// 					if(i==100) break;
			// 				}

			// 				var svg_part_i = 0;

			// 				// $(".popup").addClass("display");
			// 				// $(".loading-popup").addClass("visible");
			// 				// setTimeout(function(){
			// 				// 	$(".popup").addClass("visible");
			// 				// },10);


			// 				function submitSVGParts(calback){
			// 					if (svg_part_i>=svg_base_array.length){
			// 						calback();
			// 					}else{
			// 						$.ajax({
			// 					        url: _url,
			// 					        type: "POST",
			// 					        data: {"act": "svg_part", "part_id": svg_part_i , "data":svg_base_array[svg_part_i]},
			// 					        success: function(r) {
			// 					        	svg_part_i++;
			// 					           	submitSVGParts(calback);
			// 					        },
			// 					        error: function(r){ showConnectionError(); }
			// 					    });
			// 					}
			// 				}

			// 				submitSVGParts(function(){
			// 					var serialArray = $(".submit-form").serializeArray();
			// 					$.ajax({
			// 				        url: _url,
			// 				        type: "POST",
			// 				        data: serialArray,
			// 				        cache: false,
			// 				        contentType: "application/x-www-form-urlencoded",
			// 				        success: function(r) {
			// 				           	// alert("Login "+r);
			// 				            var data = JSON.parse(r);
			// 				            console.log(data['messages']);
			// 				            if (data['success']){
			// 				            	console.log("YES");
			// 				    //             $(".accepted-popup").addClass("display");
			// 				    //             $(".loading-popup").removeClass("visible");
			// 								// setTimeout(function(){
			// 								// 	$(".accepted-popup").addClass("visible");
			// 								// },10);
			// 				            }
			// 				        },
			// 				        error: function(r){ showConnectionError(); }
			// 				    });
			// 				});

			// 			}

			// 			initSubmitForm();

			// 		} else {
			// 			product.selectedQuantity = 0;
			// 			$(".form-alert-note").addClass("visible");
			// 		}

			// 		setTimeout(function(){
			// 			$(".input-field").removeClass("wrong");
			// 			$(".form-alert-note").removeClass("visible");
			// 		},2000);

	  //             },
	  //           //   beforeRender: function(product) {
	  //           // 		console.log("-----------------------");
	  //           // 		console.log(this);
	  //           // 		if ( !clearedCache ) {
	  //           // 			// this.lineItemCache = [];

	  //           // // 			var product = ui.components.product.filter(function (product) {
			// 		        // // 	return product.id === 1993886597233;
			// 		        // // })[0];
			// 		        // // product.updateQuantity( function() {
			// 		        // // 	return 0;
			// 		        // // });
			// 		        // // product.selectedQuantity = 0;
	  //           // 			clearedCache = true;
	  //           // 		}
	  //           // 	}
	  //           },
	  //          //  "DOMEvents": {
	  //          //  	'click .shopify-buy__btn': function (evt, target) {
	  //          //  		// console.log("YES");

	  //          //  		var data = target.dataset;
			// 	        // var product = ui.components.product.filter(function (product) {
			// 	        //   return product.id === 1993886597233;
			// 	        // })[0];
			// 	        // product.addVariantToCart(data.option, 1);
	  //          //  	}
	  //          //  }
	  //         },
	  //         "cart": {
	  //           "contents": {
	  //             "button": true
	  //           },
	  //           "styles": {
	  //             "footer": {
	  //               "background-color": "#ffffff"
	  //             }
	  //           },
	  //           "events": {
	  //           	// beforeInit: function (cart) {
   //          		// 	console.log("-----------------------");
   //          		// 	console.log(this);
   //          		// 	// this.lineItemCache = [];
   //          		// 	// console.log(this);
   //          		// 	this.empty();
	  //           	// }
	  //           	// afterInit: function (cart) {
	  //           		// console.log("-----------------------");
   //          			// console.log(this);

   //          // 			var product = ui.components.product.filter(function (product) {
			// 	        // 	return product.id === 1993886597233;
			// 	        // })[0];
			// 	        // product.updateQuantity(0);

			// 	     //    var abc = [];
			// 		    // this.updateCache(abc);
			// 		    // this.empty();
	  //           	// }
	  //           	beforeRender: function(cart) {
	  //           		// console.log("-----------------------1");
	  //           		// console.log(this);
	  //           		// console.log(this.model.lineItems);

	  //           		// if ( clearedCache ) {
	  //           		// 	if ( this.model.lineItems.length > 1 ) {
	  //           		// 		if ( $(".with-print").hasClass("hidden") ) {

	  //           		// 		} else {

	  //           		// 		}
		 //            	// 		this.empty();
		 //            	// 	}	
	  //           		// }

	  //           		if ( !clearedCache ) {
	  //           // 			// this.lineItemCache = [];

	  //           // // 			var product = ui.components.product.filter(function (product) {
			// 		        // // 	return product.id === 1993886597233;
			// 		        // // })[0];
			// 		        // // product.updateQuantity(0);
			// 		        // var abc = [];
			// 		        // this.updateCache(abc);
			// 		        this.empty();
	  //           			clearedCache = true;
	  //           		}
	  //           	}
	  //           }
	  //         },
	  //         "lineItem": {
	  //           "contents": {
	  //             "quantity": false,
	  //             "quantityIncrement": false,
	  //             "quantityDecrement": false,
	  //             "quantityInput": false
	  //           }
	  //         },
	  //         "modalProduct": {
	  //           "contents": {
	  //             "img": false,
	  //             "imgWithCarousel": true,
	  //             "variantTitle": false,
	  //             "buttonWithQuantity": true,
	  //             "button": false,
	  //             "quantity": false
	  //           },
	  //           "styles": {
	  //             "product": {
	  //               "@media (min-width: 601px)": {
	  //                 "max-width": "100%",
	  //                 "margin-left": "0px",
	  //                 "margin-bottom": "0px"
	  //               }
	  //             }
	  //           }
	  //         },
	  //         "productSet": {
	  //           "styles": {
	  //             "products": {
	  //               "@media (min-width: 601px)": {
	  //                 "margin-left": "-20px"
	  //               }
	  //             }
	  //           }
	  //         }
	  //       }
	  //     });
	  //   });

	  //   // with printing
	  //   ShopifyBuy.UI.onReady(client).then(function (ui) {
	  //     ui.createComponent('product', {
	  //       id: [2531178479729], // with printing
	  //       // id: [idNum],
	  //       node: document.getElementById('product-component-0a7f0cfd778'),
	  //       // node: document.getElementById('add-to-cart-button'),
	  //       moneyFormat: '%24%7B%7Bamount%7D%7D',
	  //       options: {
	  //         "product": {
	  //           // "buttonDestination": "onlineStore",
	  //           "variantId": "all",
	  //           "width": "100%",
	  //           "contents": {
	  //             "img": false,
	  //             "imgWithCarousel": false,
	  //             "title": false,
	  //             "variantTitle": false,
	  //             "price": false,
	  //             "description": false,
	  //             "buttonWithQuantity": false,
	  //             "quantity": false
	  //           },
	  //           "styles": {
	  //             "product": {
	  //               "text-align": "left",
	  //               "overflow": "visible",
	  //               "@media (min-width: 601px)": {
	  //                 "max-width": "100%",
	  //                 "margin-left": "0",
	  //                 // "margin-bottom": "50px"
	  //               }
	  //             },
	  //             "buttonWrapper": {
	  //               "position": "relative",
	  //               "margin-top": "0px"
	  //             },
	  //             "button": {
	  //               "position": "absolute",
	  //               "width": "100%",
	  //               "padding": "16px",
	  //               "font-size": "16px",
	  //               "background-color": "#0FAEE2",
	  //               "border-radius": "0px",
	  //               ":hover": {
	  //                 "background-color": "#0FAEE2",
	  //                 "text-decoration": "underline"
	  //               },
	  //               ":focus": {
	  //                 "background-color": "#0FAEE2",
	  //                 "text-decoration": "underline"
	  //               }
	  //             },
	  //             "compareAt": {
	  //               "font-size": "12px"
	  //             }
	  //           },
	  //           "events": {
	  //             addVariantToCart: function (product) {

	  //               // console.log("=======================");
	  //               // console.log(this);
	  //               // console.log("=======================");
	                
	  //               // console.log(this.props.client.checkout);
	  //               // this.props.client.checkout.addLineItems();

	  //               // ui.components.cart[0].empty();
	  //               // console.log(ui.components.cart);
	  //               // $(".shopify-buy__cart").empty();

	  //               var input_len = $(".input-field.required").length;

			// 		var total_ok = true;

			// 		for (var i=0; i<input_len; i++){
			// 			var ok = true;	
			// 			var elem = $(".input-field.required").eq(i);
			// 			if (elem.hasClass("required-input")){
			// 				var val = elem.find("input").val();
			// 				if (val==""){ ok=false; }
			// 			}
			// 			if (elem.hasClass("required-select")){
			// 				var val = elem.find("select").val();
			// 				if (val==""){ ok=false; }
			// 			}

			// 			if (elem.hasClass("validate-email")){
			// 				if (!validateEmail(val)){ ok=false; }
			// 			}

			// 			if (!ok){ elem.addClass("wrong"); total_ok = false; }
			// 		}

					
			// 		if (total_ok){

			// 			product.selectedQuantity = 1;

			// 			function initSubmitForm(){

			// 				//var svg = $(".uniform-svg").html();

			// 				var svg = $("."+_current_uniform).html();


			// 				var svg_base = btoa(svg);
			// 				var svg_base2 = "";
			// 				var svg_base_array = Array();
							
			// 				var i=0;
			// 				var chunk_size = 1024*100;
			// 				while (svg_base2!=svg_base){
			// 					var a = svg_base.substring(i*chunk_size,chunk_size*(i+1));
			// 					svg_base_array.push(a);
			// 					svg_base2+=a;
			// 					i++;
			// 					if(i==100) break;
			// 				}

			// 				var svg_part_i = 0;

			// 				// $(".popup").addClass("display");
			// 				// $(".loading-popup").addClass("visible");
			// 				// setTimeout(function(){
			// 				// 	$(".popup").addClass("visible");
			// 				// },10);


			// 				function submitSVGParts(calback){
			// 					if (svg_part_i>=svg_base_array.length){
			// 						calback();
			// 					}else{
			// 						$.ajax({
			// 					        url: _url,
			// 					        type: "POST",
			// 					        data: {"act": "svg_part", "part_id": svg_part_i , "data":svg_base_array[svg_part_i]},
			// 					        success: function(r) {
			// 					        	svg_part_i++;
			// 					           	submitSVGParts(calback);
			// 					        },
			// 					        error: function(r){ showConnectionError(); }
			// 					    });
			// 					}
			// 				}

			// 				submitSVGParts(function(){
			// 					var serialArray = $(".submit-form").serializeArray();
			// 					$.ajax({
			// 				        url: _url,
			// 				        type: "POST",
			// 				        data: serialArray,
			// 				        cache: false,
			// 				        contentType: "application/x-www-form-urlencoded",
			// 				        success: function(r) {
			// 				           	// alert("Login "+r);
			// 				            var data = JSON.parse(r);
			// 				            console.log(data['messages']);
			// 				            if (data['success']){
			// 				            	console.log("YES");
			// 				    //             $(".accepted-popup").addClass("display");
			// 				    //             $(".loading-popup").removeClass("visible");
			// 								// setTimeout(function(){
			// 								// 	$(".accepted-popup").addClass("visible");
			// 								// },10);
			// 				            }
			// 				        },
			// 				        error: function(r){ showConnectionError(); }
			// 				    });
			// 				});

			// 			}

			// 			initSubmitForm();

			// 		} else {
			// 			product.selectedQuantity = 0;
			// 			$(".form-alert-note").addClass("visible");
			// 		}

			// 		setTimeout(function(){
			// 			$(".input-field").removeClass("wrong");
			// 			$(".form-alert-note").removeClass("visible");
			// 		},2000);

	  //             }
	  //           }
	  //         },
	  //         "cart": {
	  //           "contents": {
	  //             "button": true
	  //           },
	  //           "styles": {
	  //             "footer": {
	  //               "background-color": "#ffffff"
	  //             }
	  //           },
	  //           "events": {
	  //       //     	afterInit: function (cart) {
			// 		    // this.empty();
	  //       //     	}
	  //       		beforeRender: function(cart) {
	  //           		// console.log("-----------------------2");
	  //           		// console.log(this);
	  //           		// console.log(this.model.lineItems);
	  //           		if ( !clearedCache ) {
	  //           // 			// this.lineItemCache = [];

	  //           // // 			var product = ui.components.product.filter(function (product) {
			// 		        // // 	return product.id === 1993886597233;
			// 		        // // })[0];
			// 		        // // product.updateQuantity(0);
			// 		        // var abc = [];
			// 		        // this.updateCache(abc);
			// 		        this.empty();
	  //           			clearedCache = true;
	  //           		}
	  //           	}
	  //           }
	  //         },
	  //         "lineItem": {
	  //           "contents": {
	  //             "quantity": false,
	  //             "quantityIncrement": false,
	  //             "quantityDecrement": false,
	  //             "quantityInput": false
	  //           }
	  //         },
	  //         "modalProduct": {
	  //           "contents": {
	  //             "img": false,
	  //             "imgWithCarousel": true,
	  //             "variantTitle": false,
	  //             "buttonWithQuantity": true,
	  //             "button": false,
	  //             "quantity": false
	  //           },
	  //           "styles": {
	  //             "product": {
	  //               "@media (min-width: 601px)": {
	  //                 "max-width": "100%",
	  //                 "margin-left": "0px",
	  //                 "margin-bottom": "0px"
	  //               }
	  //             }
	  //           }
	  //         },
	  //         "productSet": {
	  //           "styles": {
	  //             "products": {
	  //               "@media (min-width: 601px)": {
	  //                 "margin-left": "-20px"
	  //               }
	  //             }
	  //           }
	  //         }
	  //       }
	  //     });
	  //   });
	  // }

	  // $(".printing-checkbox input").on('change', function(e){
	  //   if ($(this).closest(".checkbox-field").find("input:checked").length==0){
	  //         // without printing
	  //         $(".with-print").addClass("hidden");
	  //         $(".without-print").removeClass("hidden");
	  //   }else{
	  //         // with printing
	  //         $(".with-print").removeClass("hidden");
	  //         $(".without-print").addClass("hidden");
	  //   }
	  // });

});


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}