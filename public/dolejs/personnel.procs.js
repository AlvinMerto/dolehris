let thechosenid = null;

class personnel {

    eventlisteners() {
        $(document).ready(function(){
            var profiledisplay = document.getElementById("displaytabs");

            //thechosenid = gettheurlparameter(5, window.location.href);

            if ( profiledisplay ) {
                $(document).find("#theprofileinput").html("<p class='theloading'> Loading </p> ");

                thechosenid = dp.gettheurlparameter(5, window.location.href);
                person.thenavigation("profile");
               
            }

        });

        $(document).on("click",".tabnav", function(){
            person.thenavigation( $(this).data("nav") );
        });

        $(document).on("click","#saveaccount", function(){
            var details          = new Object();
                details.name     = $(document).find("#firstname").val()+" "+$(document).find("#middlename").val()+" "+$(document).find("#lastname").val();
                details.email    = $(document).find("#emailaddr").val();
                details.password = $(document).find("#password").val();

            var theuserid        = $(document).find("#theuserid").val();

            var conf_pwd         = $(document).find("#confirm_password").val();
                
                if (details.password != conf_pwd) {
                    alert("passwords are not equal");
                    return;
                }

            //dp.checkexisting(users, "userid", theuserid , function(data){

                //if (data == false || data == "false") {
                    dp.savethis("users", details, "password", function(userid) {
                        let dets            = new Object();
                            dets.userid     = userid;
                            dets.thenav     = $(document).find("#therole").val();

                        dp.savethis("usersettings", dets, null , function(data){
                            alert("User is saved");
                        });

                        // update the user_id field
                            dp.savefunction("perid", "personnels", thechosenid, "user_id", userid, function(data){
                                alert("Personnel updated");
                            }, null);
                        // end 
                    });
                //}
            // });
        });
    }

    thenavigation(thenav) {
        // http://localhost:8000/personnel/administration/2

        $.ajax({
            url      : url+"/personnel/"+thenav,
            type     : "GET",
            data     : { thechosenid : thechosenid },
            dataType : "html",
            success  : function(data){
                $(document).find("#theprofileinput").html(data);
            }, error : function(){
                alert('error displaying data')
            }
        });
    }
    
}

let person = new personnel();
    person.eventlisteners();
