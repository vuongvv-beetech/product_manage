<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" type="text/css" href="{{asset('develop\css\bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('develop\css\bootstrap-theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist\css\adminlte.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist\fontawesome-free\css\all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist\flag-icon-css\css\flag-icon.min.css')}}">
    @yield('title')
    @yield('css')
    <!-- <script type="text/javascript" src="js/jquery-1.11.1.js"></script> -->
   
    <style>
    body{
        font-size: 20px;
    }
    html{
        font-size:16px;
    }
    </style>

</head>
<body>
    @include('sweetalert::alert')
<div class="wrapper">
    
    <!-- Header -->
    @include('admin.layouts.header')

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    
    <div class="content-wrapper" style="min-height: 322px;">
        @yield('content')
    </div>
    <!-- Footer -->
    @include('admin.layouts.footer')

</div><!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('dist\jquery\jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('dist\bootstrap\js\bootstrap.bundle.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('dist\overlayScrollbars\js\jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist\js\adminlte.min.js')}}"></script>

<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

<script src="{{asset('dist\jquery\jquery.validate.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('sweetalert2.min.css')}}"></script>
<script src="{{asset('sweetalert2.min.js')}}"></script>
<script src="{{asset('dist\js\demo.js')}}"></script>

<script type="text/javascript" src="{{asset('dist\bootstrap\js\bootstrap.min.js')}}"></script>
<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });

    // tinh/xa/huyen option
    function province_change(){
        var province_id = $("#province").val();
        $.ajax({
            type: 'GET',
            url: '/admin/district/'+ province_id,
            cache: false,
            success: function (data) {
                var $district = $('#district');
                $('#district').empty();
                $district.append('<option value="">--Quận/Huyện--</option>')
                $('#commune').empty();
                $('#commune').append('<option value="">--Xã/Phường/Thị trấn--</option>')
                for (var i = 0; i < data.length; i++) {
                    $district.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
                }
            }
        });
    }
    function district_change(){
        var district_id = $("#district").val();
        $.ajax({
            type: 'GET',
            url: '/admin/commune/'+ district_id,
            success: function (data) {
                var $commune = $('#commune');
                $('#commune').empty();
                $commune.append('<option value="">--Xã/Phường/Thị trấn--</option>')
                for (var i = 0; i < data.length; i++) {
                    $commune.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
                }
            }
        });
    }
</script>
@yield('script')
</body>
</html>