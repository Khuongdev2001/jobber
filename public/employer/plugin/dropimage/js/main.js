/** 
 * @param {*} object 
 *  id_preview
 *  model_preview
 *  btn_drop
 *  producted
 *  preview_mini
 *  input
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
                $(object.producted).attr("src", base64data);
                $(object.model_preview).modal('hide');
            };
        });
    });

}