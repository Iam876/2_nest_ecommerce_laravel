$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click","#DistrictClicked",function(){
        $.ajax({
            url:"/get_division_data/",
            type:"GET",
            dataType:"JSON",
            success:function(response){
                var data = '';
                $.each(response.division,function(key,val){
                    data+=`<option value="${val.id}">${val.division_name}</option>`;
                });
                $("#division_name").html(data);
            }
        })
    });


    $(document).on("click","#add_district",function(){
        var DistrictName = $("#district_name").val();
        var DivisionName = $("#division_name").val();
        var DistrictStatus = $("#district_status").val();
        $.ajax({
            url:"/district_add/",
            type:"POST",
            data:{name:DistrictName,divisionName:DivisionName,status:DistrictStatus},
            dataType:"JSON",
            success:function(response){
                show();
                $(".modal").modal('hide');
                swal("District Added", "District Added Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    })
    show();
    function show(){
        $.ajax({
            url:"/show_district/",
            type:"GET",
            dataType:"JSON",
            success:function(response){
                var Data = '';
                var id = 1;
                $.each(response.data,function(key,val){
                    var status = val.status == 'active'? `<button value="${val.id}" id="Active" class="btn btn-success">Active</button>`:`<button value="${val.id}" id="Inactive" class="btn btn-warning">Inactive</button>`;

                    Data += `<tr>
                    <td>${id++}</td>
                    <td>${val.division.division_name}</td>
                    <td>${val.district_name}</td>
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


    // // Inactive District
    $(document).on("click","#Active",function(){
        var id = $(this).val();
        $.ajax({
            url: "/inactive_district/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("District Inactive", "District Inactive Successfully", "success");
            }
        });
    });
    // // Active District
    $(document).on("click","#Inactive",function(){
        var id = $(this).val();
        $.ajax({
            url: "/active_district/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("District Active", "District Active Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // // Delete District 
    $(document).on("click","#Delete",function(){
        var id = $(this).val();
        $("#delete_data").val(id);
        $("#OpenDelete").modal("show");
    });
    $(document).on("click","#delete_data",function(){
        var id = $(this).val();
        $.ajax({
            url:"/delete_district/"+id,
            type:"GET",
            success: function(response){
                $("#OpenDelete").modal("hide");
                show();
                swal("District Deleted", "District Deleted Successfully", "success");
            }
        })
    })

    // // Edit Category & Update
    // $(document).on("click","#Edit",function(){
    //     var id = $(this).val();
    //     $("#update_division").val(id);
    //     $("#updateModal").modal("show");
    //     $.ajax({
    //         url:"/edit_division/"+id,
    //         type:"GET",
    //         success:function(response){
    //             $("#edit_division_name").val(response.data.division_name);
    //             $("#edit_division_status").val(response.data.status);
    //         }
    //     });
    // });
    // $(document).on("click","#update_division",function(){
    //     var id = $(this).val();
    //     var DivisionName = $("#edit_division_name").val();
    //     var DivisionStatus = $("#edit_division_status").val();
    //     $.ajax({
    //        url:"/update_division/"+id,
    //        type:"POST",
    //        data:{
    //         name:DivisionName,status:DivisionStatus,
    //        },
    //        dataType:"JSON",
    //        success: function(response){
    //         $("#updateModal").modal("hide");
    //         show();
    //         swal("Division Updated", "Division Updated Successfully", "success");
    //        }
    //     });
    // });

});