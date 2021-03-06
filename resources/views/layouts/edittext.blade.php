@extends('layouts.app')

@section('head')
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

    <script src='https://cdn.tiny.cloud/1/3yk9ck0mgv652us3qkej8vrfp9bq45am4iksmrcke9n7i2r/tinymce/5/tinymce.min.js'
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            toolbar_mode: 'floating',
            toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent | image link table | pagebreak | preview',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            plugins: [
                "advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern autoresize"
            ],
            min_height: 600,
            images_upload_url: '/articles/image/upload',
            automatic_uploads: false,
            images_upload_handler: function (blobInfo, success, failure) {
                let xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/articles/image/upload');
                xhr.setRequestHeader("X-CSRF-Token", '{{ csrf_token() }}');
                xhr.onload = function() {
                    console.log(xhr.responseText);
                    if (xhr.status !== 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    let json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                let formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }
        });
    </script>
@endsection
