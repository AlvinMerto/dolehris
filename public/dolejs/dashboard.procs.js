class Dashboard {
	listentoevent() {
		$(document).on("change","#leavetypeselect", function(){
			let theval = $(this).val();

			if (theval == "0") {
				$(document).find("#changecomponents").html("");
				return;
			}

			db.showleavewindow( theval );
		});

		$(document).on("click","#sendapplication", function(){
			alert("Send Application");
		});
	}

	showleavewindow(thenav, somefunction = false) {
		$(document).find("#changecomponents").html("loading...");
		$.ajax({
			url 	 : url+"/"+thenav,
			type 	 : "GET",
			data     : { },
			dataType : "html",
			success  : function(data) {
				if (somefunction != false) {
					somefunction(data);
				}
				$(document).find("#changecomponents").html(data);
			}, error : function() {
				alert("There was an error in getting the leave component that you are requesting. Contact Support.");
			}
		});
	}
}

let db = new Dashboard();
	db.listentoevent();