@extends('layouts.app')

@section('title', 'Dashboard |')

@section('content')
    @include('layouts.partials.sidebar')

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                Dashboard
            </div>

            <div class="card-body">
                Welcome, {{ ucwords(auth()->user()->first_name) }}
            </div>
        </div>
    </div>
@endsection