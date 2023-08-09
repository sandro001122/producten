<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <!-- Add the following link to include Tailwind CSS stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="p-6">
    <h1 class="text-2xl font-bold">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" class="mt-1 p-2 border rounded-md w-full" id="name" name="name" value="{{ isset($product) ? $product->naam : old('naam') }}">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea class="mt-1 p-2 border rounded-md w-full" id="description" name="description">{{ isset($product) ? $product->beschrijving : old('beschrijving') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" class="mt-1 p-2 border rounded-md w-full" id="price" name="price" value="{{ isset($product) ? $product->prijs : old('prijs') }}">
        </div>
        <div class="form-group">
            <label for="discount">Discount (%)</label>
            <input type="number" name="discount" id="discount" class="form-control" step="0.01" min="0" max="100" value="{{ isset($product) ? $product->korting : '' }}">
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($product->images)
                <p class="mt-2">Current Image: <img src="{{ asset('images/' . $product->images) }}" alt="Current Product Image" class="max-w-xs"></p>
            @endif
        </div>
        <div class="mb-4">
            <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
            <select name="categories[]" id="categories" class="mt-1 p-2 border rounded-md w-full" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($product) && in_array($category->id, $product->categorieen->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $category->naam }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <input type="text" name="tags_input" id="tags_input" class="mt-1 p-2 border rounded-md w-full" placeholder="Enter tags">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Existing Tags:</label>
            <div class="mt-1">
                @foreach($tags as $tag)
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            {{ isset($product) && in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $tag->naam }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">{{ isset($product) ? 'Update' : 'Add' }}</button>
    </form>
</div>
</body>
</html>
