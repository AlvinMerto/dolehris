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

            $("<small class='saved-input' style='background: #8e8b8b;'> saving... </small>").appendTo(dis);

            dp.savefunction(key, table, index, fld, val, function(){
                $(document).find(".saved-input").remove();
                $("<small class='saved-input'> Saved </small>").appendTo(dis);

                if (isrefresh == "yes") {
                    window.location.reload();
                }
            })
        });

        $(document).on("click",".savesignatory",function(){
            let key   = "areaofficepk";
            let table = "area_offices";
            let index = $(document).find("#theoffice").val();

            let fld   = "thesignatory";
            let val   = $(document).find("#thesignatory_select").val();

            dp.savefunction(key, table, index, fld, val, function(data){
                alert("success");
            })
        });
    }

    savefunction(key, table, index, fld, val, somefunction = false ) {
            $.ajax({
                url      : url+"/saveperinput",
                type     : "GET",
                data     : { key   : key,
                             tbl   : table, 
                             id    : index,
                             fld   : fld,
                             value : val },
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

    gettheurlparameter(index, theurl) {
        // var thelink     = window.location.href;
        var thechosenid = theurl.split("/")[index];

        return thechosenid;
    }
}

let dp = new doleprocs();   
    dp.ajaxsetup();
    dp.saveonblur();
    dp.bodystyle();