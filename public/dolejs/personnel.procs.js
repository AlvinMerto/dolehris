let thechosenid = null;

class personnel {

    eventlisteners() {
        $(document).ready(function(){
            var profiledisplay = document.getElementById("displaytabs");

            //thechosenid = gettheurlparameter(5, window.location.href);

            if ( profiledisplay ) {
                $(document).find("#theprofileinput").html("<p class='theloading'> Loading </p> ");

                thechosenid = dp.gettheurlparameter(5, window.location.href);

                // let storednav = dp.getCookie("dashboardnavigation");
                // alert(dp.getCookie("profilenavigation"));
                 dp.thenavigation( dp.getCookie("profilenavigation") , 'personnel' , 0 ,"inside-nav-ul",0, function(){
                    db.transformcalendar();
                 });
                // dp.thenavigation("profile", "personnel", 0 , "inside-nav-ul", 0);
               
            } else {
                // alert(dp.getCookie("dashboardnavigation"))
                // dp.thenavigation( dp.getCookie("dashboardnavigation") , 'dashboard' , 0 ,"inside-nav-ul",0);
            }

            // dp.setCookie("dashboardnavigation", thenav, 365);

            person.loademployeeshere( "all" );
        });



        $(document).on("change","#officechange", function(){
            person.loademployeeshere( $(this).val() );
        });

        $(document).on("click","#saveaccount", function(){
            var details          = new Object();
                details.name     = $(document).find("#firstname").val()+" "+$(document).find("#middlename").val()+" "+$(document).find("#lastname").val();
                details.email    = $(document).find("#emailaddr").val();
                details.password = $(document).find("#password").val();

            var theuserid        = $(document).find("#theuserid").val();

            var conf_pwd         = $(document).find("#confirm_password").val();
                
                if (details.password.length == 0 || conf_pwd.length == 0) {
                    alert("Please enter password");
                    return;
                }

                if (details.password != conf_pwd) {
                    alert("passwords are not equal");
                    return;
                }

                if (!dp.checkpasswordstrength(details.password)) {
                    alert("PASSWORD IS TOO WEAK.\n\nIt must be a combination of Uppercase and lowercase letters, special characters, numbers and must be 8 characters long.");
                    return;
                }

            //dp.checkexisting(users, "userid", theuserid , function(data){

                //if (data == false || data == "false") {
                    dp.savethis("users", details, "password", function(userid) {
                        let dets            = new Object();
                            dets.userid     = userid;
                            dets.thenav     = $(document).find("#therole").val();

                        // ** save as new entry
                            dp.savethis("usersettings", dets, null , function(data){
                                alert("User is saved");
                            });
                        // *

                        // ** update the existing value :: user_id field
                            dp.savefunction("perid", "personnels", thechosenid, "user_id", userid, function(data){
                                alert("Personnel updated");
                            }, null);
                        // end 
                    });
                //}
            // });
        });
    }

    loademployeeshere(officeid) {
        $.ajax({
            url       : url+"/loademployees",
            type      : "get",
            data      : { officeid : officeid },
            dataType  : "html",
            success   : function(data) {
                $(document).find("#loadempshere").html(data);
            }, error  : function() {
                alert("Error in getting the employees");
            }
        });
    }
    
}

let person = new personnel();
    person.eventlisteners();

