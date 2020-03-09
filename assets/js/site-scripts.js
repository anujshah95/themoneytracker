function common_delete_module(id,tbl_name,page_name)
{
    alertify.confirm('','Would you like to delete this.?',function(){
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                data: { 
                    'id': id,
                    'tbl_name' : tbl_name,
                    'page_name' : page_name
                },
                url: baseURL+'common-delete-module',
                success: function(response) {
                    var obj = jQuery.parseJSON(response)
                    if(obj['status']=='true'){
                        alertify.alert(obj['message']).set('basic', true); 
                        alertify.success(obj['message']);
                        $("#"+page_name+"_"+id).hide(1000);
                   }else{
                        alertify.alert(obj['message']).set('basic', true); 
                        alertify.error(obj['message']);
                   }
               }
            });
        });
    },function(){
        alertify.error('Cancel')
    });
}


$('#to-do-list').on('change', function()
{
    // $("body").addClass("loading");
    var to_do_list=$('#to-do-list').val();
    $.ajax({
        type: "POST",
        data: { 
            'value': 'toDoList',
            'to_do_list' : to_do_list
        },
        url: baseURL+'toDoList',
        success: function(response) {
            // setTimeout(function(){
            //     $("body").removeClass("loading");
            // },500);
            var obj = jQuery.parseJSON(response)
            if(obj['status']=='true'){
                $('#to-do-list').html(obj['updated_to_do_list']);
           }else{

           }
       }
    });
});

 $(document).ready(function(){
    //---------------------------------
    $('.progress .progress-bar').css("width",
        function(){
            return $(this).attr("aria-valuenow") + "%";
        }
    )
    //---------------------------------
    $("#datepicker").datepicker({ 
        dateFormat: 'dd-M-y',
    });
    var dSelectedDate=$('#datepicker').val();
    if(dSelectedDate){
        $("#datepicker").datepicker('setDate', new Date(dSelectedDate));
    }

    //---------------------------------
    $("#img_preview_div").hide();
    //---------------------------------
    document.getElementById('calc').onload=init_calc('calc');
    //---------------------------------
    $('.infoTooptip').tooltip(); 
    //---------------------------------
    var showChar = 30;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
    //---------------------------------
    var columnIndex=$('.datatable').attr('data-id');
    $('.datatable').DataTable({
        aaSorting : [[columnIndex, 'desc']],       
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +"<'row'<'col-sm-12'CB>>"+"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
        colVis: {
            buttonText: "<i class='icon-three-bars'></i> <span class='caret'></span>",
            align: "right",
            overlayFade: 200,
            exclude: [ 0 ],
            showAll: "Show all",
            showNone: "Hide all"
        },
        
       buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                className: 'btn btn-primary datatable-excel-export-btn'
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                },
                className: 'btn btn-primary'
                /*
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image : ''
                    } );
                }
                */ 
            },
        ] 
    });

    $('.ColVis_Button').addClass('btn btn-primary btn-icon').on('click mouseover', function() {
        $('.ColVis_collection input').uniform();
    });    
});   


$("#feedback_image").change(function (e) {
    var fileUpload = document.getElementById("feedback_image");/*Get reference of FileUpload.*/
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png)$");/*Check whether the file is valid Image.*/
    if (regex.test(fileUpload.value.toLowerCase())) {
        if (typeof (fileUpload.files) != "undefined") {/*Check whether HTML5 is supported.*/
            var reader = new FileReader();/*Initiate the FileReader object.*/
            reader.readAsDataURL(fileUpload.files[0]);/*Read the contents of Image File.*/
            reader.onload = function (e) {
                var image = new Image();/*Initiate the JavaScript Image object.*/
                image.src = e.target.result;/*Set the Base64 string return from FileReader as source.*/
                image.onload = function () {
                	// console.log(this);
                	// console.log(e);
                	var sFeedBackImageName = $('#feedback_image').val().replace(/C:\\fakepath\\/i, '')
                	// if(some_condition){
                    	$('#sImageUploadError').html("");
                    	$('#img_preview_div').show();
                    	$('#img_preview').attr('src', e.target.result).width(150).height(150);;
                        $('#img_preview_remove').show();
                        $('.filename').html(sFeedBackImageName);
                       	return true;
                    // }else{
                        /*
                        $('#img_preview').attr('src', '');
                        $('#img_preview_remove').hide();
                        $('#sImageUploadError').html('<div class="alert alert-danger">The size of the image must be less than 5 MB.</div>');
                        $("#feedback_image").val("");
                        return false;
                        */
                    // }
                };
            }
        }else{
            $('#sImageUploadError').html('<div class="alert alert-danger">This browser does not support HTML5.</div>');
            return false;
        }
    }else{
        $('#sImageUploadError').html('<div class="alert alert-danger">Please select a valid Image file.</div>');
        $('#feedback_image').val("");
        return false;
    }
});

function readLogoURL(input)
{
    $('#img_preview_div').show();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img_preview')
                .attr('src', e.target.result)
                .width(150)
                .height(150);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function remove_img()
{
    $('#img_preview_div').hide();
    $('#feedback_image').val("");
    $('#user_image').val("");
    $('#site_logo').val("");
    $('#img_preview_div').attr('src','');
    $('.filename').html('No file selected');
}


$('.report-details').click(function(){
    var iLoopId     = $(this).attr('loop-id');
    var dMonthYear  = $(this).attr('month-year');
    var parent_tr = $(this).parent().parent();
    $('.expandedContent').remove();
    $.ajax({
        type: "POST",
        data: { 
            'dMonthYear': dMonthYear,
        },
        url: baseURL+'monthly-report-details',
        success: function(response) {
                var obj = jQuery.parseJSON(response);
                if(obj['iStatus']===false){
                    alertify.alert(obj['sMsg']).set('basic', true); 
                    alertify.error(obj['sMsg']);
                }else{
                    var sAjaxView=obj['sMsg'];
                    $("<tr class='monthly-report-details expandedContent'>"+sAjaxView+"</tr>").insertAfter(parent_tr);
               }
        }
    });
});
