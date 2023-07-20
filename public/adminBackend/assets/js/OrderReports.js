$(document).ready(function () {
    $("#SearchUserOrder").click(function () {
        var search = $("#searchBox").val();
        // alert(search);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/user/order/info/search/" + search,
            type: "GET",
            success: function (res) {
                let data = "";
                $.each(res.allData, function (key, val) {
                    data += `   <tr>
                                    <td>${key + 1}</td>
                                    <td>${val.user.id}</td>
                                    <td>${val.user.username}</td>
                                    <td>${val.order_date}</td>
                                    <td>${val.invoice_no}</td>
                                    <td>${val.amount}</td>
                                    <td>${val.payment_method}</td>
                                    <td>
                                        ${
                                            val.status === "delivered"
                                                ? `<span class="badge rounded-pill bg-light-success text-success w-50">Delivered</span>`
                                                : val.status === "pending"
                                                ? `<span class="badge rounded-pill bg-light-info text-info w-50">Pending</span>`
                                                : val.status === "confirmed"
                                                ? `<span class="badge rounded-pill bg-light-primary text-primary w-50">confirmed</span>`
                                                : `<span class="badge rounded-pill bg-light-danger text-danger w-50">Canceled</span>`
                                        }
                                    </td>
                                </tr>`;
                });
                $(".tbodyData").html(data);
            },
        });
    });
    $("#fullDate").click(function () {
        var fulldate = $(".datepicker").val();
        $.ajax({
            url: "/user/order/info/fulldate/" + fulldate,
            type: "GET",
            success: function (res) {
                let data = "";
                $.each(res.allData, function (key, val) {
                    data += `   <tr>
                                    <td>${key + 1}</td>
                                    <td>${val.user.id}</td>
                                    <td>${val.user.username}</td>
                                    <td>${val.order_date}</td>
                                    <td>${val.invoice_no}</td>
                                    <td>${val.amount}</td>
                                    <td>${val.payment_method}</td>
                                    <td>
                                        ${
                                            val.status === "delivered"
                                                ? `<span class="badge rounded-pill bg-light-success text-success w-50">Delivered</span>`
                                                : val.status === "pending"
                                                ? `<span class="badge rounded-pill bg-light-info text-info w-50">Pending</span>`
                                                : val.status === "confirmed"
                                                ? `<span class="badge rounded-pill bg-light-primary text-primary w-50">confirmed</span>`
                                                : `<span class="badge rounded-pill bg-light-danger text-danger w-50">Canceled</span>`
                                        }
                                    </td>
                                </tr>`;
                });
                $(".DateData").html(data);
                // console.log(res.allData);
            },
        });
    });
    $("#Searchmonth").click(function () {
        var monthData = $(".pickmonth").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/user/order/info/month/" + monthData,
            type: "GET",
            success: function (res) {
                // let data = "";
                // $.each(res.allData, function (key, val) {
                //     data += `   <tr>
                //                     <td>${key + 1}</td>
                //                     <td>${val.user.id}</td>
                //                     <td>${val.user.username}</td>
                //                     <td>${val.order_date}</td>
                //                     <td>${val.invoice_no}</td>
                //                     <td>${val.amount}</td>
                //                     <td>${val.payment_method}</td>
                //                     <td>
                //                         ${
                //                             val.status === "delivered"
                //                                 ? `<span class="badge rounded-pill bg-light-success text-success w-50">Delivered</span>`
                //                                 : val.status === "pending"
                //                                 ? `<span class="badge rounded-pill bg-light-info text-info w-50">Pending</span>`
                //                                 : val.status === "confirmed"
                //                                 ? `<span class="badge rounded-pill bg-light-primary text-primary w-50">confirmed</span>`
                //                                 : `<span class="badge rounded-pill bg-light-danger text-danger w-50">Canceled</span>`
                //                         }
                //                     </td>
                //                 </tr>`;
                // });
                // $(".DateData").html(data);
                console.log(res.allData);
            },
        });
    });
    $("#Searchyear").click(function () {
        var year = $(".picyear").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/user/order/info/year/" + year,
            type: "GET",
            success: function (res) {
                // let data = "";
                // $.each(res.allData, function (key, val) {
                //     data += `   <tr>
                //                     <td>${key + 1}</td>
                //                     <td>${val.user.id}</td>
                //                     <td>${val.user.username}</td>
                //                     <td>${val.order_date}</td>
                //                     <td>${val.invoice_no}</td>
                //                     <td>${val.amount}</td>
                //                     <td>${val.payment_method}</td>
                //                     <td>
                //                         ${
                //                             val.status === "delivered"
                //                                 ? `<span class="badge rounded-pill bg-light-success text-success w-50">Delivered</span>`
                //                                 : val.status === "pending"
                //                                 ? `<span class="badge rounded-pill bg-light-info text-info w-50">Pending</span>`
                //                                 : val.status === "confirmed"
                //                                 ? `<span class="badge rounded-pill bg-light-primary text-primary w-50">confirmed</span>`
                //                                 : `<span class="badge rounded-pill bg-light-danger text-danger w-50">Canceled</span>`
                //                         }
                //                     </td>
                //                 </tr>`;
                // });
                // $(".DateData").html(data);
                console.log(res.allData);
            },
        });
    });
});
