<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerRequest extends Model
{
    protected $fillable = [
        'user_id', 'nome', 'email', 'mensagem', 'status', 'nota_admin'
    ];
}

