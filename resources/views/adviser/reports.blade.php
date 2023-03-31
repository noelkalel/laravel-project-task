@extends('layouts.app')

@section('title', 'Reports |')

@section('content')
    @include('layouts.partials.sidebar')

    <div class="col-md-9">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                Reports

                <a href="{{ route('adviser.export') }}">
                    <button class="btn btn-primary btn-sm ms-auto">
                        Export
                    </button>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Product Type</th>
                                <th>Product Value</th>
                                <th>Creation date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($reports) > 0)
                                @foreach ($reports as $report)
                                    <tr>
                                        <td class="align-middle">
                                            @if($report->loan_amount)
                                                Cash loan
                                            @else
                                                Home loan
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($report->loan_amount)
                                                {{ $report->loan_amount }}
                                            @else
                                                {{ $report->property_value }} - {{ $report->down_payment_amount }}
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {{ $report->created_at }}
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                        <td class="align-middle">
                                            {{ $report->type }}
                                        </td>
                                        @if($report->type == 'cash loan')
                                            <td class="align-middle">
                                                {{ $report->loan_amount }}
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                {{ $report->loan_amount }} - {{ $report->down_payment_amount }}
                                            </td>
                                        @endif
                                        <td class="align-middle">
                                            {{ $report->created_at }}
                                        </td>
                                    </tr> --}}
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="7">
                                        <h5 class="mt-3">
                                            There are no reports at this moment!
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