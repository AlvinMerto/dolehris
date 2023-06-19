class doleprocs {
    ajaxsetup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    saveonblur() {
        $(document).on("blur",".thetextinput", function(){
            $(document).find(".saved-input").remove();
            
            let dis   = $(this).parent();

            let key   = $(this).data("key");
            let table = $(this).data("tbl");
            let index = $(this).data("index");
            
            let fld   = $(this).data("fld");
            let val   = $(this).val();
            
            if (index == null || index.length == 0) {
                return;
            }

            let isrefresh = $(this).data("refresh");
            let ishash    = $(this).data("hash");

            if (undefined === ishash) {
                ishash = null;
            }

            let con   = $(this).data("confirm");

            if (con == "yes") {
                var conf = confirm("Are you sure you want to update?");

                if (ishash != null) {
                    if (!dp.checkpasswordstrength(val)) {
                        alert("PASSWORD IS TOO WEAK.\n\nIt must be a combination of Uppercase and lowercase letters, special characters, numbers and must be 8 characters long.");
                        return;
                    }
                }

                if (!conf) {
                    return;
                }
            }

            $("<small class='saved-input' style='background: #8e8b8b;'> <i class='fa fa-circle-o-notch fa-spin fa-3x fa-fw' aria-hidden='true' style='font-size: 13px;'></i> </small>").appendTo(dis);

            dp.savefunction(key, table, index, fld, val, function(){
                $(document).find(".saved-input").remove();
                $("<small class='saved-input'> <i class='fa fa-check' aria-hidden='true'></i> </small>").appendTo(dis);

                if (isrefresh == "yes") {
                    window.location.reload();
                }
            }, ishash);
        });

        $(document).on("click",".savesignatory",function(){
            let key   = "areaofficepk";
            let table = "area_offices";
            let index = $(document).find("#theoffice").val();

            let fld   = "thesignatory";
            let val   = $(document).find("#thesignatory_select").val();

            dp.savefunction(key, table, index, fld, val, function(data){
                alert("success");
            });
        });
    }

    savefunction(key, table, index, fld, val, somefunction = false , ishash = false ) {
            $.ajax({
                url      : url+"/saveperinput",
                type     : "GET",
                data     : { key    : key,
                             tbl    : table, 
                             id     : index,
                             fld    : fld,
                             value  : val,
                             ishash : ishash },
                dataType : "json",
                success  : function(data){
                    if (somefunction != false) {
                        somefunction(data);
                    }
                }, error : function(a,b,c){
                    alert("A server error encountered upon saving the data to input");
                }
            });
    }

    bodystyle() {
        $(document).ready(function(){
            // $("body").addClass("collapsed-menu");
        });

        // // Define the string
        // var string = 'Hello World!';

        // // Encode the String
        // var encodedString = btoa(string);
        // console.log(encodedString); // Outputs: "SGVsbG8gV29ybGQh"

        // // Decode the String
        // var decodedString = atob(encodedString);
        // console.log(decodedString); // Outputs: "Hello World!"   
    }

    savethis(table, details, hash = false, somefunction = false) {

        $.ajax({
            url      : url+"/savethis",
            type     : "post",
            data     : { table : table, thedata : details , hash : hash },
            dataType : "json",
            success  : function(data){
                if (somefunction == false) {
                    alert("saved")
                } else {
                    somefunction(data);
                }
            },error  : function() {
                alert("error")
            }
        })
    }

    checkexisting(table, primaryfield, primarykey, somefunction) {
        $.ajax({
            url        : url+"/checkexisting",
            type       : "get",
            data       : { table : table , primaryfield : primaryfield, primarykey : primarykey },
            dataType   : "json",
            success    : function(data) {
                somefunction(data);
            }, error   : function() {
                alert("Error Checking the data from "+table);
            }
        });
    }

    gettheurlparameter(index, theurl) {
        // var thelink     = window.location.href;
        // http://192.168.114.139:8000/personnel/administration/940
        var thechosenid = theurl.split("/")[index];

        return thechosenid;
    }

    checkpasswordstrength(password) {
        let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
        
        if (strongPassword.test(password)) {
            return true;
        }

        return false;
    }

    getCookie(cname) {
      let name          = cname + "=";
      let decodedCookie = decodeURIComponent(document.cookie);

      let ca            = decodedCookie.split(';');
      
      for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }

        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }

      return "";
    }

    setCookie(cname, cvalue, exdays) {
      const d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
      
      let expires = "expires="+ d.toUTCString();
      
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    thenavigation(thenav, tab = "personnel", dis = false, ullist = false , theinput = false, somefunction = false) {
        // http://localhost:8000/personnel/administration/2

        var listItems = $("#"+ullist+" li");

        listItems.removeClass("selected-nav");
        
        for (let li of listItems) {
            let product = $(li);
           
            if (product.data('nav') == thenav) {
                product.addClass("selected-nav");
            }
        }

        $.ajax({
            url      : url+"/"+tab+"/"+thenav,
            type     : "GET",
            data     : { thechosenid : thechosenid },
            dataType : "html",
            success  : function(data){
                if (theinput == false) {
                     $(document).find("#theprofileinput").html(data);
                } else {
                     $(document).find("#"+theinput).html(data);
                }

                if (somefunction != false) {
                    somefunction(data);
                }
            }, error : function(){
                alert('error displaying data')
            }
        });
    }

    savetoinclusivedates(keyid, thedates, somefunction = false) {
        $.ajax({
            url      : url+"/savemultiple",
            type     : "get",
            data     : { leaveapplicationid : keyid , thedates : thedates },
            dataType : "json",
            success  : function(data){
                if (somefunction != false) {
                    somefunction(data);
                }
            }, error : function(){
                alert("Error saving multiple entries to database");
            }
        });
    }

    savetoleavecard(leavetype, particularid, somefunction = false) {
        $.ajax({
            url      : url+"/savetoleavecard",
            type     : "post",
            data     : { leavetype : leavetype , particularid : particularid },
            dataType : "json",
            success  : function(data) {
                if (somefunction != false) {
                    somefunction(data);
                }
            }, error : function() {
                alert("There was an error ")
            }
        });
    }
}

let dp = new doleprocs();
    dp.ajaxsetup();
    dp.saveonblur();
    dp.bodystyle();

        window.onload = function(){
            $(document).on("click",".tabnav", function(){
                let dis       = $(this);

                let theparent = $(this).data("parent");
                let thenav    = $(this).data("nav");

                // // selected-nav
                $(this).siblings().removeClass("selected-nav");
                $(this).addClass("selected-nav");

                // let storednav = dp.getCookie("dashboardnavigation");
                // alert(storednav);

                if (theparent == "dashboard") {
                    dp.setCookie("dashboardnavigation", thenav, 365);
                    dp.thenavigation( thenav , theparent, 0, "inside-nav-ul",0, function(){
                        db.transformcalendar();
                    });    
                } else if (theparent == "personnel") {
                     dp.setCookie("profilenavigation", thenav, 365);
                    // dp.setCookie("profilenavigation", "profile", 365);
                    // alert(dp.getCookie("profilenavigation"))
                    dp.thenavigation( thenav , theparent, 0, "inside-nav-ul",0);
                }
            
            });
        }