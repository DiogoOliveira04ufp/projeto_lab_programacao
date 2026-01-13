<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = [
        'name',
        'data_nascimento',
        'especie',
        'raca',
        'historico',
        'foto',
        'peso',
        'adotado',
        'user_id',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
