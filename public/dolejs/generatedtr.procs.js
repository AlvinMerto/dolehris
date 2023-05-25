let personnel_ids = [];
let id_move       = 0;
let thedate       = null;
let sign_name     = null;
let sign_post     = null;

var table;

class generateDtr {
    listen() {

        // $(document).on("ready", function(){
        //         table = $('#employee_table').DataTable({
        //             responsive: true,
        //             language: {
        //                 searchPlaceholder: 'Search...',
        //                 sSearch: '',
        //                 lengthMenu: '_MENU_',
        //             }
        //         });
        // })

        $(document).on("click","#showemployees", function(e){
            e.preventDefault();

            let office    = $(document).find("#officedivision").val();
            let emptype   = $(document).find("#employmenttype").val();
            let area      = $(document).find("#arealocation").val();
            // let division  = $(document).find("#divisions").val();

            // alert("office:"+office); alert("emp type"+emptype); alert("area:"+area); 
            // alert("division:"+division);
            if (area == "none") {
                alert("Please select the area");
                return;
            }

            gd.showemployees(office, emptype, area);
        });

        $(document).on("change","#arealocation", function(){
            let theid = $(this).val();
        
            $.ajax({
                url     : url+"/getsignatories",
                type    : "get",
                data    : { areaid : theid },
                dataType: "json",
                success : function(data){
                    $(document).find("#signatoryname").val( data['name'] );
                    $(document).find("#positionbox").val( data['position'] );
                }, error: function(){
                    alert("error retrieving the signatories");
                }
            });
        });

        $(document).on('click',".list-of-emps-check", function(){
            let state = $(this).is(":checked");
    
            if (state == true || state == "true") {
                personnel_ids.push( $(this).val() );
            } else if (state == false || state == "false") {
                let indx  = personnel_ids.indexOf( $(this).val() );
                personnel_ids.splice(indx,1);
            }
        });

        $(document).on("click","#senddtrtoemail", function(e){
            e.preventDefault();

            if (personnel_ids.length == 0) {
                alert("Please select employees to send DTR to.");
                return;
            }

            thedate       = $(document).find("#dtrdate").val();
            sign_name     = $(document).find("#signatoryname").val();
            sign_post     = $(document).find("#positionbox").val();

            gd.senddtr(personnel_ids[id_move]);
        });

        $(document).on("click","#checkallcheckboxes", function(e){
            $(document).find(".list-of-emps-check").trigger("click");

            // console.log(personnel_ids);
        });

    }

    senddtr(bioid) {
        $(document).find("#status_"+personnel_ids[id_move]).html("sending DTR... Please wait");

        if (id_move == personnel_ids.length) {
            alert("All DTRs are sent");
            return;
        }
        
        $.ajax({
            url      : url+"/senddtr",
            type     : "post",
            data     : { biometricid : bioid , thedate : thedate, sign_name : sign_name, sign_post : sign_post },
            dataType : "json",
            success  : function(data){
                var themsg = null;

                if (data == "noemail") {
                    themsg = "<p class='dtrnotsent'> NO EMAIL FOUND </p>";
                } else if (data == "nobioid") {
                    themsg = "<p class='dtrnotsent'> BIOMETRIC ID NOT FOUND </p>";
                } else {    
                    themsg = "<p class='dtrsent'> DTR SENT </p>";
                }

                $(document).find("#status_"+personnel_ids[id_move]).html(themsg);

                id_move++;
                gd.senddtr(personnel_ids[id_move]);

            }, error : function(a,b,c) {
                alert(a+b+c)
            }
        });
    }

    showemployees(office, emptype, area) {
        $.ajax({
            url      : url+"/showemployees",
            type     : "GET",
            data     : { office : office, emptype : emptype, area : area },
            dataType : "html",
            success  : function(data) {
                $(document).find("#therowstr").children().remove();
                $(document).find("#therowstr").html(data);
            }, error : function(a,b,c) {
                alert(a+b+c);
            }
        });
    }

}

var gd = new generateDtr();
    gd.listen();