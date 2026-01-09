<?php

namespace App\Http\Controllers;

use App\Models\VolunteerRequest;
use Illuminate\Http\Request;

class AdminVolunteerController extends Controller 
{
    public function __construct()
    {
        // exige utilizador autenticado
        $this->middleware('auth');

        // bloqueio simples: só admin (role=1)
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || auth()->user()->role != 1) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $items = VolunteerRequest::orderByDesc('created_at')->paginate(15);
        return view('admin.volunteers.index', compact('items'));
    }

    public function show($id)
    {
        $item = VolunteerRequest::findOrFail($id);
        return view('admin.volunteers.show', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = VolunteerRequest::findOrFail($id);

        $data = $request->validate([
            'status' => ['required', 'in:em_analise,aprovado,rejeitado'],
            'nota_admin' => ['nullable', 'string', 'max:5000'],
        ]);

        $item->update($data);

        return back()->with('success', 'Pedido atualizado com sucesso.');
    }
}
