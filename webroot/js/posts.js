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
                var data = new FormData();
                data.append('file', files[0]);

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
                        if (url)
                        {
                            $('#summernote').summernote('insertImage', url, 'image');
                        }
                        else
                        {
                            alert('Cannot upload the image file. (inside sucess of "onImageUpload")');
                        }
                    },
                    error : function (url)
                    {
                        alert('Cannot upload the image file. (inside error of "onImageUpload")');
                    }

                });
            },
    
            onImageUploadError : function (files)
            {
                alert('Cannot upload the image file. (inside "onImageUploadError")');
            }
        }
    
    });
});