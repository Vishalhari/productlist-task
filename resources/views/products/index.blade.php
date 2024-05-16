@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
            <form method="post" action="/products/search">
                @csrf
                <input type="text" name="search" placeholder="Enter product name...">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $key => $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->product_name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['products.destroy', $product->id],
                        'style' => 'display:inline',
                    ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {!! $products->render() !!}
@endsection
