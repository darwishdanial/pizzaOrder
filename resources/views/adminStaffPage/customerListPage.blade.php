
@extends('layout.adminApp')

@section('content')

<!-- layout start -->

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Admin Dashboard | Pizza Haven</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">User list</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Customer Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customer as $cust)


                                        <tr>
                                            <td >{{ $cust->id }}</td>
                                            <td >{{ $cust->name}}</td>
                                            <td >{{ $cust->email}}</td>
                                            <td class="text-end">
                                                <!-- Edit button -->
                                                <a href="{{ route('customers.edit', $cust->id) }}" class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>

                                                <!-- Delete button -->
                                                <form action="{{ route('customers.destroy', $cust->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- layout end -->

@endsection