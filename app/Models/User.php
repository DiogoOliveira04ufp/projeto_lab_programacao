<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    //  ROLES DO SISTEMA 
    public const ROLE_USER = 0;    
    public const ROLE_ADMIN = 1;   
    public const ROLE_VOLUNTARIO = 2;

    //  CAMPOS QUE PODEM SER "mass assigned"
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    //  CAMPOS ESCONDIDOS (não aparecem em arrays/json)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //  CASTS (conversões automáticas)
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //  HELPERS 
    public function isAdmin(): bool
    {
        return (int)$this->role === self::ROLE_ADMIN;
    }

    public function isVolunteer(): bool
    {
        return (int)$this->role === self::ROLE_VOLUNTARIO;
    }
}
