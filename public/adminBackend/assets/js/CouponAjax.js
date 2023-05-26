$(document).ready(function(){

    // Add Category
    $(document).on("click","#add_coupon",function(){
        var CouponName = $("#coupon_name").val();
        var CouponStatus = $("#coupon_status").val();
        var CouponValidity = $("#coupon_validity").val();
        var CouponDiscount = $("#coupon_discount").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"/add_coupon/",
            type:"POST",
            data:{
                name:CouponName,status:CouponStatus,validity:CouponValidity,discount:CouponDiscount,
            },
            dataType:"JSON",
            success:function(response){
                $(".modal").modal('hide');
                swal("Coupon Added", "Coupon Added Successfully", "success");
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
          url: "/show_coupon/",
          type: "GET",
          success: function(response) {
            if (response.status == 200) {
              var Data = "";
              var id = 1;
              $.each(response.AllData, function(key, val) {
                let validityString = val.coupon_validity; // Assuming validity is in the format "2023:05:15 11:04:50"
                let validityDate = new Date(validityString);

                var now = new Date();
                var formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

                let validityDuration = Math.floor((validityDate - now) / 60000); // Calculate duration in minutes

                let validityFormatted;

                if (validityDuration < 0) {
                validityFormatted = "Expired";
                }
                else if (validityDuration >= 525600) { // More than 12 months (525600 minutes in a year)
                let years = Math.floor(validityDuration / 525600);
                validityFormatted = years > 1 ? years + " years" : years + " year";
                }
                else if (validityDuration >= 43200) { // More than 30 days (assuming 30 days in a month)
                let months = Math.floor(validityDuration / 43200);
                validityFormatted = months > 1 ? months + " months" : months + " month";
                }
                else if (validityDuration >= 1440) { // More than 1 day (1440 minutes in a day)
                let days = Math.floor(validityDuration / 1440);
                validityFormatted = days > 1 ? days + " days" : days + " day";
                }
                else if (validityDuration >= 60 && validityDuration < 1440) { // More than 1 hour (60 minutes in an hour)
                let hours = Math.floor(validityDuration / 60);
                let minutes = validityDuration % 60;

                if (hours > 0 && minutes > 0) {
                    validityFormatted = hours + " hour " + minutes + " minutes";
                } else if (hours > 0) {
                    validityFormatted = hours > 1 ? hours + " hours" : hours + " hour";
                } else {
                    validityFormatted = minutes > 1 ? minutes + " minutes" : minutes + " minute";
                }
                }
                else {
                validityFormatted = validityDuration > 1 ? validityDuration + " minutes" : validityDuration + " minute";
                }
                
                var status =val.coupon_status == 'active'? `<button value="${val.id}" id="Active" class="btn btn-success">Active</button>`:`<button value="${val.id}" id="Inactive" class="btn btn-warning">Inactive</button>`;

                Data += `<tr>
                <td>${id++}</td>
                <td>${val.coupon_name}</td>
                <td>${val.coupon_discount}%</td>
                <td>${validityFormatted}</td>
                <td>${status}</td>
                <td>
                    <button value="${val.id}" id="Edit" class="btn btn-info">Edit</button>
                    <button value="${val.id}" id="Delete" class="btn btn-danger">Delete</button>
                </td>
                </tr>`;
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

    // Inactive Coupon
    $(document).on("click","#Active",function(){
        var id = $(this).val();
        $.ajax({
            url: "/inactive_coupon/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("Coupon Inactive", "Coupon Inactive Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
    // Active Coupon
    $(document).on("click","#Inactive",function(){
        var id = $(this).val();
        $.ajax({
            url: "/active_coupon/"+id,
            type: "POST",
            success: function(response){
                show();
                swal("Coupon Active", "Coupon Active Successfully", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Delete Coupon 
    $(document).on("click","#Delete",function(){
        var id = $(this).val();
        $("#delete_data").val(id);
        $("#OpenDelete").modal("show");
    });
    $(document).on("click","#delete_data",function(){
        var id = $(this).val();
        $.ajax({
            url:"/delete_coupon/"+id,
            type:"GET",
            success: function(response){
                $("#OpenDelete").modal("hide");
                show();
                swal("Coupon Deleted", "Coupon Deleted Successfully", "success");

            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    })

    // Edit Category & Update
    $(document).on("click","#Edit",function(){
        var id = $(this).val();
        $("#update_coupon").val(id);
        $("#updateModal").modal("show");
        $.ajax({
            url:"/edit_coupon/"+id,
            type:"GET",
            success:function(response){

                $("#edit_coupon_name").val(response.success.coupon_name);
                $("#edit_coupon_discount").val(response.success.coupon_discount);
                $("#edit_coupon_validity").val(response.success.coupon_validity);
                $("#edit_coupon_status").val(response.success.coupon_status);
            }
        });
    });
    $(document).on("click","#update_coupon",function(){
        var id = $(this).val();
        var CouponName = $("#edit_coupon_name").val();
        var CouponDiscount = $("#edit_coupon_discount").val();
        var CouponValidity = $("#edit_coupon_validity").val();
        var CouponStatus = $("#edit_coupon_status").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           url:"/update_coupon/"+id,
           type:"POST",
           data:{
            name:CouponName,discount:CouponDiscount,validity:CouponValidity,status:CouponStatus,
           },
           dataType:"JSON",
           success: function(response){
            $("#updateModal").modal("hide");
            show();
            swal("Coupon Updated", "Coupon Updated Successfully", "success");

           },
           error: function(xhr, status, error) {
            console.log(xhr.responseText);
            }

        });
    });
      
});