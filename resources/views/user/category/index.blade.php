@extends('user.layouts.master')
@section('title')
   <title>Danh mục</title> 
@endsection

@section('content')
    <a href="{{route('category.create')}}" class="btn btn-primary">{{ __('messages.category') }}</a>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">{{ __('messages.id_category') }}</th>
            <th scope="col">{{ __('messages.name_category') }}</th>
            <th scope="col">{{ __('messages.parent') }}</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categorys as $category)
            <tr id="id{{$category->id}}">
                <td>{{ $category->id }}</td>
                <td>{{ $category->name}}</td>
                <td>{{ !empty($category->productCategory->name) ? $category->productCategory->name : "" }}</td>
                <td>
                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> {{ __('messages.edit') }}</a>
                </td>
                <td>
                    <button type="submit" class="btn btn-danger delete-confirm"  onclick="mydelete_category({{ $category->id }})">{{ __('messages.delete') }}</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
    {{$categorys->links()}}
    </div>
@section('script')
<script>
    function mydelete_category(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        swal({
            title: "{{__('messages.delete_category')}}",
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
                    url: "category/delete/" + id,
                    data: { 
                        _token: "{{ csrf_token() }}",
                        _method: "delete"    
                    },
                    dataType: 'JSON',
                    success:function(data){
                        $('#id'+id).remove();
                        Swal.fire(
                            '{{__('messages.delete_category')}}',
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
    $("#category").attr('class','nav-link active');
</script>
@endsection
@stop



