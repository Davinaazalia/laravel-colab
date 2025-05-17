<h1>List of Products</h1>

{{-- Tautan untuk tambah produk --}}
<a href="{{ url('/products/create') }}">➕ Add Product</a>

{{-- Pesan sukses jika ada --}}
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>${{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ url('/products', $product->id) }}">View</a>
                <a href="{{ url('/products/'.$product->id.'/edit') }}">Edit</a> 
                <form action="{{ url('/products', $product->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<h3>Expensive Products (Price > 1M)</h3>
<ul>
    @foreach ($expensiveProducts as $product)
        <li>{{ $product->name }} - Price: {{ number_format($product->price) }}</li>
    @endforeach
</ul>

<h3>Statistics</h3>
<p><b>Average Price:</b> {{ number_format($averagePrice, 2) }}</p>

