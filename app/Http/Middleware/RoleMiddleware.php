<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Uso: ->middleware('role:admin') ou ->middleware('role:admin,voluntario')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        $user = auth()->user();
        $role = (int) $user->role;

        // Map de nomes -> ints (ajusta se os teus valores forem diferentes)
        $map = [
            'user' => 0,
            'admin' => 1,
            'voluntario' => 2,
            'voluntário' => 2,
            'volunteer' => 2,
        ];

        $allowed = [];
        foreach ($roles as $r) {
            $r = strtolower(trim((string) $r));
            if ($r === '') continue;

            if (array_key_exists($r, $map)) {
                $allowed[] = $map[$r];
                continue;
            }

            // Se alguém passar números: role:1,2
            if (is_numeric($r)) {
                $allowed[] = (int) $r;
            }
        }

        // Se chamarem middleware sem parâmetros, bloqueia por segurança
        if (count($allowed) === 0) {
            abort(403);
        }

        if (!in_array($role, $allowed, true)) {
            abort(403);
        }

        return $next($request);
    }
}
