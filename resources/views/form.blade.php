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
            <input type="text" class="mt-1 p-2 border rounded-md w-full" id="name" name="name" value="{{ isset($product) ? $product->naam : old('name') }}">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea class="mt-1 p-2 border rounded-md w-full" id="description" name="description">{{ isset($product) ? $product->beschrijving : old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" class="mt-1 p-2 border rounded-md w-full" id="price" name="price" value="{{ isset($product) ? $product->prijs : old('price') }}">
        </div>
        <div class="mb-4">
            <label for="discount" class="block text-sm font-medium text-gray-700">Discount (%)</label>
            <input type="number" name="discount" id="discount" class="mt-1 p-2 border rounded-md w-full" step="0.01" min="0" max="100" value="{{ isset($product) ? $product->korting : old('discount') }}">
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
            <input type="file" name="image" id="image" class="mt-1 p-2 border rounded-md w-full">
            @if (isset($product) && $product->images)
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
            <button type="button" class="mt-2 bg-green-500 text-white px-3 py-1 rounded" id="addCategoryBtn">Add Category</button>
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
<!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Add New Category</h2>
        <form id="categoryFormModal" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="newCategory" class="block font-medium text-gray-700">Category Name</label>
                <input type="text" name="newCategory" id="newCategory" class="mt-1 p-2 border rounded-md w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Add Category</button>
            <button type="button" class="bg-gray-300 text-gray-700 px-3 py-1 rounded ml-2" id="closeModal">Cancel</button>
        </form>
    </div>
</div>
<script>
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const addCategoryModal = document.getElementById('addCategoryModal');
    const closeModalBtn = document.getElementById('closeModal');
    const categoryFormModal = document.getElementById('categoryFormModal');

    addCategoryBtn.addEventListener('click', () => {
        addCategoryModal.classList.remove('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
        addCategoryModal.classList.add('hidden');
        categoryFormModal.reset(); // Reset the form when closing the modal
    });
</script>
</body>
</html>
