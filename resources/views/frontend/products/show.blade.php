<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>


<div class="container mt-4">
    <div class="card shadow p-4">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('storage/'.$product->image) }}"
                     alt="Product Image" class="img-fluid rounded border" style="max-height: 400px; object-fit: cover">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $product->name }}</h2>
                <p class="text-success fs-4 fw-bold">Price: {{ $product->price }}</p>
                <p  class="mt-3">Description: {{ $product->description }}</p>


                <div class="d-flex align-items-center mt-3">
                    <input type="number" min="1" value="1" class="form-control w-25 me-2">
                    <button class="btn btn-success btn-lg">
                        <i class="bi bi-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-primary mt-4">
            Back
        </a>


    </div>
</div>
