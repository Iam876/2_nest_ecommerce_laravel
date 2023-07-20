$(document).ready(function() {
    $(document).on("click","#AddMainCart",function(){
        var id = $(this).data("value");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url:"/main/cart/store/"+id,
            type:"POST",
            dataType:'json',
            success: function(response){
               
                console.log(response.carts);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success', 
                    showConfirmButton: false,
                    timer: 2000 
              })
              if ($.isEmptyObject(response.error)) {
                showCart();
                      Toast.fire({
                      type: 'success',
                      title: response.success, 
                      })
              }else{
                 
             Toast.fire({
                      type: 'error',
                      title: response.error, 
                      })
                  }
                             
            },error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    })
    showCart();
    function showCart(){
        $.ajax({
            url:"/all/cart/products/",
            type:"GET",
            dataType:"JSON",
            success:function(response){
                couponCalculation();
                $("#miniCart").text(response.cartQty);
                var data = '';
                const domain = window.location.origin;
                $.each(response.carts,function(key,value){
                    console.log(value.price);
                    var totalPrice = value.price * value.quantity;
                    data+=`<tr class="pt-30">
                    <td class="image product-thumbnail pt-40 pl-30"><img src="${domain}/${value.attributes.image}" alt="#"></td>
                    <td class="product-des product-name">
                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${value.name}</a></h6>
                        <div class="product-rate-cover">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width:90%">
                                </div>
                            </div>
                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                        </div>
                    </td>
                    <td class="price" data-title="Price">
                        <h4 class="text-body">$${value.price} </h4>
                    </td>
                    <td class="text-center detail-info" data-title="Stock">
                        <div class="detail-extralink mr-15">
                            <div class="detail-qty border radius">
                                <a id="PriceDown" data-id="${value.id}" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                <input type="text" name="quantity" class="qty-val" value="${value.quantity}" min="1" data-id="${value.id}" disabled>
                                <a class="qty-up" id="PriceUp" data-id="${value.id}"><i class="fi-rs-angle-small-up"></i></a>
                            </div>
                        </div>
                    </td>
                    <td class="price" data-title="Price">
                        <h4 class="text-brand">$${totalPrice} </h4>
                    </td>
                    <td class="action text-center" data-title="Remove"><a id="mainCartRemove" data-id="${value.id}" class="text-body"><i class="fi-rs-trash"></i></a></td>
                </tr>`;
                });
                $("#MainCartPrice").text(response.cartTotal);
                $("#mainCart").html(data);
            }
        })
    }

    $(document).on("click","#PriceUp",function(){
        var id = $(this).data("id");
        $.ajax({
            url:"/increment_quantity/"+id,
            type:"GET",
            dataType:"JSON",
            success:function(response){
                showCart();
            }
        })
    })
    $(document).on("click","#PriceDown",function(){
        var id = $(this).data("id");
        $.ajax({
            url:"/decrement_quantity/"+id,
            type:"GET",
            dataType:"JSON",
            success:function(response){
                showCart();
                couponCalculation();
            }
        })
    })
    $(document).on("click","#mainCartRemove",function(){
        var id = $(this).data("id");
        $.ajax({
            url:"/main/cart/remove/"+id,
            type:"GET",
            dataType:"JSON",
            success:function(response){
                showCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success', 
                    showConfirmButton: false,
                    timer: 2000 
                })
                if ($.isEmptyObject(response.error)){
                        Toast.fire({
                        type: 'success',
                        title: response.success, 
                        })
                }else{
                Toast.fire({
                        type: 'error',
                        title: response.error, 
                        })
                    }
                                 
            }
        })
    });
    
    $(document).on("click","#apply_coupon",function(){
        var coupon_name = $("#coupon").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"/apply_coupon",
            type:"POST",
            data:{coupon_name:coupon_name},
            dataType:"JSON",
            success:function(response){
                couponCalculation();
                 if(response.validity == true){
                    $("#couponField").hide();
                 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success', 
                    showConfirmButton: false,
                    timer: 2000 
              })
              if ($.isEmptyObject(response.error)) {
                showCart();
                      Toast.fire({
                      type: 'success',
                      title: response.success, 
                      })
              }else{
                 
             Toast.fire({
                      type: 'error',
                      title: response.error, 
                      })
                  }  
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'error', 
                        showConfirmButton: false,
                        timer: 2000 
                  })
                  if ($.isEmptyObject(response.error)) {
                    showCart();
                          Toast.fire({
                          type: 'success',
                          title: response.success, 
                          })
                  }else{
                     
                 Toast.fire({
                          type: 'error',
                          title: response.error, 
                          })
                      }  
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    })

    function couponCalculation(){
        $.ajax({
            url:"/coupon_calculation",
            type:"GET",
            dataType:"JSON",
            success:function(data){
               if(data.total){
                $("#CouponCalField").html(`<tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end" id="MainCartPrice">$${data.total}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="2">
                            <div class="divider-2 mt-10 mb-10"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Shipping</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h5 class="text-heading text-end">Free</h4</td> </tr> <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Estimate for</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h5 class="text-heading text-end">United Kingdom</h4</td> </tr> <tr>
                        <td scope="col" colspan="2">
                            <div class="divider-2 mt-10 mb-10"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Total</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">$${data.total}</h4>
                        </td>
                    </tr>`);
               }else{
                $("#CouponCalField").html(`
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end" id="MainCartPrice">$${data.subtotal}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="2">
                            <div class="divider-2 mt-10 mb-10"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Coupon Name</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h5 class="text-heading text-end">${data.coupon_name}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Remove Coupon</h6>
                        </td>
                        <td class="cart_total_amount">
                            <div class="text-end" id="couponRemove">
                                <i class="fi-rs-trash btn btn-warning"> Remove</i>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td scope="col" colspan="2">
                            <div class="divider-2 mt-10 mb-10"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Coupon Discount</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${data.coupon_discount}%</h4>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="2">
                            <div class="divider-2 mt-10 mb-10"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Discount amount</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">(-) $${data.discount_amount}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="2">
                            <div class="divider-2 mt-10 mb-10"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Total Amount</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">$${data.total_amount}</h4>
                        </td>
                    </tr>
                    `);
               }
            }
        })
    }

    $(document).on("click","#couponRemove",function(){
        $.ajax({
            url: "/coupon-remove",
            type: "GET",
            dataType: 'json',
            success:function(data){
               couponCalculation();
               $('#couponField').show();
                 // Start Message 
        const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              
              showConfirmButton: false,
              timer: 3000 
        })
        if ($.isEmptyObject(data.error)) {
                
                Toast.fire({
                type: 'success',
                icon: 'success', 
                title: data.success, 
                })
        }else{
           
       Toast.fire({
                type: 'error',
                icon: 'error', 
                title: data.error, 
                })
            }
           
            }
        })
    })
 
})