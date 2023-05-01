$(document).ready(function () {

    // Category Data Fetch
    $(document).on("click","#Subcategory_btn",function(){
        // var cat_id = $("#category_id").val();
        $.ajax({
            url:"/get/category/",
            type:"GET",
            success: function(response){
                    var Data = '<option selected="">Select Category</option>';
                    $.each(response.success, function(key, val) {
                        Data += '<option value="'+val.id+'">'+val.category_name+'</option>';
                    });
                    $(".category_select").html(Data);
            }
        });
    });

    // Add Data Subcategory
    $(document).on("click","#add_subcategory",function(){
        /*
        category_id
        subcategory_name
        subcategory_status
        */
       var cat_id = $("#category_id").val();
       var subcat_name = $("#subcategory_name").val();
       var subcat_status = $("#subcategory_status").val();

       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
       });

       $.ajax({
        url:"/add_subcategory/",
        type:"POST",
        data:{
            cid:cat_id,
            subName:subcat_name,
            substatus:subcat_status
        },
        success: function(response){
            show();
            $(".modal").modal('hide');
            swal("Subcategory Added!", "Subcategory Added Successfully", "success");
        }
       });
    });

    show();
    function show(){
        $.ajax({
            url:"/show_subcategory/",
            type:"GET",
            success: function(response){
                if(response.status==200){
                    var Data = "";
                    var id = 1;
                    $.each(response.AllData,function(key,val){
                        Data+='<tr>\
                        <td>'+ (id++) +'</td>\
                        <td>'+val.category.category_name+'</td>\
                        <td>'+val.subcategory_name+'</td>\
                        <td>'+(val.subcategory_status=='active'?'<button value=\''+val.id+'\' id="Active" class="btn btn-success">Active</button>':'<button value=\''+val.id+'\' id="Inactive" class="btn btn-warning">Inactive</button>')+'</td>\
                        <td>\
                        <button value=\''+val.id+'\' id="Delete" class="btn btn-danger">Delete</button>\
                    </tr>';
                    $(".tbodyData").html(Data);
                    });
                    //<button value=\''+val.id+'\' id="Edit" class="btn btn-info">Edit</button>\
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
            url:"/active_subcategory/" + active,
            type: "POST",
            success: function (response) { 
                    show();
                    swal("Success!", "Subcategory Successfully Inactive", "success");
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
    });

    $(document).on("click", "#Inactive", function () {
        var inactive = $(this).val();
        $.ajax({
            url:"/inactive_subcategory/" + inactive,
            type: "POST",
            success: function (response) {
            show();
            swal("Success!", "Subcategory Successfully Active", "success");
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
    });

    $(document).on("click","#Delete",function(){
        var id = $(this).val();
        $("#delete_subcategory").val(id);
        $("#OpenDelete").modal("show");
    });
    $(document).on("click","#delete_subcategory",function(){
        var id = $(this).val();
        $.ajax({
            url:"/delete_subcategory/"+id,
            type:"GET",
            success:function(response){
                swal("Subcategory Deleted!", "Subcategory Deleted Successfully", "success");
                show();
                $("#OpenDelete").modal("hide");
            }
        });
    });


    

});