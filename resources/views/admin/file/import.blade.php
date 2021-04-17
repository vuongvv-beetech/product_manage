@extends('admin.layouts.master')

@section('title')
   <title>Thêm file</title> 
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>THÊM FILE</h1>
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
<form method="POST" action="{{ route('admin.add') }}">
    @csrf
    <div class="form-group " style="margin-bottom: -2px;">
        <button type="submit" class="btn btn-primary">File</button>
    </div>
</form>
@section('script')
<script>
    $(".active").attr('class','nav-link');
    $("#import").attr('class','nav-link active');
</script>
@endsection
@stop