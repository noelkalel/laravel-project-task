<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function homeLoan()
    {
       return $this->hasOne(HomeLoan::class);
    }

    public function cashLoan()
    {
        return $this->hasOne(CashLoan::class);
    }
}
