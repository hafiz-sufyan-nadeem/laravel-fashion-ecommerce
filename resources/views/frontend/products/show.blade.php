<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>


<div class="container mt-3" style="margin-left: 10px">
    <h1>{{ $product->name }}</h1>
    <p>Price: {{ $product->price }}</p>
    <p>Description: {{ $product->description }}</p>
    <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" class="img-fluid">

    <br><br>

    <a href="{{ route('home') }}" class="btn btn-primary">
        Back
    </a>
</div>
