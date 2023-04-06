@extends('layouts.app')

@section('title', 'Edit Client |')

@section('content')
    @include('layouts.partials.sidebar')
    
    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-header">
                Edit Client
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('adviser.update', $client->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="first_name">First Name:</label>
                            <input 
                                type="text" 
                                name="first_name" 
                                class="form-control @error('first_name') is-invalid @enderror" 
                                value="{{ old('first_name', $client->first_name) }}"
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
                                value="{{ old('last_name', $client->last_name) }}" 
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
                                value="{{ old('email', $client->email) }}" 
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
                                value="{{ old('phone', $client->phone) }}"
                                >

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-sm btn-success">
                        Update
                    </button>
                    <a href="{{ route('adviser.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </form>
            </div>            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Cash Loan
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('adviser.cashloan', $client->id) }}">
                            @csrf
                            @method('PATCH')
                            
                            <div class="form-group mb-2">
                                <label for="loan_amount">Loan Amount</label>
                                <input 
                                    type="number"
                                    name="loan_amount" 
                                    class="form-control @error('loan_amount') is-invalid @enderror" 
                                    value="{{ $client->cashLoan->loan_amount ?? 0 }}"
                                    >

                                @error('loan_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-sm btn-success">
                                Apply
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Home Loan
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('adviser.homeloan', $client->id) }}">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="property_value">Property Value:</label>
                                    <input 
                                        type="number"
                                        name="property_value" 
                                        class="form-control @error('property_value') is-invalid @enderror" 
                                        value="{{ $client->homeLoan->property_value ?? 0 }}"
                                        >

                                    @error('property_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="down_payment_amount">Down payment amount:</label>
                                    <input 
                                        type="number" 
                                        name="down_payment_amount" 
                                        class="form-control @error('down_payment_amount') is-invalid @enderror" 
                                        value="{{ $client->homeLoan->down_payment_amount ?? 0 }}"
                                        >

                                    @error('down_payment_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-sm btn-success">
                                Apply
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
