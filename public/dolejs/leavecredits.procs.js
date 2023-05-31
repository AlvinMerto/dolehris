class leavecredits {
	lc_listen() {
		$(document).on("click","#fbbtn", function(){
			$("#themodal").modal("show");

			let div = "<div class='pd-30'>"+
						"<h5> Forward Balance </h5>"+
						"<div class='mg-b-10'> <input type='date' class='form-control'/> </div>"+
						"<div class='mg-b-10'> <input type='text' class='form-control'/> </div>"+
						"<button class='btn btn-primary'> Forward Balance </button>"+
					  "</div>";

			$(document).find("#showwindowhere").html(div);
		});
	}
}

let lc = new leavecredits();
	lc.lc_listen();