<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('develop\css\bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('develop\css\bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Hi</title>
</head>
<style>
    @font-face{
        font-family: On-I-Gothic;
        src: url("{{asset('fonts/On-I-Gothic.ttf')}}");
    }
    *{
        font-family: On-I-Gothic;
    }
    th {
        text-align: left;
    }
</style>
<body>
<p>{{ $title }}</p>
<p>{{ $date }}</p>
<table class="table table-bordered" id="laravel_crud">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Sku</th>
        <th scope="col">Name</th>
        <th scope="col">Stock</th>
        <th scope="col">Category</th>
        <th scope="col">Expired_at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr scope="row">
            <td>{{ $product->id }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->productCategory->name}}</td>
            <td>{{ date('d m Y', strtotime($product->expired_at)) }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
