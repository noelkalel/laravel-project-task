@extends('layouts.app')

@section('title', 'All Clients |')

@section('content')
    @include('layouts.partials.sidebar')

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                All Clients
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Cash Loans</th>
                                <th>Home Loans</th>
                                <th colspan="2" class="text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($clients) > 0)
                                @foreach ($clients as $client)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $client->first_name }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $client->last_name }}
                                        </td>
                                        <td class="align-middle">
                                            @if(!$client->email)
                                                No Email
                                            @else
                                                {{ $client->email }}
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if(!$client->phone)
                                                No Phone
                                            @else
                                                {{ $client->phone }}
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {{ $client->cashLoan ? 'Yes' : 'No' }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $client->homeLoan ? 'Yes' : 'No' }}
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('adviser.edit', $client) }}">
                                                <span class="btn btn-sm btn-success ml-2">
                                                    Edit
                                                </span>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('adviser.destroy', $client) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger ml-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="7">
                                        <h5 class="mt-3">
                                            There are no clients at this moment!
                                        </h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection