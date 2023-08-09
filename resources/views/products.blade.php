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
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Add New Product</a>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Image</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Price</th>
                <th class="px-4 py-2 text-left">Discount</th>
                <th class="px-4 py-2 text-left">Categories</th>
                <th class="px-4 py-2 text-left">Tags</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="px-4 py-2">
                        @if($product->images)
                            <img src="{{ asset('images/' . $product->images) }}" alt="Product Image" class="max-w-xs">
                        @else
                            No Image
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $product->naam }}</td>
                    <td class="px-4 py-2">{{ $product->beschrijving }}</td>
                    <td class="px-4 py-2">{{ $product->prijs }}</td>
                    <td>{{ $product->korting ? $product->korting . '%' : 'No discount' }}</td>
                    <td class="px-4 py-2">{{ implode(', ', $product->categorieen->pluck('naam')->toArray()) }}</td>
                    <td class="px-4 py-2">{{ implode(', ', $product->tags->pluck('naam')->toArray()) }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 text-white py-1 px-2 rounded mr-2">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
