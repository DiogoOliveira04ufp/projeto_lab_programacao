<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VolunteerRequest;
use App\Mail\VolunteerApprovedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        // lista de pedidos submetidos (para gestão)
        $items = VolunteerRequest::orderByDesc('created_at')->paginate(15);
    
        // lista global de voluntários aprovados (para mostrar no index)
        $voluntariosAprovados = VolunteerRequest::where('status', 'aprovado')
            ->orderBy('updated_at', 'desc')
            ->get();
    
        return view('admin.volunteers.index', compact(
            'items',
            'voluntariosAprovados'
        ));
    }
    
    public function show($id)
    {
        // apenas o pedido individual
        $item = VolunteerRequest::findOrFail($id);
    
        return view('admin.volunteers.show', compact('item'));
    }


    public function update(Request $request, $id)
    {
        $item = VolunteerRequest::findOrFail($id);

        // guardar status anterior (para detetar mudança real)
        $oldStatus = $item->status;

        $data = $request->validate([
            'status' => ['required', 'in:em_analise,aprovado,rejeitado'],
            'nota_admin' => ['nullable', 'string', 'max:5000'],
        ]);

        // atualiza pedido
        $item->update($data);

        // se passou para "aprovado" AGORA (e antes não era aprovado)
        if ($oldStatus !== 'aprovado' && $data['status'] === 'aprovado') {

            // se este pedido está ligado a um user
            if ($item->user_id) {
                $user = User::find($item->user_id);

                if ($user) {
                    // promove para voluntário (role=2)
                    $user->role = User::ROLE_VOLUNTARIO; 
                    $user->save();

                    // envia email de aprovação
                    Mail::to($user->email)->send(new VolunteerApprovedMail([
                        'nome' => $user->name,
                        'pedido_id' => $item->id,
                    ]));
                }
            }
        }

        return back()->with('success', 'As informações foram alteradas com sucesso.');
    }
}
