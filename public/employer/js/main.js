function addLoading() {
    $("body").append('<div class="box-loading"><div class="dialog"></div><div class="spinner-border text-primary" role="status"><span class="visually-hidden"></span></div></div>')
}

function removeLoading() {
    $("body .box-loading").remove();
}

$(document).ready(function() {

    try {
        AOS.init({
            duration: 1200
        });
    } catch (e) {
        console.log("Lỗi", e);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // AOS.init({
    //     duration: 1200
    // });
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


    $(".box-preview-company-banner .btn-upload").click(function() {
        $(".box-preview-company-banner #upload-company-banner").trigger("click");
    })

    // couter

    function set_counter() {
        let counters = document.querySelectorAll(".counter");
        counters.forEach((counter) => {
            let number_stop = counter.getAttribute("data-number");
            let number = 0;
            if (number_stop == 0) return false;
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


    $(".modal-more .modal-notification .btn-close,.modal-more .dialog").click(function() {
        $(this).parents(".modal-more").removeClass("show");
    })

    setTimeout(function() {
        $(".modal-more").addClass("show");
    })

})