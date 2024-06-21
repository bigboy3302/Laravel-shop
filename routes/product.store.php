<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- form fields -->
    <button type="submit">Create Product</button>
</form>
