(function($) {
    "use strict";
    var $main_window = $(window);
    $main_window.on("load", function() { $("#preloader").fadeOut("slow"); });
    $main_window.on("scroll", function() { if ($(this).scrollTop() > 250) { $(".back-to-top").fadeIn(200); } else { $(".back-to-top").fadeOut(200); } });
    $(".back-to-top").on("click", function() { $("html, body").animate({ scrollTop: 0 }, "slow"); return false; });
    var logo_path = $('.mobile-menu').data('logo');
    $('#main-navbar').slicknav({ appendTo: '.mobile-menu', removeClasses: false, label: '', closedSymbol: '<i class="lni-chevron-right"><i/>', openedSymbol: '<i class="lni-chevron-down"><i/>', brand: '<a href="index.html"><img src="' + logo_path + '" class="img-responsive" alt="logo"></a>' });
    $main_window.on('scroll', function() { var scroll = $(window).scrollTop(); if (scroll >= 100) { $(".scrolling-navbar").addClass("top-nav-collapse"); } else { $(".scrolling-navbar").removeClass("top-nav-collapse"); } });
    if ($(".fact-count").length > 0) { $(".counter").counterUp({ delay: 10, time: 500 }); }
    var testiOwl = $("#testimonials");
    testiOwl.owlCarousel({ autoplay: true, margin: 30, dots: true, autoplayHoverPause: true, nav: false, loop: true, responsiveClass: true, responsive: { 0: { items: 1, }, 991: { items: 1 } } });
    var newproducts = $("#new-products");
    newproducts.owlCarousel({ autoplay: true, nav: true, autoplayHoverPause: true, smartSpeed: 350, dots: false, margin: 30, loop: true, navText: ['<i class="lni-chevron-left"></i>', '<i class="lni-chevron-right"></i>'], responsiveClass: true, responsive: { 0: { items: 1, }, 575: { items: 2, }, 991: { items: 3, } } });

    $(document).on("click", "#btn-open-seach-advanced", function() {
        $(this).attr("id", "btn-close-seach-advanced");
        $(this).text("Đóng tìm kiếm nâng cao")
        $(".job-search-form .seach-adanced").append('<div class="row"><div class="col-md-3"><div class="form-group"><div class="search-category-container"><label class="styled-select"><select> <option value="none">Mức lương</option><option value="none">New York</option><option value="none">California</option><option value="none">Washington</option><option value="none">Birmingham</option><option value="none">Chicago</option><option value="none">Phoenix</option></select></label></div><i class="fas fa-money-bill"></i></div></div><div class="col-md-3"><div class="form-group"><div class="search-category-container"><label class="styled-select"><select><option value="none">Kinh nghiệm</option></select></label></div><i class="fas fa-briefcase"></i></div></div><div class="col-md-3"><div class="form-group"><div class="search-category-container"><label class="styled-select"><select><option value="none">Loại hình</option><option value="none">New York</option><option value="none">California</option></select></label></div><i class = "far fa-clock"></i></div></div><div class = "col-md-3" ><div class = "form-group" ><div class = "search-category-container" ><label class="styled-select"><select><option value ="none"> Lĩnh vực </option> <option value = "none"> New York </option><option value = "none"> Phoenix </option></select></label></div> <i class = "far fa-building" ></i></div></div></div>')
    })

    $(document).on("click", "#btn-close-seach-advanced", function() {
        $(this).attr("id", "btn-open-seach-advanced");
        $(this).text("Chọn tìm kiếm nâng cao")
        $(".job-search-form .seach-adanced").empty();
    })


})(jQuery);

// crop avatar 
crop_image({
    id_preview: "preview_avatar",
    model_preview: "#model-upload-avatar",
    btn_drop: "#crop_avatar",
    producted: ".box-avatar img",
    preview_mini: ".preview_avatar_mini",
    input: "#upload-avatar",
});
// crop cover
crop_image({
    id_preview: "preview_cover",
    model_preview: "#model-upload-cover",
    btn_drop: "#crop_cover",
    producted: ".box-cover-imgage img",
    preview_mini: ".preview_cover_mini",
    input: "#upload-cover",
    width: 720,
    height: 200,
    ratio: 2.225
});

$("#btn-upload-cv").change(function(e) {
    $("#model-upload-cv .box-upload-cv #btn-preview-cv").remove();
    if (e.target.files[0].type.indexOf("application/pdf") != -1) {
        let url = URL.createObjectURL(e.target.files[0]);
        $("#model-upload-cv .box-upload-cv").append('<a href="' + url + '" id="btn-preview-cv" target="_black">Xem trước</a>');
    }
})

$(".list-cv .box-option .btn-delete-cv").click(function(e) {
    Swal.fire({
        title: 'Xóa CV',
        text: "Bạn có muốn xóa cv không!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Hoàn thành!',
                'Cv đã được xóa',
                'success'
            )
        }
    })
    return false;
})

$(function() {
    $("img.lazy").lazyload({});
    $('img.lazy').on('appear', function() {
        console.log(this)
    });
});

// btn open model search 

$(".btn-open-search-post").click(function() {
    $(".top-search-post").toggleClass("active");
    return false;
})