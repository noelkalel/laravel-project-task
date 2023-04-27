<?php

namespace App\Http\Controllers;

use App\Exports\AdvisersExport;

use App\Models\Client;
use App\Models\HomeLoan;
use App\Models\CashLoan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Services\AdviserReport;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdviserRequest;
use App\Http\Requests\CashLoanRequest;
use App\Http\Requests\HomeLoanRequest;

class AdviserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('adviser.dashboard');
    }

    public function index()
    {
        $clients = Client::with(['cashLoan', 'homeLoan'])->latest()->get();

        return view('adviser.index', compact('clients'));
    }

    public function create()
    {
        return view('adviser.create');
    }

    public function store(AdviserRequest $request)
    {
        // Client::create([
        //     'first_name' => request('first_name'),
        //     'last_name'  => request('last_name'),
        //     'email'      => request('email'),
        //     'phone'      => request('phone'),
        // ]);

        auth()->user()->clients()->create([
            'first_name' => request('first_name'),
            'last_name'  => request('last_name'),
            'email'      => request('email'),
            'phone'      => request('phone'),
        ]);

        return redirect()->route('adviser.index')->with('success', 'Client Created');
    }

    public function edit(Client $client)
    { 
        return view('adviser.edit', compact('client'));
    }

    public function update(AdviserRequest $request, Client $client)
    {
        $client->update([
            'first_name' => request('first_name'),
            'last_name'  => request('last_name'),
            'email'      => request('email'),
            'phone'      => request('phone'),
        ]);

        return redirect()->back()->with('success', 'Client Updated');
    }

    public function destroy(Client $client)
    { 
        $client->cashLoan()->delete();
        $client->homeLoan()->delete();

        $client->delete();

        return redirect()->route('adviser.index')->with('success', 'Client Deleted');
    }

    public function cashLoan(CashLoanRequest $request, Client $client)
    {
        // if($client->adviser_id != auth()->id()){
        //     abort(401, 'Unautorized!');
        // }        

        $this->authorize('change', $client);

        $cashLoan = CashLoan::where('client_id', $client->id)->first();

        CashLoan::updateOrCreate([
            'client_id'  => $client->id,
            'adviser_id' => auth()->id(),
        ], [
            'loan_amount' => request('loan_amount')
        ]);    

        return back()->with('success', 'Cash loan Added');        
    }

    public function homeLoan(HomeLoanRequest $request, Client $client)
    {
        // if($client->adviser_id != auth()->id()){
        //     abort(401, 'Unautorized!');
        // }

        $this->authorize('change', $client);

        $homeLoan = HomeLoan::where('client_id', $client->id)->first();      

        HomeLoan::updateOrCreate([
            'client_id'  => $client->id,
            'adviser_id' => auth()->id(),
        ], [
            'property_value'      => request('property_value'),
            'down_payment_amount' => request('down_payment_amount'),
        ]);    

        return back()->with('success', 'Home loan Added');               
    }

    public function reports(AdviserReport $report)
    {
        $reports = $report->handle();

        return view('adviser.reports', compact('reports'));
    }

    public function export(Excel $excel)
    {
        return $excel->download(new AdvisersExport, config('app.export') . ' - products.xlsx');
    }
}
