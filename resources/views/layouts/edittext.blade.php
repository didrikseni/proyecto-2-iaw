@extends('layouts.app')

@section('head')
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

    <script src='https://cdn.tiny.cloud/1/3yn19ck0mgv6qus3qkej8vrfp9x3q45am4ikvprcke9nzs7q/tinymce/5/tinymce.min.js'
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            toolbar_mode: 'floating',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            plugins: 'autoresize | image imagetools',
            min_height: 600,
            images_upload_handler: function (blobInfo, success, failure) {
                let xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/article/upload/image');
                xhr.setRequestHeader("X-CSRF-Token", '{{ csrf_token() }}');
                xhr.onload = function() {
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
