<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;

class DonationReceiptController extends Controller
{
    public function download(Donation $donation)
    {
        $user = auth()->user();
        if (!$user) {
            abort(403);
        }

        // Só o dono da doação (se estiver associado) ou admin pode descarregar
        $isAdmin = method_exists($user, 'isAdmin') ? $user->isAdmin() : ((int) $user->role === 1);

        if (!$isAdmin && $donation->user_id && (int) $donation->user_id !== (int) $user->id) {
            abort(403);
        }

        $pdf = Pdf::loadView('pdf.donation_receipt', [
            'donation' => $donation,
        ]);

        return $pdf->download('recibo-doacao-' . $donation->id . '.pdf');
    }
}
