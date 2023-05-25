let thechosenid = null;

class personnel {

    eventlisteners() {
        $(document).ready(function(){
            var profiledisplay = document.getElementById("displaytabs");

            //thechosenid = gettheurlparameter(5, window.location.href);

            if ( profiledisplay ) {
                $(document).find("#theprofileinput").html("loading");

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

            var conf_pwd         = $(document).find("#confirm_password").val();
                
                if (details.password != conf_pwd) {
                    alert("passwords are not equal");
                    return;
                }

            dp.savethis("users", details, "password");
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
        })
    }
    
}

let person = new personnel();
    person.eventlisteners();
