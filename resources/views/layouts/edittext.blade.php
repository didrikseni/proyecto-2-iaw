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
            toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent | image link table | pagebreak | preview',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern autoresize"
            ],
            min_height: 600,
            /*
                images_upload_handler: function (blobInfo, success, failure) {
                console.log('ESTA ENTRANDO EN IMAGE UPLOAD HANDLER');
                var xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/articles/image/upload');
                xhr.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");
                xhr.onload = function() {
                    if (xhr.status !== 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    console.log(xhr.responseText);
                    var json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                var description = '';
                jQuery(tinymce.activeEditor.dom.getRoot()).find('img').not('.loaded-before').each(
                    function() {
                        description = $(this).attr("alt");
                        $(this).addClass('loaded-before');
                    });
                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('description', description);
                xhr.send(formData);
            },
            file_picker_callback: function(cb, value, meta) {
                console.log('ESTA ENTRANDO EN FILE PICKER CALLBACK');
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];
                    var id = file.name;
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file);
                    blobCache.add(blobInfo);
                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                input.click();
            }*/
        });
    </script>

    <script src="{{ asset('js/tinymce.js') }}"></script>
@endsection
