<?php

namespace App\Http\Controllers;

use App\Models\Donation;

class AdminDonationController extends Controller
{
    public function index()
    {
        // Lista de doações
        $donations = Donation::query()
            ->orderByDesc('paid_at')
            ->orderByDesc('id')
            ->paginate(15);

        // Soma total das doações (apenas pagas)
        $totalCents = (int) Donation::where('status', 'paid')->sum('amount_total');
        $totalEur = (int) round($totalCents / 100);

        return view('admin.donations.index', compact('donations', 'totalEur'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }
}
