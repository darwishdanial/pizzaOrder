
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
                            <div class="card-title">Customer Edit</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form id="edit-customer-form" method="POST" action="{{ route('customers.save', $customerEdit->id) }}">
                            @csrf
                            @method('PUT')
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
                                        <tr>
                                            <td>{{ $customerEdit->id }}</td>
                                            <td>
                                                <input type="text" name="name" value="{{ $customerEdit->name }}" class="form-control" required>
                                            </td>
                                            <td >
                                                <input type="email" name="email" value="{{ $customerEdit->email }}" class="form-control" required>
                                            </td>
                                            <td class="text-end">  
                                                <button type="submit" class="btn btn-primary btn-round">
                                                    save
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- layout end -->

@endsection
