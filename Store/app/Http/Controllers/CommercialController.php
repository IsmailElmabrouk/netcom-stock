<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BonSortie;

class CommercialController extends Controller
{
    public function commercialHome()
    {
        $bonsSortieAwaitingVerification = BonSortie::where('status', 0)->get();
        $records = BonSortie::orderBy('date', 'desc')->paginate(10); // You can adjust the number of records per page (e.g., 10)
        $record = $records->first();

        // Code pour la page d'accueil des commerciaux
        return view('commercial.home-page', compact('bonsSortieAwaitingVerification','records','record'));
    }

    public function showNotifications()
    {
        // Code pour afficher les notifications des commerciaux
        return view('commercial.notifications');
    }

    // Dans CommercialController.php
public function bonsSortiesAwaitingVerification()
{
    $bonsSortiesAwaitingCommercial = BonSortie::where('status', 0)->where('verified_by_commercial', false)->get();

    return view('commercial.bons_sorties_awaiting_verification', compact('bonsSortiesAwaitingCommercial'));
}



 
}
