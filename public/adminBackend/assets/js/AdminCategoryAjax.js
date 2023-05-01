$(document).ready(function(){

    // Add Category
    $(document).on("click","#add_category",function(){
        var CategoryName = $("#category_name").val();
        var CategoryStatus = $("#category_status").val();
        var CategoryImage = $("#category_image")[0].files[0];
        var CategoryImageLogo = $("#category_image_logo")[0].files[0];

        var formData = new FormData();
        formData.append("CatName",CategoryName);
        formData.append("CatStatus",CategoryStatus);
        formData.append("CatImage",CategoryImage);
        formData.append("CatLogoImage",CategoryImageLogo);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"/add_category/",
            type:"POST",
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                $(".modal").modal('hide');
                swal("Category Added", "Category Added Successfully", "success");
                show();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });


        
    });

    show();
    // Show Category
    function show(){
        $.ajax({
          url: "/show_category/",
          type: "GET",
          success: function(response) {
            if (response.status == 200) {
              var Data = "";
              var id = 1;
              $.each(response.AllData, function(key, val) {
                Data += '<tr>\
                  <td>' + (id++) + '</td>\
                  <td>' + val.category_name + '</td>\
                  <td><img src="http://127.0.0.1:8000/' + val.category_image + '" class="" width="60px" alt=""></td>\
                  <td><img src="http://127.0.0.1:8000/' + val.category_image_logo + '" class="" width="60px" alt=""></td>\
                  <td>' + (val.status == 'active' ? '<button value=\'' + val.id + '\' id="Active" class="btn btn-success">Active</button>' : '<button value=\'' + val.id + '\' id="Inactive" class="btn btn-warning">Inactive</button>') + '</td>\
                  <td>\
                    <button value=\'' + val.id + '\' id="Edit" class="btn btn-info">Edit</button>\
                    <button value=\'' + val.id + '\' id="Delete" class="btn btn-danger">Delete</button>\
                  </td>\
                </tr>';
              });
              $(".tbodyData").html(Data);
            }
          }
        });
      }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Inactive Category
    $(document).on("click","#Active",function(){
        var id = $(this).val();
        $.ajax({
            url: "/active_category/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("Category Inactive", "Category Inactive Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
    // Active Category
    $(document).on("click","#Inactive",function(){
        var id = $(this).val();
        $.ajax({
            url: "/inactive_category/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("Category Active", "Category Active Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Delete Category 
    $(document).on("click","#Delete",function(){
        var id = $(this).val();
        $("#delete_data").val(id);
        $("#OpenDelete").modal("show");
    });
    $(document).on("click","#delete_data",function(){
        var id = $(this).val();
        $.ajax({
            url:"/delete_category/"+id,
            type:"GET",
            success: function(response){
                $("#OpenDelete").modal("hide");
                show();
                swal("Category Deleted", "Category Deleted Successfully", "success");

            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    })
/*
edit_category_name
edit_category_image
edit_showImageCat
edit_category_image_logo
edit_showImageCatLogo
edit_category_status
*/
    // Edit Category & Update
    $(document).on("click","#Edit",function(){
        var id = $(this).val();
        $("#update_category").val(id);
        $("#updateModal").modal("show");
        $.ajax({
            url:"/edit_category/"+id,
            type:"GET",
            success:function(response){
                $("#edit_category_name").val(response.success.category_name);
                // $("#edit_category_image").attr('src','http://127.0.0.1:8000/'+response.success.category_image);
                // $("#edit_category_image_logo").attr('src','http://127.0.0.1:8000/'+response.success.category_image_logo);
                $("#edit_showImageCat").attr('src','http://127.0.0.1:8000/'+response.success.category_image);
                $("#edit_showImageCatLogo").attr('src','http://127.0.0.1:8000/'+response.success.category_image_logo);
                $("#edit_category_status").val(response.success.status);
            }
        });
    });
    $(document).on("click","#update_category",function(){
        var id = $(this).val();
        var CategoryName = $("#edit_category_name").val();
        var CategoryStatus = $("#edit_category_status").val();
        var CategoryImage = $("#edit_category_image")[0].files[0];
        var CategoryImageLogo = $("#edit_category_image_logo")[0].files[0];

        var formData = new FormData();
        formData.append("CatName",CategoryName);
        formData.append("CatStatus",CategoryStatus);
        formData.append("CatImage",CategoryImage);
        formData.append("CatLogoImage",CategoryImageLogo);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
           url:"/update_category/"+id,
           type:"POST",
           data:formData,
           processData: false,
           contentType: false,
           success: function(response){
            $("#updateModal").modal("hide");
            show();
            swal("Category Updated", "Category Updated Successfully", "success");

           },
           error: function(xhr, status, error) {
            console.log(xhr.responseText);
            }

        });
    });
      
});