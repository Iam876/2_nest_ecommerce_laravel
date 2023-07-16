$(document).ready(function () {
    $(document).on("click", "#add_banner", function () {
        var BannerTitle = $("#banner_title").val();
        var BannerUrl = $("#banner_url").val();
        var BannerStatus = $("#banner_status").val();
        var BannerImage = $("#banner_image")[0].files[0];

        var formData = new FormData();
        formData.append("bTitle", BannerTitle);
        formData.append("bUrl", BannerUrl);
        formData.append("bStatus", BannerStatus);
        formData.append("bImage", BannerImage);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/add_banner/",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $(".modal").modal("hide");
                show();
                swal("Success!", "Banner Successfully Added", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            },
        });
    });
    show();
    function show() {
        $.ajax({
            url: "/show_banner/",
            type: "GET",
            success: function (response) {
                if (response.status == 200) {
                    var Data = "";
                    var id = 1;
                    $.each(response.AllData, function (key, val) {
                        Data +=
                            "<tr>\
                        <td>" +
                            id++ +
                            "</td>\
                        <td>" +
                            val.banner_title +
                            "</td>\
                        <td>" +
                            val.banner_url +
                            '</td>\
                        <td><img src="http://127.0.0.1:8000/' +
                            val.banner_image +
                            '" class="" width="60px" alt=""></td>\
                        <td>' +
                            (val.banner_status == "active"
                                ? "<button value='" +
                                  val.id +
                                  '\' id="Active" class="btn btn-success">Active</button>'
                                : "<button value='" +
                                  val.id +
                                  '\' id="Inactive" class="btn btn-warning">Inactive</button>') +
                            "</td>\
                        <td>\
                        <button value='" +
                            val.id +
                            '\' id="Edit" class="btn btn-info">Edit</button>\
                        <button value=\'' +
                            val.id +
                            '\' id="Delete" class="btn btn-danger">Delete</button>\
                    </tr>';
                    });
                    $(".tbodyData").html(Data);
                }
            },
        });
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", "#Active", function () {
        var active = $(this).val();
        $.ajax({
            url: "/active_banner/" + active,
            type: "GET",
            success: function (response) {
                show();
                swal("Success!", "Banner Successfully Inactive", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    $(document).on("click", "#Inactive", function () {
        var inactive = $(this).val();

        $.ajax({
            url: "/inactive_banner/" + inactive,
            type: "GET",
            success: function (response) {
                show();
                swal("Success!", "Banner Successfully Active", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    $(document).on("click", "#Delete", function () {
        var id = $(this).val();
        $("#delete_data").val(id);
        $("#OpenDelete").modal("show");
    });

    $(document).on("click", "#delete_data", function () {
        var id = $(this).val();
        $.ajax({
            url: "/delete_banner/" + id,
            type: "GET",
            success: function (response) {
                show();
                $("#OpenDelete").modal("hide");
                swal("Success!", "Banner Successfully Deleted", "success");
            },
        });
    });
    $(document).on("click", "#Edit", function () {
        var id = $(this).val();
        $("#update_banner").val(id);
        $("#updateModal").modal("show");
        $.ajax({
            url: "/edit_banner/" + id,
            type: "GET",
            success: function (response) {
                $("#edit_banner_title").val(response.success.banner_title);
                $("#edit_banner_url").val(response.success.banner_url);
                $("#edit_showImageBanner").attr(
                    "src",
                    "http://127.0.0.1:8000/" + response.success.banner_image
                );
                $("#edit_banner_status").val(response.success.banner_status);
            },
        });
    });

    $(document).on("click", "#update_banner", function () {
        var id = $(this).val();
        var EditBannerTitle = $("#edit_banner_title").val();
        var EditBannerUrl = $("#edit_banner_url").val();
        var EditBannerImage = $("#edit_banner_image")[0].files[0];
        var EditBannerStatus = $("#edit_banner_status").val();

        var formData = new FormData();
        formData.append("updateTitle", EditBannerTitle);
        formData.append("updateUrl", EditBannerUrl);
        formData.append("updateImage", EditBannerImage);
        formData.append("updateStatus", EditBannerStatus);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/update_banner/" + id,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                show();
                $("#updateModal").modal("hide");
                swal("Success!", "Slider Successfully Updated ", "success");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });
});
