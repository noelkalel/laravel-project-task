<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Adviser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function cashLoans()
    {
        return $this->hasMany(CashLoan::class);
    }
    
    public function homeLoans()
    {
        return $this->hasMany(HomeLoan::class);
    }
}
