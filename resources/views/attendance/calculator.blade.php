<style>
// calculator 
    .body-div {
        width: 100%;
        height:100%;
    }

    .inner-body-wrap {
        width: 55%;
		margin: auto;
    }

    input[type='text'] {
    	padding: 35px;
		font-size: 14px;
    }

    .inner-body-wrap p {
    	font-size: 30px;
    }

    .inner-body-wrap p span{
    	font-weight: bold;
    }
// end calculator
</style>
<div class='body-div'>
	<div class='inner-body-wrap'>
		<input type='text' id='am_timein'  class='textinput' placeholder="AM IN" />
		<input type='text' id='am_timeout' class='textinput' placeholder="AM OUT" />
		<input type='text' id='pm_timein'  class='textinput' placeholder="PM IN" />
		<input type='text' id='pm_timeout' class='textinput' placeholder="PM OUT" />
	</div>
	<div class='inner-body-wrap' id='theshow'>
		<p> Tardiness: <span id='thetardy'> 00:00:00 </span> = <span id='thetardy_day'> 0.00 days </span> </p>
		<p> Undertime: <span id='theunder'> 00:00:00 </span> = <span id='theunder_day'> 0.00 days </span></p>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
	$(document).on("keypress", ".textinput", function(e){
		if (e.keyCode == 13) {
			let thefocus = this.id;

			if (thefocus == "am_timein") {
				$(document).find("#am_timeout").focus();
			} else if (thefocus == "am_timeout") {
				$(document).find("#pm_timein").focus();
			} else if (thefocus == "pm_timein") {
				$(document).find("#pm_timeout").focus();
			} else if (thefocus == "pm_timeout") {
				$(document).find("#am_timein").focus();

				let am_in  = $(document).find("#am_timein").val();
				let am_out = $(document).find("#am_timeout").val();
				let pm_in  = $(document).find("#pm_timein").val();
				let pm_out = $(document).find("#pm_timeout").val();

				$.ajax({
					url 	 : "http://localhost:8000/calculate_tardy_under",
					type 	 : "get",
					data     : { am_in : am_in, am_out : am_out, pm_in : pm_in , pm_out : pm_out},
					dataType : "json",
					success  : function(data) {
						// $(document).find("#theshow").html(data);
						$(document).find("#thetardy").html(data['tardiness']);
						$(document).find("#theunder").html(data['undertime']);
						$(document).find("#thetardy_day").html(data['tardy_day']);
						$(document).find("#theunder_day").html(data['under_day']);
					}, error : function() {
						alert("error");
					}
				})

			}
		}
	});
</script>