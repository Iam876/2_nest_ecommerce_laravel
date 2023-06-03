$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click","#StateClicked",function(){
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

    $(document).on("change", "#division_name", function() {
        var divisionId = $(this).val();
        
        $.ajax({
          url: "/get_district_data/",
          type: "GET",
          dataType: "JSON",
          data: {
            divisionId: divisionId
          },
          success: function(response) {
            var data = '';
            $.each(response.district, function(key, val) {
                if(divisionId==val.division_id){
              data += `<option value="${val.id}">${val.district_name}</option>`;
                }
            });
            $("#district_name").html(data);
          }
        });
      });


    $(document).on("click","#add_state",function(){
        var StateName = $("#state_name").val();
        var DistrictName = $("#district_name").val();
        var DivisionName = $("#division_name").val();
        var StateStatus = $("#state_status").val();
        $.ajax({
            url:"/state_add/",
            type:"POST",
            data:{name:StateName,districtName:DistrictName,divisionName:DivisionName,status:StateStatus},
            dataType:"JSON",
            success:function(response){
                show();
                $(".modal").modal('hide');
                swal("State Added", "State Added Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    })
    show();
    function show(){
        $.ajax({
            url:"/show_state/",
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
                    <td>${val.district.district_name}</td>
                    <td>${val.state_name}</td>
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


    // Inactive State
    $(document).on("click","#Active",function(){
        var id = $(this).val();
        $.ajax({
            url: "/inactive_state/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("State Inactive", "State Inactive Successfully", "success");
            }
        });
    });
    // Active State
    $(document).on("click","#Inactive",function(){
        var id = $(this).val();
        $.ajax({
            url: "/active_state/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("State Active", "State Active Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Delete State 
    $(document).on("click","#Delete",function(){
        var id = $(this).val();
        $("#delete_data").val(id);
        $("#OpenDelete").modal("show");
    });
    $(document).on("click","#delete_data",function(){
        var id = $(this).val();
        $.ajax({
            url:"/delete_state/"+id,
            type:"GET",
            success: function(response){
                $("#OpenDelete").modal("hide");
                show();
                swal("State Deleted", "State Deleted Successfully", "success");
            }
        })
    })
});