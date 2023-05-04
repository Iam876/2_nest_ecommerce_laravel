$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    show();
    function show(){
        $.ajax({
            url:"/view/product/",
            type:"GET",
            success: function(response){
                if(response.status == 200){
                    var Data = "";
                    var id = 1;
                    $.each(response.AllProducts,function(key,val){
                        var status_btn = '';
                        var status_output = '';
                        var discount = '';
                        if(val.discount_price == null){
                            discount = '<span class="badge rounded-pill bg-info">No Discount</span>';
                        }else{
                            var amount = val.selling_price - val.discount_price;
                            var PriceDiscount = Math.round((amount/val.selling_price)*100);
                            discount = '<span class="badge rounded-pill bg-info font-13">'+PriceDiscount+'%</span>';
                        }
                        if(val.status == 1){
                            status_output = '<span class="btn btn-success btn-sm rounded">Active</span>';
                            status_btn = '<button class="btn btn-primary btn-sm" id="Active" value="'+val.id+'"><i class="lni lni-thumbs-up"></i></button>';
                        }else{
                            status_output = '<span class="btn btn-warning btn-sm rounded">Inactive</span>';
                            status_btn = '<button class="btn btn-warning btn-sm" id="Inactive" value="'+val.id+'"><i class="lni lni-thumbs-down"></i></button>';
                        }
                        Data+='<tr>\
                        <td>'+ (id++) +'</td>\
                        <td><img src="http://127.0.0.1:8000/'+val.product_thumbnail+'" width="60px" height="60px" class="img-fluid" alt=""></td>\
                        <td>'+val.product_name+'</td>\
                        <td>'+val.selling_price+'</td>\
                        <td>'+val.product_qty+'</td>\
                        <td>'+discount+'</td>\
                        <td>'+status_output+'</td>\
                        <td>\
                        <a href="'+'/edit/product/'+val.id+'}}" class="btn btn-secondary btn-sm"><i class="font-22 fadeIn animated bx bx-edit-alt"></i></a>\
                            <button class="btn btn-danger btn-sm" id="delete" value="'+val.id+'"><i class="font-22 lni lni-trash"></i></button>\
                            <button class="btn btn-success btn-sm"><i class="lni lni-eye"></i></button>\
                            '+status_btn+'\
                        </td>\
                    </tr>'
                    });
                    $(".tbodyData").html(Data);
                }
            }
        })
    }

    $(document).on("click","#delete",function(){
        $id = $(this).val();
        $("#delete_product").val($id);
        $("#OpenDelete").modal("show");
    });

    $(document).on("click","#delete_product",function(){
        var id = $(this).val();
        $.ajax({
            url:"/delete/product/"+id,
            type:"GET",
            success: function(response){
                $("#OpenDelete").modal("hide");
                swal("Success!", "Product Successfully Deleted", "success");
                show();
            }
        });
    })

    // Active to Inactive
    $(document).on("click","#Active",function(){
        var id = $(this).val();
        $.ajax({
            url:"/active/product/"+id,
            type:"GET",
            success: function(response){
                swal("Successfully Inactivate!", "Product Successfully Inactive", "success");
                show();
            }
        });
    });

    // Inactive to Active
    $(document).on("click","#Inactive",function(){
        var id = $(this).val();
        $.ajax({
            url:"/inactive/product/"+id,
            type:"GET",
            success: function(response){
                swal("Successfully Activate!", "Product Successfully Aactive", "success");
                show();
            }
        });
    });

});
