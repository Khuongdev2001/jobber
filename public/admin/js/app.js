function addLoading() {
    $("body").append('<div class="box-loading"><div class="dialog"></div><div class="spinner-border text-primary" role="status"><span class="visually-hidden"></span></div></div>')
}

function removeLoading() {
    $("body .box-loading").remove();
}


let zoom = 0;
setInterval(function() {
    if (zoom < 0) {
        zoom = 1;
    }
    zoom += zoom < 360 ? 0.1 : -1;
    document.querySelector("img").style.transform = `rotate(${zoom}deg)`;
});



function actionAll(url, urlContinue, object) {
    console.log(object);
    $(".btn-delete-all").click(function() {
        Swal.fire({
            title: object.title,
            text: object.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vẫn tiếp tục'
        }).then((result) => {
            if (result.isConfirmed) {
                let ids = [];
                let checkboxs = document.querySelectorAll(".table input[type='checkbox'");
                for (let i = 0; i < checkboxs.length; i++) {
                    if (checkboxs[i].checked) {
                        ids.push(checkboxs[i].getAttribute("data-id"));
                    }
                }
                if (!ids.length) {
                    error_noti({ title: "Lỗi Người Dùng", message: "Bạn chưa chọn đối tượng" })
                    return false;
                }
                ids = ids.join();
                window.location.href = url + `?ids=${ids}` + `&continue=${urlContinue}`;
            }
        })
    })
}

$(function() {
    "use strict";
    new PerfectScrollbar(".header-message-list"), new PerfectScrollbar(".header-notifications-list"), $(".mobile-search-icon").on("click", function() {
            $(".search-bar").addClass("full-search-bar")
        }), $(".search-close").on("click", function() {
            $(".search-bar").removeClass("full-search-bar")
        }), $(".mobile-toggle-menu").on("click", function() {
            $(".wrapper").addClass("toggled")
        }), $(".toggle-icon").click(function() {
            $(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
                $(".wrapper").addClass("sidebar-hovered")
            }, function() {
                $(".wrapper").removeClass("sidebar-hovered")
            }))
        }), $(document).ready(function() {
            $(window).on("scroll", function() {
                $(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
            }), $(".back-to-top").on("click", function() {
                return $("html, body").animate({
                    scrollTop: 0
                }, 600), !1
            })
        }),

        $(document).ready(function() {
            $(window).on("scroll", function() {
                if ($(this).scrollTop() > 60) {
                    $('.topbar').addClass('bg-dark');
                } else {
                    $('.topbar').removeClass('bg-dark');
                }
            });
            $('.back-to-top').on("click", function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        });


    $(function() {
            for (var e = window.location, o = $(".metismenu li a").filter(function() {
                    return this.href == e
                }).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
        }), $(function() {
            $("#menu").metisMenu()
        }), $(".chat-toggle-btn").on("click", function() {
            $(".chat-wrapper").toggleClass("chat-toggled")
        }), $(".chat-toggle-btn-mobile").on("click", function() {
            $(".chat-wrapper").removeClass("chat-toggled")
        }), $(".email-toggle-btn").on("click", function() {
            $(".email-wrapper").toggleClass("email-toggled")
        }), $(".email-toggle-btn-mobile").on("click", function() {
            $(".email-wrapper").removeClass("email-toggled")
        }), $(".compose-mail-btn").on("click", function() {
            $(".compose-mail-popup").show()
        }), $(".compose-mail-close").on("click", function() {
            $(".compose-mail-popup").hide()
        }),


        $(".switcher-btn").on("click", function() {
            $(".switcher-wrapper").toggleClass("switcher-toggled")
        }), $(".close-switcher").on("click", function() {
            $(".switcher-wrapper").removeClass("switcher-toggled")
        }),


        $('#theme1').click(theme1);
    $('#theme2').click(theme2);
    $('#theme3').click(theme3);
    $('#theme4').click(theme4);
    $('#theme5').click(theme5);
    $('#theme6').click(theme6);
    $('#theme7').click(theme7);
    $('#theme8').click(theme8);
    $('#theme9').click(theme9);
    $('#theme10').click(theme10);
    $('#theme11').click(theme11);
    $('#theme12').click(theme12);
    $('#theme13').click(theme13);
    $('#theme14').click(theme14);
    $('#theme15').click(theme15);

    function theme1() {
        $('body').attr('class', 'bg-theme bg-theme1');
    }

    function theme2() {
        $('body').attr('class', 'bg-theme bg-theme2');
    }

    function theme3() {
        $('body').attr('class', 'bg-theme bg-theme3');
    }

    function theme4() {
        $('body').attr('class', 'bg-theme bg-theme4');
    }

    function theme5() {
        $('body').attr('class', 'bg-theme bg-theme5');
    }

    function theme6() {
        $('body').attr('class', 'bg-theme bg-theme6');
    }

    function theme7() {
        $('body').attr('class', 'bg-theme bg-theme7');
    }

    function theme8() {
        $('body').attr('class', 'bg-theme bg-theme8');
    }

    function theme9() {
        $('body').attr('class', 'bg-theme bg-theme9');
    }

    function theme10() {
        $('body').attr('class', 'bg-theme bg-theme10');
    }

    function theme11() {
        $('body').attr('class', 'bg-theme bg-theme11');
    }

    function theme12() {
        $('body').attr('class', 'bg-theme bg-theme12');
    }

    function theme13() {
        $('body').attr('class', 'bg-theme bg-theme13');
    }

    function theme14() {
        $('body').attr('class', 'bg-theme bg-theme14');
    }

    function theme15() {
        $('body').attr('class', 'bg-theme bg-theme15');
    }



    $("#check-all").click(function(e) {
        $(this).toggleClass("checked");
        let index = Number($(this).hasClass("checked"));
        $("input[type='checkbox']").prop("checked", index);
        return false;
    })

});