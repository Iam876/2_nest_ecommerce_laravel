$(document).ready(function () {
    $(document).on("click", "#ProductWishListIcon", function () {
        var product_id = $(this).data("id");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/product/addToWishList/" + product_id,
            type: "POST",
            dataType: "JSON",
            success: function (response) {
                ShowWishListProduct();
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",

                    showConfirmButton: false,
                    timer: 2000,
                });
                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        type: "success",
                        icon: "success",
                        title: response.success,
                    });
                } else {
                    Toast.fire({
                        type: "error",
                        icon: "error",
                        title: response.error,
                    });
                }
            },
        });
    });
    ShowWishListProduct();
    function ShowWishListProduct() {
        $.ajax({
            url: "/all/wishlist/",
            type: "GET",
            dataType: "JSON",
            success: function (response) {
                $("#totalProducts").text(response.wishQty);
                if (response.wishQty) {
                    $("#wishCount").text(response.wishQty);
                } else {
                    $("#wishCount").text(0);
                }

                if (response.wishlist.length === 0) {
                    var empty = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                 Wishlist is empty. Please Add Some product.
                            </div>`;
                    $("#wishListMessage").html(empty);
                    $("#wishHead").hide();
                    $("#WishShow").hide();
                } else {
                    var wishlistIterate = "";
                    var wishHeader = `<tr class="main-heading">
                                    <th class="pl-30" scope="col" colspan="2">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>`;
                    const domain = window.location.origin;
                    $.each(response.wishlist, function (key, value) {
                        var price =
                            value.product.discount_price === null
                                ? value.product.selling_price
                                : value.product.discount_price;
                        var stock =
                            value.product.product_qty > 0
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                : `<span class="stock-status out-stock mb-0"> Stock Out </span>`;

                        var cart =
                            value.product.product_qty > 0
                                ? `<button class="btn btn-sm" data-value="${value.product.id}" id="addToCartWish">Add to cart</button>`
                                : ` <button class="btn btn-sm btn-secondary">Contact Us</button>`;

                        wishlistIterate += `
                <tr class="pt-30">  
                        <td class="image product-thumbnail pt-40 pl-30"><img src="${domain}/${value.product.product_thumbnail}" alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="${domain}/product/details/${value.product.id}/${value.product.product_slug}">${value.product.product_name}</a></h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                        </td>
                        
                        <td class="price" data-title="Price">
                            <h3 class="text-brand">$${price}</h3>
                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            ${stock}
                        </td>
                        <td class="text-right" data-title="Cart">
                            ${cart}
                        </td>
                        <td class="action text-center" data-title="Remove" data-id="${value.id}" id="WishListRemove">
                            <a class="text-body"><i class="fi-rs-trash"></i></a>
                        </td>
                </tr>
                    `;
                    });
                    $("#wishHead").html(wishHeader);
                    $("#WishShow").html(wishlistIterate);
                }
            },
        });
    }

    $(document).on("click", "#WishListRemove", function () {
        var id = $(this).data("id");
        $.ajax({
            url: "/wish/product/remove/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (response) {
                ShowWishListProduct();
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                });
                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        type: "success",
                        title: response.success,
                    });
                } else {
                    Toast.fire({
                        type: "error",
                        title: response.error,
                    });
                }
            },
        });
    });
});
