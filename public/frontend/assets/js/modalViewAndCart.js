$(document).ready(function () {
    $(document).on("click", "#ProductModalShow", function () {
        var id = $(this).data("id");
        $("#addToCart").val(id);
        $.ajax({
            url: "/product/modal/view/" + id,
            type: "GET",
            success: function (response) {
                var amount =
                    response.product.selling_price -
                    response.product.discount_price;
                var discount = Math.round(
                    (amount / response.product.selling_price) * 100
                );
                var createdate = new Date(response.product.created_at);
                var year = createdate.getFullYear();
                var month = createdate.getMonth() + 1;
                var day = createdate.getDate();

                if (response.product.product_qty > 0) {
                    $("#ModalSales").removeClass("out-stock");
                    $("#ModalSales").addClass("in-stock");
                    $("#ModalSales").text("Stock In");
                } else {
                    $("#ModalSales").removeClass("in-stock");
                    $("#ModalSales").addClass("out-stock");
                    $("#ModalSales").text("Stock Out");
                }

                var link = $(".title-detail a");
                var id = response.product.id;
                var slug = response.product.product_slug;
                link.attr("href", "product/details/" + id + "/" + slug);
                link.text(response.product.product_name);

                // $("#ModalProductName").text(response.product.product_name);

                if (response.product.discount_price === null) {
                    $("#ModalSellingPrice").text(
                        "$" + response.product.selling_price
                    );
                } else {
                    $("#ModalSellingPrice").text(
                        "$" + response.product.discount_price
                    );
                    $("#ModalDiscountPercent").text(discount + "% Off");
                    $("#ModalDiscountPrice").text(
                        response.product.selling_price
                    );
                }

                $("#Modalbrand").text(response.product.brand.brand_name);
                $("#ModalVendor").text(response.product.vendor.name);
                $("#ModalVendor").attr(
                    "data-value",
                    response.product.vendor.id
                );

                $("#ModalProductCode").text(response.product.product_code);
                $("#ModalStock").text(
                    response.product.product_qty + " Items In Stock"
                );
                $("#ModalCategory").text(
                    response.product.category.category_name
                );
                $("#ModalSubCategory").text(
                    response.product.subcategory.subcategory_name
                );
                $("#ModalMFG").text(" " + year + "-" + month + "-" + day);
                $("#pimage").attr(
                    "src",
                    "/" + response.product.product_thumbnail
                );

                var Tagshtml = "";
                response.tags.forEach(function (tag) {
                    Tagshtml +=
                        '<a href="#" rel="tag"  value="' +
                        tag +
                        '">' +
                        tag +
                        " </a>";
                });
                $("#ModalProductTags").html(Tagshtml);

                if (response.product.product_color === null) {
                    $("#ModalNoColor").text("No color is available");
                } else {
                    var ProductColor = "";
                    var selectedColor = "Red";

                    response.colors.forEach(function (color) {
                        var isActive = color == selectedColor ? "active" : "";

                        ProductColor += '<li class="' + isActive + '">';
                        ProductColor +=
                            '<a href="#" data-value="' +
                            color +
                            '">' +
                            color +
                            "</a>";
                        ProductColor += "</li>";
                    });

                    $("#ModalColors").html(ProductColor);

                    $("#ModalColors").on("click", "li", function () {
                        // Remove active class from all color links
                        $("#ModalColors li").removeClass("active");
                        $(this).addClass("active");
                        selectedColor = $(this).data("value");
                    });
                }
                if (response.product.product_size === null) {
                    $("#ModalNoSize").text("No Size is available");
                } else {
                    var ProductSize = "";
                    var selectedSize = "Small";

                    response.sizes.forEach(function (size) {
                        var isActive = size == selectedSize ? "active" : "";

                        ProductSize += '<li class="' + isActive + '">';
                        ProductSize +=
                            '<a href="#" data-value="' +
                            size +
                            '">' +
                            size +
                            "</a>";
                        ProductSize += "</li>";
                    });

                    $("#ModalSize").html(ProductSize);

                    $("#ModalSize").on("click", "li", function () {
                        // Remove active class from all color links
                        $("#ModalSize li").removeClass("active");
                        $(this).addClass("active");
                        selectedSize = $(this).data("value");
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    $(document).on("click", "#addToCart", function () {
        var id = $(this).val();
        var product_name = $(".title-detail a").text();
        var product_color = $("#ModalColors li.active a").data("value");
        var product_size = $("#ModalSize li.active a").data("value");
        var vendor = $("#ModalVendor").data("value");
        var qty = $("#qty").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/cart/data/store/" + id,
            type: "POST",
            dataType: "json",
            data: {
                name: product_name,
                color: product_color,
                size: product_size,
                quantity: qty,
                vendor: vendor,
            },
            success: function (response) {
                $(".modal").modal("hide");
                miniCart();
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
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });
    $(document).on("click", "#addToCartWish", function () {
        var id = $(this).data("value");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/cart/data/store/wish/" + id,
            type: "POST",
            dataType: "json",
            success: function (response) {
                miniCart();
                console.log(response.carts);
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
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    function miniCart() {
        $.ajax({
            url: "/product/mini/cart/",
            type: "GET",
            dataType: "json",
            success: function (data) {
                const domain = window.location.origin;
                $("#miniCart").text(data.cartQty);
                $("#miniCartTotal").text("$" + data.cartTotal);

                var minicart = "";
                if (Object.keys(data.carts).length === 0) {
                    minicart = `<div class="alert alert-warning text-center fs-5 lead" role="alert">
                                No Product Found
                            </div>`;
                } else {
                    // Cart has products, so iterate over them
                    Object.entries(data.carts).forEach(function ([key, value]) {
                        minicart += `<ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="${domain}/product/details/${value.id}/${value.attributes.slug}">
                                                <img alt="Nest" src="/${value.attributes.image}" style="width:50px;height:50px;" />
                                            </a>
                                        </div>
                                        <div class="shopping-cart-title" style="margin: -56px 70px 28px; width:146px;">
                                            <h4><a href="${domain}/product/details/${value.id}/${value.attributes.slug}">${value.name}</a></h4>
                                            <h4><span>${value.quantity} × </span>$${value.price}</h4>
                                        </div>
                                        <div class="shopping-cart-delete" id="CartRemoveProducts" style="margin: -85px 1px 0px;">
                                            <a href="#"><i class="fi-rs-cross-small" id="rowId" data-value="${value.id}"></i></a>
                                        </div>
                                    </li>
                                </ul>`;
                    });
                }
                $("#miniCartLists").html(minicart);
            },
        });
    }
    miniCart();

    $(document).on("click", "#CartRemoveProducts", function () {
        var id = $("#rowId").data("value");
        $.ajax({
            url: "/cart/product/remove/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (response) {
                miniCart();
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

    $(document).on("click", "#WishListRemove", function () {
        var id = $("#rowId").data("value");
        $.ajax({
            url: "/cart/product/remove/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (response) {
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

    $(document).on("click", "#DetailAddToCart", function () {
        var id = $("#DetailAddToCart i").data("value");
        var product_name = $(".title-detail").text();
        var product_color = $("#ProductColor li.active a").data("value");
        var product_size = $("#ProductSize li.active a").data("value");
        var qty = $("#ProductQty").val();
        var vendor = $("#productDetailsVendorId").data("value");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/cart/data/store/" + id,
            type: "POST",
            dataType: "json",
            data: {
                name: product_name,
                color: product_color,
                size: product_size,
                quantity: qty,
                vendor: vendor,
            },
            success: function (response) {
                miniCart();
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
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });
});
