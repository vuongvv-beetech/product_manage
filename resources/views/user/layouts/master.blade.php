<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" type="text/css" href="{{asset('develop\css\bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('develop\css\bootstrap-theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist\css\adminlte.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist\fontawesome-free\css\all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist\flag-icon-css\css\flag-icon.min.css')}}">
    @yield('css')
   
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
    @include('user.layouts.header')

    <!-- Sidebar -->
    @include('user.layouts.sidebar')
    
    <div class="content-wrapper" style="min-height: 322px;">
        @yield('content')
    </div>
    <!-- Footer -->
    @include('user.layouts.footer')

</div><!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('dist\jquery\jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dist\bootstrap\js\bootstrap.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('dist\bootstrap\js\bootstrap.bundle.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('dist\overlayScrollbars\js\jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist\js\adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist\js\demo.js')}}"></script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

<script src="{{asset('sweetalert2.min.css')}}"></script>
<script src="{{asset('sweetalert2.min.js')}}"></script>

{{-- Validate Jquery --}}
{{-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script> --}}
{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script> --}}
{{-- <script src="{{asset('dist/jquery/jquery.validate.min.js')}}"></script> --}}


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
//Go Back
function OpenProduct() {
            var i = $('.avatar img');
            var lbi = $('.lightbox-blanket .product-avatar img');
            console.log($(i).attr("src"));
            $(lbi).attr("src", $(i).attr("src"));

            var name = document.getElementById("name").value;
            var sku = document.getElementById("sku").value;
            var stock = document.getElementById("stock").value;
            var category = document.getElementById("category").selectedOptions[0].text;

            $(".lightbox-blanket").toggle();

            document.getElementById("product-name").innerHTML = name;
            document.getElementById("product-sku").innerHTML = sku;
            document.getElementById("product-stock").innerHTML = "Stock:" + stock;
            document.getElementById("product-category").innerHTML = "Category: " + category;

        }

function GoBack(){
  $(".lightbox-blanket").toggle();
}
$('#imageUpload').change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#previewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
</script>
@yield('script')
</body>
</html>