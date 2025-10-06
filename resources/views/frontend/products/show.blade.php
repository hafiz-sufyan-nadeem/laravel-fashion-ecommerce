<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

@if(session('success'))
    <div class="success-alert alert alert-success text-center"
         style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                z-index: 9999; width: auto; min-width: 300px;">
        {{ session('success') }}
    </div>
@endif

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

                <div class="btn_main">
                    @if($product->quantity <= 0)
                        <!-- If product is out of stock -->
                        <button class="btn btn-secondary btn-lg" disabled>
                            <i class="bi bi-x-circle"></i> Out of Stock
                        </button>
                    @else
                        <!-- Product is in stock -->
                        @if(auth()->check())
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <div class="d-flex align-items-center mt-3">
                                    <input type="number" name="quantity" min="1" value="1" max="{{ $product->quantity }}" class="form-control w-25 me-2">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-cart"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-warning">Login to Buy</a>
                        @endif
                    @endif
                </div>
            </div>

            </div>

        <a href="{{ route('home') }}" class="btn btn-primary mt-4">
            Back
        </a>


    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.querySelectorAll('.success-alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 3000); // 3000 ms = 3 seconds
    });
</script>
