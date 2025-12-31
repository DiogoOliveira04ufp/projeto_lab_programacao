<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = ['pontuacao', 'comentario', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}