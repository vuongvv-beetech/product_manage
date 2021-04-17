@extends('admin.layouts.master')

@section('title')
   <title>Danh sách thành viên</title> 
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>DANH SÁCH THÀNH VIÊN</h1>
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
<form method="GET" style="display:flex; margin-bottom:10px;">
    <div class="col-sm-3">
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" name="name_user"
          aria-describedby="search-addon" value="{{ request()->input('name_user', old('name_user'))}}"/>
    </div>
    <div class="col-sm-3" >
        <button type="submit" class="btn btn-outline-primary">search</button>
    </div>
   
</form>
<section class="content">
    <div class="container-fluid">
        <a href="{{route('admin.create')}}" class="btn btn-primary">Thêm Thành viên</a>
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Birthday</th>
                <th scope="col">First_name</th>
                <th scope="col">Last_name</th>
                <th scope="col">Status</th>
                <th scope="col">Created_at</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr id="id{{ $user->id }}" role="row" class ="old">
                    <td>{{ $user->id }}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->birthday}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->status}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <a href="{{route('admin.edit', $user->id)}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-danger delete-confirm"  onclick="mydelete({{ $user->id }})">Xóa</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
        {!!$users->links()!!}
        </div>
    </div>
</section>
@section('script')
<script>
    function mydelete(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        swal({
            title: "Delete?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {

                $.ajax({
                    type: 'POST',
                    url: "admin/delete/" + id,
                    data: { 
                        _token: "{{ csrf_token() }}",
                        _method: "delete"    
                    },
                    dataType: 'JSON',
                    success:function(data){
                        $('#id'+id).remove();
                        Swal.fire(
                            'Deleted!',
                            'Product has been deleted.',
                            'success'
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
    $("#member").attr('class','nav-link active');
</script>
@endsection
@stop



