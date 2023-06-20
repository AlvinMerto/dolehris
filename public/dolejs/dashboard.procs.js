let startdate = null;
let enddate   = null; 

// all dates applied
	var alldates = [];
// end 

// the months 
	var themonth = ["January","February","March","April","May","June","July","August","September","October","November","December"];
// end the months

let selectedleave  = null;
let commutationid  = null;
let vacationlocid  = null;

// let dashboard_navs = null;
class Dashboard {
	listentoevent() {
		$(document).ready(function(){
			// alert(dp.getCookie("dashboardnavigation"))
			if (dp.getCookie("dashboardnavigation") == "") {
                // set the navigation here
                dp.setCookie("dashboardnavigation","leaveapplications", 365);
            }

			dp.thenavigation( dp.getCookie("dashboardnavigation") , 'dashboard' , 0 ,"inside-nav-ul",0, function(){
				db.transformcalendar();
			});
		});

		$(document).on("change","#leavetypeselect", function(){
			let theval = $(this).val();

			if (theval == "0") {
				$(document).find("#changecomponents").html("");
				return;
			}

			let thenewnav = theval.split("_")[1]; // the selected leave full name
			selectedleave = theval.split("_")[0]; // the selected leave id

			db.showleavewindow( thenewnav );

		});

		$(document).on("click",".iscommutation", function(){
			commutationid = $(this).val();
		});

		$(document).on("click",".vacationloc", function(){
			vacationlocid = $(this).val();
		});

		$(document).on("click","#sendapplication", function(){
			let lts 						= $(document).find("#leavetypeselect").val();

			var details 					= new Object();
				details.leavetypeid			= selectedleave;
				details.thedateinquestion 	= "0";
				details.numberofdays 		= alldates.length;
				details.personnelid 		= $(this).data("id");
				details.commutationid 		= commutationid;

			// save to leave applications
			dp.savethis("leaveapplications", details, 0, function(leaveid){
				//** if vacation leave:: save to vacation leave details 
					let leavedetails 						= new Object();
						leavedetails.leaveapplicationid		= leaveid;
						leavedetails.vacationlocationid		= vacationlocid;
						leavedetails.specify 				= $(document).find("#specificloc").val();

					dp.savethis("vacationleavedetails", leavedetails, 0, function(vldetailsid){

					});
				//* end vacation leave 

				//** if sick leave:: save to sick leave details 
					//** code here
				//* end sick leave details

				// **------ save to inclusive dates ------------
					// ** 
						dp.savetoinclusivedates(leaveid, alldates, function(data){
							//if (data) {
								// save to leave cards 
									dp.savetoleavecard(selectedleave, leaveid, function(data){
										console.log(data);
									});
								// end saving to leave cards
							//}
						});
						// $.ajax({
						// 	url 	 : url+"/savemultiple",
						// 	type     : "get",
						// 	data     : { leaveapplicationid : 1 , thedates : alldates },
						// 	dataType : "json",
						// 	success  : function(data){
						// 		if (data) {
						// 			alert("success");
						// 		}
						// 	}, error : function(){
						// 		alert("Error saving multiple entries to database");
						// 	}
						// });
					// *
				// **------ end inclusive dates ----------------

				
			});
		});

	}

	addtoqueue(from, to, somefunction) {
		let startDate = new Date(from);
		let endDate   = new Date(to);
		 
		let thestartdate = themonth[startDate.getMonth()]+" "+startDate.getDate()+", "+startDate.getFullYear();
		let theenddate   = themonth[endDate.getMonth()]+" "+endDate.getDate()+", "+endDate.getFullYear();

		$.ajax({
			url 	: url+"/checkvaliddates",
			type    : "post",
			data    : { startdate : thestartdate, todate : theenddate },
			dataType: "json",
			success : function(data){
				somefunction(data);
				// $("<small>"+data+"</small>").appendTo("#moredates");
			}, error : function(){
				alert("error");
			}
		});
	}

	transformcalendar() {
		$(document).find('.datepick_txtbox').daterangepicker({
            "autoApply": true,
        }, function(start, end, label) {
        	startdate = start;
        	enddate   = end;

        	db.addtoqueue(startdate, enddate, function(data){
        		if (data.length > 0) {
					for(var i=0;i<=data.length-1;i++) {
						alldates.push(data[i]);

						$("<small class='thedatespan'><strong>[</strong> "+data[i]+" <strong>]</strong></small>")
							.appendTo("#moredates")
							.on("click",function(){
								var conf = confirm("Are you sure you want to remove this?");

								if (!conf) {
									return;
								}

								let indx  = alldates.indexOf( data[i] );
	                			alldates.splice(indx,1);

	                			$(this).remove();

							});
					}
				}
        	});

        });
	}

	addtodates(data) {
				if (data.length > 0) {
					for(var i=0;i<=data.length-1;i++) {
						alldates.push(data[i]);

						$("<small class='thedatespan'><strong>[</strong> "+data[i]+" <strong>]</strong></small>")
							.appendTo("#moredates")
							.on("click",function(){
								var conf = confirm("Are you sure you want to remove this?");

								if (!conf) {
									return;
								}

								let indx  = alldates.indexOf( data[i] );
	                			alldates.splice(indx,1);

	                			$(this).remove();

							});
					}
				}
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

