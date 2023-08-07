@extends('layouts.app')

@section('content')
    <h1>{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($product) ? $product->name : old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ isset($product) ? $product->description : old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ isset($product) ? $product->price : old('price') }}">
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ isset($product) ? $product->discount : old('discount') }}">
        </div>
        <!-- Add fields for categories and tags selection here -->
        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Add' }}</button>
    </form>
@endsection
