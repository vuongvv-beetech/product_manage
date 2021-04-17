<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style type="text/css" media="all">
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
    #title-product{
        text-align: center;
    }
    table.timecard {
	margin: auto;
	width: 100%;
	border-collapse: collapse;
	border: 1px solid #fff;
	border-style: hidden;
    }
    table.timecard caption {
	background-color: #6c757d;
	color: #fff;
	font-size: x-large;
	font-weight: bold;
	letter-spacing: .3em;
    }
    table.timecard thead th {
	padding: 8px;
	background-color: #6c757d;
	font-size: 20px;
    } 
    table.timecard thead th#col-id {
	width: 2%;	
    }
    table.timecard thead th#col-sku, table.timecard thead th#col-name,table.timecard thead th#col-expried_at,table.timecard thead th#col-category {
	    width: 24%;
    }
    table.timecard thead th#col-stock{
        width: 2%;
    }
</style>
<body>
    <h1 id="title-product">Category Product</h2>
    <p id="date"><?php $date = getdate(); echo "Date : " .$date['mday']."/".$date['mon']."/".$date['year'];?></p>
    <table class="timecard">
        <thead>
            <tr>
                <th id="col-id">ID</th>
                <th id="col-sku">Sku</th>
                <th id="col-name">Name</th>
                <th id="col-stock">Stock</th>
            </tr>
        </thead>
        @foreach($products as $product)
        <tbody>
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->sku}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->stock}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</body>
</html>

