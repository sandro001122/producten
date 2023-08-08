    <h1>{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($product) ? $product->naam : old('naam') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ isset($product) ? $product->beschrijving : old('beschrijving') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ isset($product) ? $product->prijs : old('prijs') }}">
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ isset($product) ? $product->korting : old('korting') }}">
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select name="categories[]" id="categories" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($product) && in_array($category->id, $product->categorieen->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $category->naam }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Add fields for categories and tags selection here -->
        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Add' }}</button>
    </form>
