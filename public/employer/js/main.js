$(document).ready(function() {
    AOS.init({
        duration: 1200
    });

    // upload avatar employer
    $("#avatar-employer").change(function(e) {
        $(".form-avatar .box-preview").remove();
        let file = e.target.files[0];
        if (typeof(file) != "undefined" && ["image/jpeg", "image/png"].indexOf(file.type) != -1) {
            $(".model-update-employer .form-avatar").append(`<div class="box-preview"><a href="" class="box-thumbnail"><img class="thumbnail img-fluid" src="${URL.createObjectURL(file)}" alt=""></a></div>`);
        };
    })

    // upload avatar company

    $(".box-preview-company-logo .btn-upload").click(function() {
        $(".box-preview-company-logo #upload-company-logo").trigger("click");
    })

    // crop avatar company
    crop_image({
        id_preview: "preview_avatar",
        model_preview: "#model-upload-company-avatar",
        btn_drop: "#crop_avatar",
        producted: ".box-preview-company-logo .box-thumbnail img",
        preview_mini: ".preview_avatar_mini",
        input: "#upload-company-logo",
    });


    $(".box-preview-company-banner .btn-upload").click(function() {
        $(".box-preview-company-banner #upload-company-banner").trigger("click");
    })

    // crop banner company 
    crop_image({
        id_preview: "preview_banner",
        model_preview: "#model-upload-company-banner",
        btn_drop: "#crop_banner",
        producted: ".box-preview-company-banner .box-thumbnail img",
        preview_mini: ".preview_banner_mini",
        input: "#upload-company-banner",
        ratio: 2.1
    });

    // upload business-license
    // <a href="" class="btn btn-success btn-preview">xem file</a>
    $(".business-license .btn-upload").click(function() {
        $(".business-license .btn-preview").remove();
        $(".business-license .file").trigger("click");
    })

    $(".business-license .file").change(function(e) {
        if (typeof(e.target.files[0]) != "undefined" && ["application/pdf"].indexOf(e.target.files[0].type) != -1) {
            $(".business-license").append(`<a href="${URL.createObjectURL(e.target.files[0])}" target="_back" class="btn btn-success">Xem file</a>`);
        }
    })

    // couter

    function set_counter() {
        let counters = document.querySelectorAll(".counter");
        counters.forEach((counter) => {
            let number_stop = counter.getAttribute("data-number");
            let number = 0;
            let timer = setInterval(function() {
                number++;
                counter.innerHTML = number;
                if (number >= number_stop) {
                    clearInterval(timer);
                }
            }, 100);
        })
    }

    set_counter();

    // js check all


    $(".btn-select-all").click(function(e) {
        $(this).toggleClass("checked");
        let index = Number($(this).hasClass("checked"));
        $(this).text(["Chọn tất cả", "Bỏ chọn tất cả"][index])
        $(".box-save-profile input[type='checkbox']").prop("checked", index);
        return false;
    })

    $(".btn-delete").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
        return false;
    })

    $(".box-product .btn-arrow").click(function() {
        $(this).toggleClass("active");
        $(this).parents(".product").find(".list-package").toggleClass("show");
    })

    // active buy product
    $(document).on("click", ".box-product .btn-buy", function() {
        $(this).addClass("btn-trash");
        $(this).html('<i class="fas fa-trash-alt"></i>');
        $(this).parents(".list-package .row").find(".qty").addClass("show").val(1);
        $("body").append('<div class="box-product box-total shadow"><span class="title">Tổng cộng (Đã bao gồm 10% thuế VAT):</span><span class="total">2,107,215 đ</span><a href="" class="btn btn-primary btn-sm">Đặt hàng</a></div>');
    })

    $(document).on("click", ".box-product .btn-buy.btn-trash", function() {
        $(this).removeClass("btn-trash");
        $(this).html('Mua thêm');
        $(this).parents(".list-package .row").find(".qty").removeClass("show");
        $("body .box-product.box-total").remove();
    })

    $(document).on("click", ".box-product .qty", 'change', function() {
        alert("đã thay đổi");
    })

    $(".modal-more .modal-notification .btn-close,.modal-more .dialog").click(function() {
        $(this).parents(".modal-more").removeClass("show");
    })

    setTimeout(function() {
        $(".modal-more").addClass("show");
    })

})