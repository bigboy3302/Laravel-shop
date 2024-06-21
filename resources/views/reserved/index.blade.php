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
        height: 350px;
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
        border-radius: 15px; /* Add some rounding to the images */
    }

    .btn {
        margin-top: 10px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    .btn-warning {
        background-color: #f0ad4e;
        color: white;
    }

    .btn-warning:hover {
        background-color: #ec971f;
    }

    .empty-message {
        text-align: center;
        color: white;
        font-size: 24px;
        margin-top: 50px;
    }
</style>

<div class="container">
   
    @if(session('reserved') && count(session('reserved')) > 0)
        <div class="card-container">
            @foreach(session('reserved') as $id => $details)
                <div class="card">
                    @if(isset($details['image']))
                        <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Placeholder" class="img-fluid">
                    @endif
                    <h5>{{ $details['name'] }}</h5>
                    <p>Reserved Quantity: {{ $details['quantity'] }}</p>
                    <p>Price: ${{ $details['price'] }}</p>
                    <form action="{{ route('reserve.cancel', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">Cancel Reservation</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p class="empty-message">No products reserved.</p>
    @endif
</div>
@endsection
