@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                @if ($edit == 1)
                    <h2>update Products</h2>
                @else
                    <h2>Create New Products</h2>
                @endif
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($edit == 1)
        {!! Form::model($products, [
            'method' => 'PATCH',
            'files' => true,
            'route' => ['products.update', $products->id],
        ]) !!}
    @else
        {!! Form::open(['route' => 'products.store', 'files' => true, 'method' => 'POST']) !!}
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product Name:</strong>
                @if ($edit == 1)
                    {!! Form::text('productname', $products->product_name, [
                        'placeholder' => 'Product Name',
                        'class' => 'form-control',
                    ]) !!}
                @else
                    {!! Form::text('productname', null, ['placeholder' => 'Product Name', 'class' => 'form-control']) !!}
                @endif

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>description:</strong>
                @if ($edit == 1)
                    {!! Form::textarea('description', $products->product_description, [
                        'placeholder' => 'Category Description',
                        'class' => 'form-control',
                    ]) !!}
                @else
                    {!! Form::textarea('description', null, ['placeholder' => 'Category Description', 'class' => 'form-control']) !!}
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product price:</strong>
                    @if ($edit == 1)
                        {!! Form::text('productprice', $products->product_price, [
                            'placeholder' => 'Product price',
                            'class' => 'form-control',
                        ]) !!}
                    @else
                        {!! Form::text('productprice', null, ['placeholder' => 'Product price', 'class' => 'form-control']) !!}
                    @endif

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}

    @endsection
