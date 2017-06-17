var menu_action = function(){
		$("#menu").find("li.active").removeClass("active");
		$("#menu").find(".sub-nav:visible").toggle();
		$("#menu").find(".caret").css("transform","rotate(0deg)");
		var target = $(this).parents("li");
		target.addClass("active");
		if ( target.find("ul.sub-nav").length > 0 ) 
		{	
			target.find("ul.sub-nav").toggle();
			var deg = target.find("ul.sub-nav:visible").length > 0 ? 180 : 0 ;
			target.find(".caret").css("transform","rotate("+deg+"deg)");
		};
	},
	Show_current_position = function(){
		var service_id = $(".service_id").val();
		if (parseInt(service_id) > 0)
		{
			$("[page='page"+service_id+"']").parents(".sub-nav").toggle();
			$("[page='page"+service_id+"']").parents("li:first").addClass("active");			
		};
	},
	RemoveBtn = function(){
		$(this).parents(".clone").remove();
	},
	AddBtn = function(){
		var target_class = $(this).attr("target");
		$("."+target_class+":first").clone().insertAfter("."+target_class+":last").toggle();
	},
	ClickAll = function(){
		var group = $(this).attr("group"),
			Dom = $("[group='"+group+"']"),
			status = Dom.prop("checked") == true ? true : false ;

		Dom.each(function(e){
			$(this).prop("checked", status);
		});
	},
	Search_tool_display = function() {
		var txt = $("#search_form:visible").length <= 0 ? "隱藏" : "顯示" ;
		$("#search_form").toggle();
		$(".ShowHide").val(txt);
	},
	Refresh_verify_code = function() {
		$.ajax({
			url: "/refresh",
			data: "",
			type: 'POST',
			success: function( response ) {
				response.forEach(function(value, key){
					$(".verify_code>img").eq(key).attr("src", "../_images/"+value+".png");
				});
			}
		});
	},
	Ajax_init = function() {
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	};


Show_current_position();
Ajax_init();
$("#menu>ul>li>a").on("click", menu_action);
$(".addbtn").on("click", AddBtn);
$(document).on("click", "label.removeLabel", RemoveBtn);
$("[alt='main']").on("click", ClickAll);
$("#search_tool>.search_block>.tool>[name='date']").datepicker({dateFormat: "yy-mm-dd"});
$(".ShowHide").on("click", Search_tool_display);
$(".refresh_verify_code").on("click", Refresh_verify_code);