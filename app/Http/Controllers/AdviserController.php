<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdviserRequest;
use App\Models\CashLoan;
use App\Models\Client;
use App\Models\HomeLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $clients = Client::latest()->get();

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

    public function cashLoan(Client $client)
    {
        // if($client->adviser_id != auth()->id()){
        //     abort(401, 'Unautorized!');
        // }

        $this->authorize('change', $client);

        $cashLoan = CashLoan::where('client_id', $client->id)->firstOrFail();

        CashLoan::updateOrCreate([
            'client_id'  => $client->id,
            'adviser_id' => auth()->id(),
        ], [
            'loan_amount' => request('loan_amount')
        ]);    

        return back()->with('success', 'Cash loan Added');        
    }

    public function homeLoan(Client $client)
    {
        // if($client->adviser_id != auth()->id()){
        //     abort(401, 'Unautorized!');
        // }

        $this->authorize('change', $client);

        $homeLoan = HomeLoan::where('client_id', $client->id)->firstOrFail();      

        HomeLoan::updateOrCreate([
            'client_id'  => $client->id,
            'adviser_id' => auth()->id(),
        ], [
            'property_value'      => request('property_value'),
            'down_payment_amount' => request('down_payment_amount'),
        ]);    

        return back()->with('success', 'Home loan Added');               
    }

    public function reports()
    {
        $cashLoan = CashLoan::selectRaw('null as down_payment_amount')
            ->addSelect('loan_amount', 'adviser_id', 'created_at')
            ->selectRaw("'cash loan' as type")
            ->where('adviser_id', auth()->id());

        $homeLoan = HomeLoan::select('property_value', 'down_payment_amount', 'adviser_id', 'created_at')
            ->selectRaw("'home loan' as type")
            ->where('adviser_id', auth()->id());

        $reports = $cashLoan->union($homeLoan)->latest()->get();

        return view('adviser.reports', compact('reports'));
    }
}
