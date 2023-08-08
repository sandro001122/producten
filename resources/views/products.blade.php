    <h1>Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Categories</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->naam }}</td>
                    <td>{{ $product->beschrijving }}</td>
                    <td>{{ $product->prijs }}</td>
                    <td>{{ $product->korting }}</td>
                    <td>{{ implode(', ', $product->categorieen->pluck('naam')->toArray()) }}</td>
                    <td>{{ implode(', ', $product->tags->pluck('naam')->toArray()) }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
