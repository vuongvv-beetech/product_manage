@extends('user.layouts.master')
@section('title')
   <title>Sản phẩm</title> 
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('messages.sidebar_product') }}</h1>
            </div>
           
        </div>
    </div>
</section>
<form method="GET" style="display:flex; margin-bottom:10px;">
    <div class="col-sm-3">
        <label for="status">{{ __('messages.name_product') }}</label>
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" name="name_product"
          aria-describedby="search-addon" value="{{ request()->input('name_product')}}"/>
    </div>
    <div class="col-sm-3">
        <label for="status">{{ __('messages.stock') }}</label>
        <select class="form-control" id="exampleFormControlSelect1" name="stock">
            <option value="">{{ __('messages.choose') }}</option>
            <option value="0,10" {{ request()->stock == "0,10" ? 'selected' : ''}}> < 10</option>
            <option value="10,100"  {{ request()->stock == "10,100" ? 'selected' : ''}}>10-100</option>
            <option value="100,200" {{ request()->stock == "100,200" ? 'selected' : ''}}>100-200</option>
            <option value="200,9999" {{ request()->stock == "200,9999" ? 'selected' : ''}}>> 200</option>
        </select>
    </div>
    <div class="col-sm-3" style="padding-top: 37px;">
        <button type="submit" class="btn btn-outline-primary">{{ __('messages.search') }}</button>
    </div>
   
</form>

<a href="{{route('product.create')}}" class="btn btn-primary">{{ __('messages.add_product') }}</a>
<div class="mb-4" style="float: right">
    <a class="btn btn-primary" href="{{ route('product.exportPDF')}}">{{ __('messages.exportPDF') }}</a>
    <a class="btn btn-primary" href="{{ route('product.exportCSV')}}">{{ __('messages.exportCSV') }}</a>
</div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">{{ __('messages.SKU') }}</th>
            <th scope="col">{{ __('messages.name_product') }}</th>
            <th scope="col">{{ __('messages.stock') }}</th>
            <th scope="col">AVATAR</th>
            <th scope="col">{{ __('messages.category') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        @php
            $categorys =  App\Helpers\Helper::getNameByIdCategory($product->catrgory_id);
        @endphp
            <tr id="id{{ $product->id }}">
                <td>{{$product->id }}</td>
                <td>{{$product->sku}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->avatar}}</td>
                <td>{{$categorys}}</td>
                <td>
                    <a href="{{route('product.edit', $product->id)}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> {{ __('messages.edit') }}</a>
                </td>
                <td>
                    <button type="submit" class="btn btn-danger delete-confirm"  onclick="mydelete_product({{ $product->id }})">{{ __('messages.delete') }}</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
    {!!$products->appends(
        [
            'name_product'=> request()->name_product,
            'stock' => request()->stock
        ]
    )->links()!!}
</div>
@section('script')
<script>
    function mydelete_product(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        swal({
            title: "{{__('messages.delete_product')}}",
            text: "{{__('messages.confirm')}}",
            type: "{{__('messages.warning')}}",
            showCancelButton: !0,
            confirmButtonText: "{{__('messages.yes')}}",
            cancelButtonText: "{{__('messages.no')}}",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {

                $.ajax({
                    type: 'POST',
                    url: "product/delete/" + id,
                    data: { 
                        _token: "{{ csrf_token() }}",
                        _method: "delete"    
                    },
                    dataType: 'JSON',
                    success:function(data){
                        $('#id'+id).remove();
                        Swal.fire(
                            '{{__('messages.delete_product')}}',
                            '{{__('messages.success')}}'
                            );
                    },
                    error:function(data){
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Something went wrong!',
                            });
                        }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
    $(".active").attr('class','nav-link');
    $("#product").attr('class','nav-link active');
</script>
@endsection
@stop



