/**
 * Script for posts page.
 *
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @author    Kohei Koja
 */

/* Begin Summernote */
$(document).ready(function() {

    $('#summernote').summernote({
        height : 500,

        callbacks: {
            onImageUpload : function (files)
            {
                uploadFile(files[0]);
            },

            onImageUploadError : function (files)
            {
                alert('Cannot upload the image file. (inside "onImageUploadError")');
            }
        }
    });

    function uploadFile(file)
    {
        var data = new FormData();
        data.append('file', file);

        $.ajax({
            data : data,
            type : 'POST',
            url : '/posts/upload',
            cache : false,
            contentType : false,
            processData : false,
            headers : {
                'X-CSRF-Token' : csrfToken
            },
            success : function (url)
            {
                var image = $('<img>').attr('src', url);
                $('#summernote').summernote("insertNode", image[0]);
            },
            error : function (url)
            {
                alert('Cannot upload the image file. (inside error of "onImageUpload")');
            }

        });
    }
});