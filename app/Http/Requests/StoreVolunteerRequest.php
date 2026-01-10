<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $role = (int) auth()->user()->role;

        // Permite: user normal (0) e admin (1)
        // Bloqueia: voluntário (2)
        return in_array($role, [0, 1], true);
    }

    public function rules(): array
    {
        return [
            'mensagem' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }
}
