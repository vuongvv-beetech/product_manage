@extends('admin.layouts.master')
@section('title')
   <title>Thêm thành viên</title> 
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('develop\css\avatar.css')}}">
@endsection('css')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>THÊM THÀNH VIÊN</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Layout</a></li>
            <li class="breadcrumb-item active">Fixed Layout</li>
            </ol>
        </div>
        </div>
    </div>
</section>
<form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" id="form">
@csrf
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                    <div class="card-header">
                        {{-- <h3 class="card-title">Quick Example</h3> --}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email" >Email address *</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('email') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name" >Name *</label>
                            <input type="text" class="form-control"  id="name" name="name" placeholder = "Name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('name') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="firstname">First name *</label>
                            <input type="text" class="form-control"  id="firstname" name="firstname" placeholder = "Frstname" value="{{ old('firstname') }}">
                            @if ($errors->has('firstname'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('firstname') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last name *</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder = "lastname" value="{{ old('lastname') }}">
                            @if ($errors->has('lastname'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('lastname') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday *</label>
                            <input type="date" class="form-control" id ="birthday" name="birthday" placeholder = "Birthday" value="{!! old('birthday') !!}">
                            @if ($errors->has('birthday'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('birthday') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                <option value="1">ACTIVE</option>
                                <option value="0">ĐANG CHỜ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address </label>
                            <input type="text" class="form-control" name="address" placeholder = "Address" value="{{ old('address') }}">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                    <div class="card-header">
                        {{-- <h3 class="card-title">Quick Example</h3> --}}
                    </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="province">Tỉnh *</label>
                                <select class="form-control" id="province" name="province" onchange="province_change()">
                                    <option value="">--Tỉnh/Thành phố--</option>
                                    @foreach($provinces as $item)
                                        <option value="{{$item->id}}" {{ old('province') == $item->id ? 'selected' : '' }} >{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('province'))
                                    <div>
                                        <ul>
                                            <li style="color:red;">{{ $errors->first('province') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="district">Quận/Huyện *</label>
                                <select class="form-control" id="district" name="district" onchange="district_change()">
                                    <option value="">--Quận/Huyện--</option>
                                </select>
                                @if ($errors->has('district'))
                                    <div>
                                        <ul>
                                            <li style="color:red;">{{ $errors->first('district') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="commune">Xã/Phường/Thị trấn *</label>
                                <select class="form-control" id="commune" name="commune">
                                    <option value="">--Xã/Phường/Thị trấn--</option>
                                </select>
                                @if ($errors->has('commune'))
                                    <div>
                                        <ul>
                                            <li style="color:red;">{{ $errors->first('commune') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Avatar *</label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type ='file' id="imageUpload" name="avatar"  style="opacity:0;height:0px;width:0px; display: block !important" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                        </div>
                                    </div>
                                    @if ($errors->has('avatar'))
                                        <div>
                                            <ul>
                                                <li style="color:red;">{{ $errors->first('avatar') }}</li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div id="error" style="text-align: center;"></div>
                            </div>
                            <div class="form-group " style="margin-bottom: -2px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection
@section('script')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
     $(document).ready(function(){
        $('#form').on('submit', function(e) {
            e.preventDefault();
            return false;
        })
        var old_district = "{{ old('district') }}";
        var old_commune = "{{ old('commune')}}";

        var province_id = $("#province").val();
        var district_id = $("#district").val();

        if(province_id){
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
                    if(data[i].id == old_district)
                        $district.append('<option value=' + data[i].id  +' selected >' + data[i].name + '</option>');
                    else
                        $district.append('<option value=' + data[i].id  +'>' + data[i].name + '</option>');
                    }
                }
            });
        }
        if(old_district){
            $.ajax({
            type: 'GET',
            url: '/admin/commune/'+ old_district,
            success: function (data) {
                var $commune = $('#commune');
                $('#commune').empty();
                $('#commune').append('<option value="">--Xã/Phường/Thị trấn--</option>')
                for (var i = 0; i < data.length; i++) {
                    if(data[i].id == old_commune)
                        $commune.append('<option value=' + data[i].id  +' selected >' + data[i].name + '</option>');
                    else
                        $commune.append('<option value=' + data[i].id  +'>' + data[i].name + '</option>');
                }
            }
        });
        }
        
        if(old_commune){
            $.ajax({
            type: 'GET',
            url: '/admin/commune/'+ old_district,
            success: function (data) {
                var $commune = $('#commune');
                $('#commune').empty();
                for (var i = 0; i < data.length; i++) {
                    if(data[i].id == old_commune)
                        $commune.append('<option value=' + data[i].id  +' selected >' + data[i].name + '</option>');
                    else
                        $commune.append('<option value=' + data[i].id  +'>' + data[i].name + '</option>');
                }
            }
        });
        }
        
    });
    $.validator.addMethod("minAge", function(value, element, min) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();
    
        if (age > min+1) { return true; }
    
        var m = today.getMonth() - birthDate.getMonth();
    
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }
    
        return age >= min;
    }, "You are not old enough!");
    
    $("#form").validate({
        rules: {
            email: {
                required: true,
                email: true,
                maxlength: 100,
                remote:{
                    url: "{{route('user.get-mail')}}",
                    type: "GET",
                    data:{   
                        email: function() {
                            return $( "#email" ).val(); 
                        }
                    },
                }
            },
            name: {
                required: true,
                maxlength: 50,
            },
            firstname:{
                required: true,
                maxlength: 50,
            },
            lastname: {
                required: true,
                maxlength: 50,
            },
            birthday:{
                required: true,
                minAge: 18,
            },
            province:"required",
            district:"required",
            commune:"required",
            avatar: {
                required: true,
                extension: "jpg|jpeg|png|JPG|JPEG|PNG",
                filesize: 3145728,
            },
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "avatar") {
                error.appendTo("#error");
            } else {
                error.insertAfter(element)
            }
        },
        messages: {
            email:{
                required: "Email là trường bắt buộc",
                email: "Email không đúng định dạng",
                maxlength: "Email chỉ nhiều nhất  100 ký tự",
                remote:"User đã tồn tại",
            },
            name:{
                required: "Tên là trường bắt buộc",
                maxlength:  "Tên chỉ nhiều nhất  50 ký tự",
            },
            firstname: {
                required: "Firstname là trường bắt buộc",
                maxlength:  "Firstname chỉ nhiều nhất  50 ký tự",
            },
            lastname: {
                required: "Lastname là trường bắt buộc",
                maxlength:  "Lastname chỉ nhiều nhất 50 ký tự",
            },
            birthday:{
                required: "Ngày sinh là trường bắt buộc",
                minAge: "Bạn chưa đủ 18 tuổi",
            },
            province:"Tỉnh là trường bắt buộc",
            district:"Huyện là trường bắt buộc",
            commune:"Xã là trường bắt buộc",
            avatar:{
                required: "Avatar là trường bắt buộc",
                extension: "File có định dạng JPG,JPEG,PNG",
                filesize:"Kích thước ảnh nhỏ hơn 3MB",
            },
        },
        errorElement: 'div',
        submitHandler: function(form) {
           
            form.submit();
        }
    });
    $(".active").attr('class','nav-link');
    $("#member").attr('class','nav-link active');
</script>
@endsection
