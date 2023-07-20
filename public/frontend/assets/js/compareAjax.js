$(document).ready(function(){
    $(document).on("click","#CompareProductIcon",function(){
        var product_id = $(this).data("id");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            
            url:"/product/compare/"+product_id,
            type:"POST",
            dataType:"JSON",
            success: function(response){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    
                    showConfirmButton: false,
                    timer: 2000 
              })
              if ($.isEmptyObject(response.error)) {
                      
                      Toast.fire({
                      type: 'success',
                      icon: 'success', 
                      title: response.success, 
                      })
              }else{
                 
             Toast.fire({
                      type: 'error',
                      icon: 'error', 
                      title: response.error, 
                      })
                  }
                             
            }
        })
    })
    showCompareProduct();
    function showCompareProduct(){
        $.ajax({
            url:"/show/compare/product/",
            type:"GET",
            dataType:"JSON",
            success:function(response){
                $("#CompareCount").text(response.Quantity);
                $("#CompareTotal").text(response.Quantity);

                const domain = window.location.origin;
                var comparePreview = '';
                var compareName = '';
                var comparePrice = '';
                var compareRating = '';
                var compareDescription = '';
                var compareStock = '';
                var compareSize = '';
                var compareColor = '';
                var compareAddToCart = '';
                var compareRemove = '';
                

                $.each(response.Product,function(key,value){

                    var price = value.product.discount_price == null ? value.product.selling_price : value.product.discount_price;
                    var stock = value.product.product_qty > 0 ? `<span class="stock-status in-stock mb-0">In Stock</span>` : `<span class="stock-status out-stock mb-0">Stock Out</span>`;
                    var cart = value.product.product_qty > 0 ? `<button class="btn btn-sm" id="addToCartWish" data-value="${value.product.id}"><i class="fi-rs-shopping-bag mr-5"></i>Add to cart</button>` : ` <button class="btn btn-sm btn-secondary">Contact Us</button>`;

                    comparePreview+=`
                            <td class="row_img p-2">
                                <img src="${domain}/${value.product.product_thumbnail}" width="80px" alt="compare-img" />
                            </td>`;

                    compareName+=`<td class="product_name">
                        <h6><a href="${domain}/product/details/${value.product.id}/${value.product.product_slug}" class="text-heading">${value.product.product_name}</a></h6>
                    </td>`;

                    comparePrice+=`<td class="product_price">
                    <h4 class="price text-brand">$${price}</h4>
                    </td>`;
                    compareRating+=`
                    <td>
                        <div class="rating_wrap">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="rating_num">(121)</span>
                        </div>
                    </td>`;
                    compareDescription+=`<td class="row_text font-xs">
                                        <p class="font-sm text-muted">${value.product.short_descp}</p>
                                        </td>`;
                    compareStock+=`<td class="row_stock">${stock}</td>`;

                    compareSize += `<td class="row_size">${value.product.product_size}</td>`;
                    compareColor += `<td class="row_color">${value.product.product_color}</td>`;
                    compareAddToCart+=`<td class="row_btn">
                                        ${cart}
                                       </td>`;
                    compareRemove+=`<td class="row_remove">
                                        <a id="RemoveProductCompare" data-id="${value.id}" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                                    </td>`;

                    });


                $(".pr_image").empty().append(comparePreview);
                $(".pr_title").empty().append(compareName);
                $(".pr_price").empty().append(comparePrice);
                $(".pr_rating").empty().append(compareRating);
                $(".description").empty().append(compareDescription);
                $(".pr_stock").empty().append(compareStock);
                $(".pr_size").empty().append(compareSize);
                $(".pr_color").empty().append(compareColor);
                $(".pr_add_to_cart").empty().append(compareAddToCart);
                $(".pr_remove").empty().append(compareRemove);
            }
        })
    }

    $(document).on("click","#RemoveProductCompare",function(){
        var id = $(this).data("id");
        $.ajax({
            url:"/compare/product/remove/"+id,
            type:"GET",
            dataType:"JSON",
            success:function(response){
                showCompareProduct();
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
            },error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    });


    $(document).on("click","#addToCartWish",function(){
        var id = $(this).data("value");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url:"/cart/data/store/compare/"+id,
            type:"POST",
            dataType:'json',
            success: function(response){
                miniCart();
                console.log(response.carts);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success', 
                    showConfirmButton: false,
                    timer: 2000 
              })
              if ($.isEmptyObject(response.error)) {
                      
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
    
})