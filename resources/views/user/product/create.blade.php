@extends('user.layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('develop/css/avatar.css')}}">
<link rel="stylesheet" href="{{asset('develop/css/preview_product.css')}}">
@endsection
@section('title')
   <title>Thêm sản phẩm</title> 
@endsection
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('messages.add_product') }}</h1>
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
<form   method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" id="form">
@csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <div class="card card-primary">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('messages.SKU') }} *</label>
                            <input type="text" class="form-control" name="sku" id="sku" placeholder = "SKU" value="{{ old('sku')}}">
                            @if ($errors->has('sku'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('sku') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.name_product') }} *</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder = "Name" value="{{ old('name')}}">
                            @if ($errors->has('name'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('name') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.stock') }} *</label>
                            <input type="number" class="form-control" name="stock" id="stock" placeholder = "Stock" value="{{ old('stock')}}">
                            @if ($errors->has('name'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('name') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.name_category') }}</label>
                            @php
                              $categorys =  App\Helpers\Helper::getAllIdCategory();
                            @endphp
                            <select class="form-control" name="category_id" id="category">
                                @foreach($categorys as $item)
                                    <option value="{{$item->id}}" {{ request()->category_id == $item->id ? 'selected' : ''}}  >{{$item->name}}</option>
                                @endforeach
                            </select>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" >
            <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
            <button type="button" class="btn btn-primary" name="preview-product" onclick="OpenProduct();">{{ __('messages.preview') }}</button>
        </div>
        <div class="lightbox-blanket">
          <div class="pop-up-container">
              <div class="pop-up-container-vertical">
                  <div class="pop-up-wrapper">
                      <div class="go-back" onclick="GoBack();"><i class="fa fa-arrow-left"></i>
                      </div>
                      <div class="product-details">
                          <div class="product-left">
                              <div class="product-info">
                                  <div id="product-sku" class="product-manufacturer">
                                      <p>{{ __('messages.SKU') }}</p>
                                  </div>
                                  <div id="product-name" class="product-title">
                                      <p>{{ __('messages.name_product') }}</p>
                                  </div>
                              </div>
                              <div id="product-avatar" class="product-image">
                                  <img src="" id="previewImage" width="200" height="200">
                              </div>
                          </div>
                          <div class="product-right">
                              <div class="product-description">
  
                              </div>
                              <div id="product-stock" class="product-available">
                                  <p>{{ __('messages.stock') }}</p>
                              </div>
                              <div id="product-category" class="product-available">
                                  <p>{{ __('messages.category') }}</p>
                              </div>
  
                              <div class="product-rating">
                                  <i class="fa fa-star rating" star-data="1"></i>
                                  <i class="fa fa-star rating" star-data="2"></i>
                                  <i class="fa fa-star rating" star-data="3"></i>
                                  <i class="fa fa-star" star-data="4"></i>
                                  <i class="fa fa-star" star-data="5"></i>
                                  <div class="product-rating-details">(3.1 - <span class="rating-count">1203</span>
                                      reviews)
                                  </div>
  
                              </div>
                          </div>
                          <div class="product-bottom">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</form>
@endsection
@section('script')
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{asset('dist\jquery\jquery.validate.min.js')}}"></script>
<script>
    jQuery.validator.addMethod('regex', function (value) {
        var regex = /^[a-zA-Z0-9 ]+$/;
        return value.trim().match(regex);
    });
    
    $("#form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            sku:{
                required: true,
                maxlength: 20,
                minlength: 10,
                regex: true,
                remote:{
                    url: "{{route('product.checkSKU')}}",
                    type: "GET",
                    data:{   
                        sku: function() {
                            return $( "#sku" ).val(); 
                        }
                    },
                }

            },
            stock: {
                required: true,
                range: [0, 10000],
                number: true
            },
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
            name:{
                required: "Tên là trường bắt buộc",
                maxlength:  "Tên chỉ nhiều nhất  255 ký tự",
            },
            sku: {
                required: "SKU là trường bắt buộc",
                maxlength:  "SKU chỉ nhiều nhất  20 ký tự",
                minlength:" SKU tối thiểu 10 ký tự",
                regex: "SKU chỉ chứa a-z, A-Z,0-9",
                remote: "SKU đã tồn tại"
            },
            stock:{
                required: "Stock là trường bắt buộc",
                range: "Giá trị lớn hơn 0 và nhỏ hơn 10000",
                number: "Stock phải là số"
            },
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
    $("#product").attr('class','nav-link active');
</script>
@endsection
