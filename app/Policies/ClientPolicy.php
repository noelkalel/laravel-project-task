<?php

namespace App\Policies;

use App\Models\Adviser;
use App\Models\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function change(Adviser $adviser, Client $client)
    { 
        return $adviser->id === $client->adviser_id;
    }  
}
