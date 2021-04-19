/** 
 * @param {*} object 
 *  id_preview
 *  model_preview
 *  btn_drop
 *  producted
 *  preview_mini
 *  input
 *  ratio
 *  ajax
 *  _token 
 *  producted
 */

function crop_image(object) {
    var image = document.getElementById(object.id_preview);
    var cropper;
    $(object.input).change(function(event) {
        var files = event.target.files;
        var done = function(url) {
            image.src = url;
            $(object.model_preview).modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $(object.model_preview).on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: object.ratio || 1,
            viewMode: 3,
            preview: object.preview_mini
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $(object.btn_drop).click(function() {
        // loading
        addLoading()
        canvas = cropper.getCroppedCanvas({
            width: object.width || 400,
            height: object.height || 400
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                if (object.ajax) {
                    $.post(object.url_post, { thumbnail: base64data, _token: object._token }, function(data) {
                        // remove loading
                        removeLoading();
                        if (!data.status) {
                            error_noti({ title: "Thông báo", message: data.message || "Lỗi đường truyền mạng" })
                            return;
                        }
                        success_noti({ title: "Thông báo", message: data.message })
                        $(object.producted).attr("src", data.data.thumbnail);
                        $(object.model_preview).modal('hide');
                    });
                    return;
                }
                $(object.hidden_file).val(base64data);
                $(object.producted).attr("src", base64data);
                $(object.model_preview).modal('hide');
            };
        });
    });

}