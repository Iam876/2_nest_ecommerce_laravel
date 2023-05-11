$(document).ready(function(){
    $(document).on("click","#add_slider",function(){
        var SliderTitle = $("#slider_title").val();
        var SliderShort = $("#slider_short").val();
        var Sliderstatus = $("#slider_status").val();
        var SliderImage = $("#slider_image")[0].files[0];
        
        var formData = new FormData();
        formData.append('sTitle',SliderTitle);
        formData.append('sShort',SliderShort);
        formData.append('sStatus',Sliderstatus);
        formData.append('sImage',SliderImage);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"/add_slider/",
            type:"POST",
            data:formData,
            processData: false,
            contentType: false,
            success: function(response){
                $(".modal").modal('hide');
                show();
                swal("Success!", "Slider Successfully Added", "success");
            },error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
              }
        });
    })
    show();
    function show(){
        $.ajax({
            url:"/show_slider/",
            type:"GET",
            success: function(response){
                if(response.status==200){
                    var Data = "";
                    var id = 1;
                    $.each(response.AllData,function(key,val){
                        Data += '<tr>\
                        <td>'+ (id++) +'</td>\
                        <td>'+val.slider_title+'</td>\
                        <td>'+val.slider_short+'</td>\
                        <td><img src="http://127.0.0.1:8000/'+val.slider_image+'" class="" width="60px" alt=""></td>\
                        <td>'+(val.slider_status=='active'?'<button value=\''+val.id+'\' id="Active" class="btn btn-success">Active</button>':'<button value=\''+val.id+'\' id="Inactive" class="btn btn-warning">Inactive</button>')+'</td>\
                        <td>\
                        <button value=\''+val.id+'\' id="Edit" class="btn btn-info">Edit</button>\
                        <button value=\''+val.id+'\' id="Delete" class="btn btn-danger">Delete</button>\
                    </tr>';
                    });
                    $('.tbodyData').html(Data);
                }
            }
        })
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click", "#Active", function () {
            var active = $(this).val();
        $.ajax({
            url:"/active_slider/" + active,
            type: "GET",
            success: function (response) {
                    show();
                    swal("Success!", "Slider Successfully Inactive", "success");
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
    });

    $(document).on("click", "#Inactive", function () {
            var inactive = $(this).val();
            
        $.ajax({
            url:"/inactive_slider/" + inactive,
            type: "GET",
            success: function (response) {
            show();
            swal("Success!", "Slider Successfully Active", "success");
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
    });

    $(document).on("click","#Delete",function(){
        var id = $(this).val();
        $("#delete_data").val(id);
        $("#OpenDelete").modal("show");
    });

    $(document).on("click","#delete_data",function(){
        var id = $(this).val();
        // $("#delete_data").val(id);
        // $("#OpenDelete").modal("show");
        $.ajax({
            url:"/delete_slider/"+id,
            type:"GET",
            success: function(response){
                show();
                $("#OpenDelete").modal("hide");
                swal("Success!", "Slider Successfully Deleted", "success");
            }
        });
    });
    $(document).on("click","#Edit",function(){
        var id = $(this).val();
        $("#update_slider").val(id);
        $("#updateModal").modal("show");
        $.ajax({
            url:"/edit_slider/"+id,
            type:"GET",
            success: function(response){
                $("#edit_slider_title").val(response.success.slider_title);
                $("#edit_slider_short").val(response.success.slider_short);
                $("#edit_showImageSlider").attr("src", 'http://127.0.0.1:8000/' + response.success.slider_image);
                $("#edit_slider_status").val(response.success.slider_status);
            }
        })
    });
 
    
    $(document).on("click","#update_slider",function(){
        var id = $(this).val();
        var EditSliderTitle = $("#edit_slider_title").val();
        var EditSliderShort = $("#edit_slider_short").val();
        var EditSliderImage = $("#edit_slider_image")[0].files[0];
        var EditSliderStatus = $("#edit_slider_status").val();

        var formData = new FormData();
        formData.append('updateTitle',EditSliderTitle);
        formData.append('updateShort',EditSliderShort);
        formData.append('updateImage',EditSliderImage);
        formData.append('updateStatus',EditSliderStatus);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"/update_slider/"+id,
            type:"POST",
            data:formData,
            processData:false,
            contentType:false,
            success: function(response){
                show();
                $("#updateModal").modal("hide");
                swal("Success!", "Slider Successfully Updated ", "success");
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
        
    });
});