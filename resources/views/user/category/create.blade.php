@extends('user.layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('develop/css/avatar.css')}}">
<link rel="stylesheet" href="{{asset('develop/css/preview_product.css')}}">
@endsection('css')
@section('title')
   <title>Thêm danh mục</title> 
@endsection
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('messages.category') }}</h1>
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
<form   method="POST" action="{{ route('category.store') }}" id="form">
@csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        {{-- <h3 class="card-title">Quick Example</h3> --}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                        <label>{{ __('messages.name_category') }} *</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder = "name" value="{{ old('name')}}">
                        {{-- @if ($errors->has('name'))
                            <div>
                                <ul>
                                    <li style="color:red;">{{ $errors->first('name') }}</li>
                                </ul>
                            </div>
                        @endif --}}
                        </div>
                        <div class="form-group">
                        <label>{{ __('messages.parent') }} *</label>
                        @php
                            $categorys =  App\Helpers\Helper::getIdCategory();
                        @endphp
                        <select class="form-control" id="exampleFormControlSelect1" name="parent_id">
                            <option value="NULL">--choose option--</option>
                            @foreach($categorys as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
    </div>
</form>
@endsection
@section('script')
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{asset('dist\jquery\jquery.validate.min.js')}}"></script>
<script>
    $("#form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
           
        },

        messages: {
            name:{
                required: "Tên là trường bắt buộc",
                maxlength:  "Tên chỉ nhiều nhất 255 ký tự",
            },
        },
        errorElement: 'div',
        submitHandler: function(form) {
            form.submit();
        }
    });
    $(".active").attr('class','nav-link');
    $("#category").attr('class','nav-link active');
</script>
@endsection
