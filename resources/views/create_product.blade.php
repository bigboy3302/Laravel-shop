@extends('layouts.app')

@section('content')
<style>
  .container {
    position: relative;
    width: 40%; /* Adjust width as needed */
    min-height: 600px; /* Adjust height as needed */
    margin: 40px auto; /* Center the card vertically and horizontally */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1), 0px 6px 20px 0px rgba(0, 0, 0, 0.19); /* Subtle shadows for better design */
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(24px); /* Soft blur effect for background */
  }

  .blob {
    position: absolute;
    z-index: -1; /* Place under the form */
    top: 50%; /* Center vertically */
    left: 50%; /* Center horizontally */
    transform: translate(-50%, -50%);
    width: 300px; /* Circular background blob */
    height: 300px;
    background-color: #ff0000;
    border-radius: 50%;
    opacity: 0.6;
    filter: blur(12px);
    animation: blob-bounce 20s infinite ease; /* Gentle floating animation */
  }

  @keyframes blob-bounce {
    0%, 100% { transform: translate(-50%, -50%); }
    25% { transform: translate(-50%, -30%); }
    50% { transform: translate(-50%, -10%); }
    75% { transform: translate(-50%, -30%); }
  }

  input, textarea {
    width: 90%; /* Full width inside the container */
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); /* Inner shadow for depth */
  }

  button {
    width: 50%; /* Responsive button width */
    padding: 10px;
    margin-top: 20px;
    background-color: #4CAF50; /* Primary button color */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #45a049; /* Darker shade on hover */
  }
</style>

<div class="container">
    <div class="blob"></div> <!-- Visual flair blob -->
    <h1>Create New Product</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
