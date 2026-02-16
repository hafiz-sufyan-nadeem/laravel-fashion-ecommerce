@extends('admin.products.layout')

@section('content')

    <div class="card mt-5" xmlns="http://www.w3.org/1999/html">
        <h2 class="card-header">Add New Product</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.products.index') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="inputName" class="form-label"><strong>Name:</strong></label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        id="inputName"
                        placeholder="Name">
                    @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label"><strong>Category:</strong></label>
                    <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Price:</strong></label>
                    <input type="number" step="0.01" name="price"
                           value="{{ $product->price }}"
                           class="form-control"
                           id="inputPrice"
                           placeholder="Price">
                    @error('price')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label><strong>On Sale?</strong></label>
                    <input type="checkbox" name="on_sale" value="1"
                        {{ $product->on_sale ? 'checked' : '' }}>
                </div>

                <div class="mb-3">
                    <label><strong>Sale Price:</strong></label>
                    <input type="number" step="0.01" name="sale_price"
                           class="form-control"
                           value="{{ $product->sale_price }}"
                           placeholder="Sale Price (optional)">
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Description:</strong></label>
                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                    @error('description')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="form-label"><strong>Image:</strong></label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Stock:</strong></label>
                    <select name="stock" class="form-control">
                        <option value="1" @selected($product->stock == 1)>In Stock</option>
                        <option value="0" @selected($product->stock == 0)>Out of Stock</option>
                    </select>
                    @error('stock')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Quantity:</strong></label>
                    <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
                    @error('quantity')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
@endsection
