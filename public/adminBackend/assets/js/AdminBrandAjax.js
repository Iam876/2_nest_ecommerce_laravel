$(document).ready(function(){
    
    
    $(document).on('click','#add_brand',function(){
        var BrandName = $("#brand_name").val();
        var BrandImage = $("#brand_image")[0].files[0]; // get the file object from the input
        
        var formData = new FormData();
        formData.append('Bname', BrandName);
        formData.append('Bimage', BrandImage);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/add_brand_store",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                $("#brand_name").val("");
                $("#brand_image").val(""); // clear the file input
                $(".modal").modal('hide');
                show();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
    
    function show(){
        $.ajax({
            url:"/show_brand",
            type:"GET",
            success: function(response){
                if(response.status == 200){
                    var Data = "";
                    var id = 1;
                    jQuery.each(response.AllData,function(key,val){
                        
                        Data+='<tr>\
                        <td>'+ (id++) +'</td>\
                        <td>'+val.brand_name+'</td>\
                        <td><img src="http://127.0.0.1:8000/'+val.brand_image+'" class="" width="60px" alt=""></td>\
                        <td>'+(val.status=='active'?'<button value=\''+val.id+'\' id="Active" class="btn btn-success">Active</button>':'<button value=\''+val.id+'\' id="Inactive" class="btn btn-warning">Inactive</button>')+'</td>\
                        <td>\
                        <button value=\''+val.id+'\' id="Edit" class="btn btn-info">Edit</button>\
                        <button value=\''+val.id+'\' id="Delete" class="btn btn-danger">Delete</button>\
                    </tr>';
                    });
                    jQuery(".tbody").html(Data);
                }
            }
        });
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click", "#Active", function () {
            var active = $(this).val();
        $.ajax({
            url:"/active_brand/" + active,
            type: "POST",
            success: function (response) { 
                    show();
                    swal("Success!", "Brand Successfully Inactive", "success");
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
        });

    $(document).on("click", "#Inactive", function () {
            var inactive = $(this).val();
            
        $.ajax({
            url:"/inactive_brand/" + inactive,
            type: "POST",
            success: function (response) {
            show();
            swal("Success!", "Brand Successfully Active", "success");
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
        });

    // delete 

    $(document).on("click", "#Delete", function () {
        var deleteBtn = $(this).val();
        $("#delete_data").val(deleteBtn);
        $("#OpenDelete").modal("show");
    });
    $(document).on("click",'#delete_data',function(){
        var id = $(this).val();
        $.ajax({
            url:"/brand_delete/"+id,
            type:"GET",
            success:function(response){
                show();
                $("#OpenDelete").modal('hide');
                swal("Success!", "Brand Successfully Deleted", "success");
            }
        });

    });

    // update
    $(document).on("click","#Edit",function(){
        var id = $(this).val();
        $("#update_brand").val(id);
        $("#updateModal").modal("show");
        $.ajax({
            url:"/edit_brand/"+id,
            type:"GET",
            success:function(response){
                $("#edit_brand_name").val(response.success.brand_name);
                // $("#edit_brand_status option[value='" + response.success.brand_status + "']").attr("selected", "selected");
                $("#edit_brand_status").val(response.success.status);
                $("#showImageV").attr("src", 'http://127.0.0.1:8000/' + response.success.brand_image);
            }
        });

    });

    
    $(document).on("click","#update_brand",function(){
        var id = $(this).val();
        var BrandName = $("#edit_brand_name").val();
        var BrandImage = $("#edit_brand_image")[0].files[0];
        var BrandStatus = $("#edit_brand_status").val();
        // var Brandoldimage = $("#showImageV").val();
        var Brandoldimage = $("#showImageV").attr("src");

        var formData = new FormData();
        formData.append('Bname', BrandName);
        formData.append('Bimage', BrandImage);
        formData.append('Bstatus', BrandStatus);
        formData.append('Boldimage', Brandoldimage);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"/update_brand/"+id,
            type:"POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                $("#updateModal").modal('hide');
                swal("Brand Updated!", "Brand Successfully Updated", "success");
                show();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
            
        });
    });
});

