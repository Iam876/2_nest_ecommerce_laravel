$(document).ready(function(){

    $(document).on("click","#add_division",function(){
        var DivisionName = $("#division_name").val();
        var DivisionStatus = $("#division_status").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"/division_add/",
            type:"POST",
            data:{name:DivisionName,status:DivisionStatus},
            dataType:"JSON",
            success:function(response){
                show();
                $(".modal").modal('hide');
                swal("Division Added", "Division Added Successfully", "success");
            }
        })
    })
    show();
    function show(){
        $.ajax({
            url:"/show_division/",
            type:"GET",
            dataType:"JSON",
            success:function(response){
                var Data = '';
                var id = 1;
                $.each(response.data,function(key,val){
                    var status =val.status == 'active'? `<button value="${val.id}" id="Active" class="btn btn-success">Active</button>`:`<button value="${val.id}" id="Inactive" class="btn btn-warning">Inactive</button>`;

                    Data += `<tr>
                    <td>${id++}</td>
                    <td>${val.division_name}</td>
                    <td>${status}</td>
                    <td>
                        <button value="${val.id}" id="Edit" class="btn btn-info">Edit</button>
                        <button value="${val.id}" id="Delete" class="btn btn-danger">Delete</button>
                    </td>
                    </tr>`;
                });
                $(".tbodyData").html(Data);
                
                  
            }
        })
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Inactive Division
    $(document).on("click","#Active",function(){
        var id = $(this).val();
        $.ajax({
            url: "/inactive_division/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("Division Inactive", "Division Inactive Successfully", "success");
            }
        });
    });
    // Active Division
    $(document).on("click","#Inactive",function(){
        var id = $(this).val();
        $.ajax({
            url: "/active_division/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("Division Active", "Division Active Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Delete Division 
    $(document).on("click","#Delete",function(){
        var id = $(this).val();
        $("#delete_data").val(id);
        $("#OpenDelete").modal("show");
    });
    $(document).on("click","#delete_data",function(){
        var id = $(this).val();
        $.ajax({
            url:"/delete_division/"+id,
            type:"GET",
            success: function(response){
                $("#OpenDelete").modal("hide");
                show();
                swal("Division Deleted", "Division Deleted Successfully", "success");
            }
        })
    })

    // Edit Category & Update
    $(document).on("click","#Edit",function(){
        var id = $(this).val();
        $("#update_division").val(id);
        $("#updateModal").modal("show");
        $.ajax({
            url:"/edit_division/"+id,
            type:"GET",
            success:function(response){
                $("#edit_division_name").val(response.data.division_name);
                $("#edit_division_status").val(response.data.status);
            }
        });
    });
    $(document).on("click","#update_division",function(){
        var id = $(this).val();
        var DivisionName = $("#edit_division_name").val();
        var DivisionStatus = $("#edit_division_status").val();
        $.ajax({
           url:"/update_division/"+id,
           type:"POST",
           data:{
            name:DivisionName,status:DivisionStatus,
           },
           dataType:"JSON",
           success: function(response){
            $("#updateModal").modal("hide");
            show();
            swal("Division Updated", "Division Updated Successfully", "success");
           }
        });
    });

});