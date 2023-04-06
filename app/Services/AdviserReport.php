<?php

namespace App\Services;

class AdviserReport
{
    public function handle()
    {
        // get all cash loan products and home loan products that belong to the adviser
        $cashLoanProducts = auth()->user()->cashLoans;
        $homeLoanProducts = auth()->user()->homeLoans;
        
        // merge the cash loan products and home loan products into a single collection
        $products = $cashLoanProducts->merge($homeLoanProducts);
        
        // sort the products by creation date, from newest to oldest
        return $products->sortByDesc('created_at');
    }
}