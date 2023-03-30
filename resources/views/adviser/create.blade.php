@extends('layouts.app')

@section('title', 'Create Client |')

@section('content')
    @include('layouts.partials.sidebar')
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                Create Client
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('adviser.store') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="first_name">First Name:</label>
                            <input 
                                type="text" 
                                name="first_name" 
                                class="form-control @error('first_name') is-invalid @enderror" 
                                value="{{ old('first_name') }}" 
                                >

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label for="last_name">Last Name:</label>
                            <input 
                                type="text" 
                                name="last_name" 
                                class="form-control @error('last_name') is-invalid @enderror" 
                                value="{{ old('last_name') }}" 
                                >

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="form-group col-md-6 mb-2">
                            <label for="email">Email Address:</label>
                            <input 
                                type="text" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email') }}" 
                                >

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mb-2">
                            <label for="phone">Phone Number:</label>
                            <input 
                                type="text" 
                                name="phone" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone') }}"
                                >

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-sm btn-success">
                        Create
                    </button>
                    <a href="{{ route('adviser.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
