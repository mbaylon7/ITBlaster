"use strict";

var KTAppEcommerceSalesListing = function () {
    var e, t, n, r, o, a = (e, n, a) => {
        r = e[0] ? new Date(e[0]) : null,
        o = e[1] ? new Date(e[1]) : null,
        $.fn.dataTable.ext.search.push((e, t, n) => {
            var a = r, c = o,
                l = new Date(moment($(t[5]).text(), "DD/MM/YYYY")),
                u = new Date(moment($(t[6]).text(), "DD/MM/YYYY"));
            
            return (null === a && null === c) ||
                   (null === a && c >= u) ||
                   (a <= l && null === c) ||
                   (a <= l && c >= u);
        }),
        t.draw();
    };

    var c = () => {
        e.querySelectorAll('[data-kt-ecommerce-order-filter="delete_row"]').forEach((e) => {
            e.addEventListener("click", (e) => {
                e.preventDefault();
                const n = e.target.closest("tr"),
                    r = n.querySelector('[data-kt-ecommerce-order-filter="order_id"]').innerText;
                Swal.fire({
                    text: "Are you sure you want to delete order: " + r + "?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((e) => {
                    e.value ? Swal.fire({
                        text: "You have deleted " + r + "!",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    }).then((() => {
                        t.row($(n)).remove().draw();
                    })) : "cancel" === e.dismiss && Swal.fire({
                        text: r + " was not deleted.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
                });
            });
        });
    };

    return {
        init: function () {
            let t1, n1;
    
            const e1 = document.querySelector("#suspended_user");
            if (e1) {
                t1 = $(e1).DataTable({
                    info: false,
                    order: [[1, 'asc']],
                    pageLength: 10,
                    columnDefs: [{ orderable: false, targets: 0 }, { orderable: false, targets: 6 }]
                }).on("draw", () => { c(); });
            }
    
            let t2, n2;
    
            const e2 = document.querySelector("#inactive_user");
            if (e2) {
                t2 = $(e2).DataTable({
                    info: false,
                    order: [[1, 'asc']],
                    pageLength: 10,
                    columnDefs: [{ orderable: false, targets: 0 }, { orderable: false, targets: 6 }]
                }).on("draw", () => { c(); });
            }
    
            let t, n;
    
            const e = document.querySelector("#active_user");
            if (e) {
                t = $(e).DataTable({
                    info: false,
                    order: [[1, 'asc']],
                    pageLength: 10,
                    columnDefs: [{ orderable: false, targets: 0 }, { orderable: false, targets: 6 }]
                }).on("draw", () => { c(); });

                const datepicker = document.querySelector("#kt_ecommerce_sales_flatpickr");
                n = $(datepicker).flatpickr({
                    altInput: true,
                    altFormat: "d/m/Y",
                    dateFormat: "Y-m-d",
                    mode: "range",
                    onChange: function (selectedDates, dateStr, instance) { a(selectedDates, dateStr, instance); }
                });
            }
    
            document.querySelector("#kt_ecommerce_sales_flatpickr_clear").addEventListener("click", () => {
                n.clear();
            });
    
            document.querySelector('[data-kt-ecommerce-order-filter="search"]').addEventListener("keyup", (e) => {
                t.search(e.target.value).draw();
            });
    
            const statusFilter = document.querySelector('[data-kt-ecommerce-order-filter="status"]');
            if (statusFilter) {
                $(statusFilter).on("change", (e) => {
                    let status = e.target.value;
                    if (status === "all") {
                        status = "";
                    }
                    t.column(5).search(status).draw();
                });
            }
        },
    };
    
}();

KTUtil.onDOMContentLoaded((() => {
    KTAppEcommerceSalesListing.init();
}));
