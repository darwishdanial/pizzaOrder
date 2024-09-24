
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
                            <div class="card-title">Staff Create</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form id="edit-customer-form" method="POST" action="{{ route('staff.store') }}">
                            @csrf
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Confirm Password</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" class="form-control">
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td >
                                                <input name="email" placeholder="Email" type="email" value="{{ old('email') }}" class="form-control">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input name="password" placeholder="Password" type="password" value="{{ old('password') }}" class="form-control">
                                                @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="password" name="password_confirmation" placeholder="Confirm Password" value="{{ old('password') }}" class="form-control">
                                                @error('password_confirmation')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
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

<script>

    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve flash message from the session
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
    });
</script>

<!-- layout end -->

@endsection
