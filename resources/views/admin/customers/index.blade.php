@extends('admin.layouts.app')

@section('content')
    <form method="GET" action="{{ route('admin.customers.index') }}" class="mb-3 ml-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or email" class="form-control w-25 d-inline">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Customers</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td><a href="{{ route('admin.customers.show', $customer->id) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $customers->links('pagination::bootstrap-4') }}

                </div>

            </div>
        </div>
    </div>
@endsection
