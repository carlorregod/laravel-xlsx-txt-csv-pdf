@extends('layout')

@section('content')

<body>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Stock</th>
            </tr>                            
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td class="text-right">{{ $product->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection