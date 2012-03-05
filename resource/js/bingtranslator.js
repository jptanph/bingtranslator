$(document).ready(function() {				
	$(".bingmenua").click(function (event) {					
		if ( $("#bingtranslator").css('left') == '30px' ) {
			$("#bingtranslator").css('left','-350px');
		} else if ( $("#bingtranslator").css('left') == '-350px' ) {
			$("#bingtranslator").css('left','30px');
		}
		event.preventDefault();
	});	
	$(".bingtranslate_close").click(function (event) {
		$("#bingtranslator").css('left','-350px');
		event.preventDefault();
	});	
	$("#translate").click(function (event) {
		
		$("#translated_text").css('background','#fff url(\'images/loader.gif\') no-repeat center center');
		//some ajax stuff here
		$('#translated_text').load('test.html #test');
		$("#translated_text").css('background','#fff none no-repeat center center');
		event.preventDefault();
		return false;
	});		
});