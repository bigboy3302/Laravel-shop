@extends('layouts.app')

@section('content')
<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        width: 250px;
        height: 400px;
        background: linear-gradient(45deg, #ff9a9e, #fad0c4, #fad0c4, #ffd1ff, #fbc2eb, #a18cd1, #fad0c4);
        background-size: 600% 600%;
        border-radius: 20px;
        transition: all .3s;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        animation: gradientBG 10s ease infinite;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .card:hover {
        box-shadow: 0px 0px 30px 1px rgba(0, 255, 117, 0.30);
        transform: scale(1.05);
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
    }

    .btn {
        margin-top: 5px;
        padding: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    .btn-cart {
        background-color: #28a745;
        color: white;
    }

    .btn-cart:hover {
        background-color: #218838;
    }

    .btn-reserve {
        background-color: #ffc107;
        color: white;
    }

    .btn-reserve:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
</style>

<div class="container">
    <h1>Products</h1>
    <div class="card-container">
        @foreach ($products as $product)
            <div class="card">
                @if(isset($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                @else
                    <img src="https://via.placeholder.com/150" alt="Placeholder" class="img-fluid">
                @endif
                <h5>{{ $product->name }}</h5>
                <p>{{ $product->description }}</p>
                <p>Price: ${{ $product->price }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-cart">Add to Cart</button>
                </form>
                <form action="{{ route('products.reserve', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-reserve">Reserve</button>
                </form>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
