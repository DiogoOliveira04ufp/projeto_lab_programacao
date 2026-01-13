<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensagemChat extends Model
{
    protected $table = 'mensagens_chat';

    protected $fillable = [
        'user_id',
        'conteudo'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
