<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ asset('/source/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/source/css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('/source/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/source/css/toastr.min.css') }}">
    <!-- Select2 core CSS -->
    <link href="{{ asset('/source/css/select2.min.css') }}" rel="stylesheet" />

    <!-- Theme Bootstrap 5 -->
    <link href="{{ asset('/source/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />


</head>

<body>
    @include('admin.header')
    <!-- ======= Sidebar ======= -->
    @include('admin.siderbar')  
    <!-- End Sidebar-->
    <main id="main" class="main">

        @yield('content')

    </main>


    @include('admin.footer')



    <script src="{{ asset('/source/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('/source/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('/source/js/main.js') }}"></script>
    <script src="{{ asset('/source/js/toastr.min.js') }}"></script>

    <script src="{{ asset('/source/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
         tinymce.init({
             selector: '#tyni',
             plugins: 'advlist autolink lists link charmap preview anchor table image',
             toolbar: 'undo redo | formatselect | ' +
                 'bold italic backcolor | alignleft aligncenter ' +
                 'alignright alignjustify | bullist numlist outdent indent | ' +
                 'removeformat | help | table | link image | blocks fontfamily fontsize',
             images_upload_url: "/admin/upload-image",
             relative_urls: false,
             document_base_url: "{{ url('/') }}",
             automatic_uploads: true,
             setup: function(editor) {
                 editor.on('NodeChange', function(event) {
                     const currentImages = Array.from(editor.getDoc().querySelectorAll('img')).map(img =>
                         img.src);
 
                     if (!editor.oldImages) editor.oldImages = currentImages;
 
                     const removedImages = editor.oldImages.filter(img => !currentImages.includes(img));
                     editor.oldImages = currentImages;
 
                     removedImages.forEach(imageUrl => {
                         fetch('/admin/delete-image', {
                                 method: 'POST',
                                 headers: {
                                     'Content-Type': 'application/json'
                                 },
                                 body: JSON.stringify({
                                     image: imageUrl
                                 })
                             })
                             .then(response => response.json())
                             .then(data => console.log(data.message))
                             .catch(error => console.error('Lỗi khi xóa ảnh:', error));
                     });
                 });
             }
         })
     </script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>
    <script src="{{ asset('/source/js/select2.min.js') }}"></script>
    <script src="{{ asset('/source/js/style.js') }}"></script>
</body>

</html>
