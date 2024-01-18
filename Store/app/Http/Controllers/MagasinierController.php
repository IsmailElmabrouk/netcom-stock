<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\BonSortie;
use App\Models\Notification;
class MagasinierController extends Controller
{
    public function index()
    {
        
        return view('Magasiner.magasiner-page');
    }
    
// In the MagasinierController
public function managerHome(): View
{
    $magasinerBonSorties=BonSortie::all();
    $bonsorties = BonSortie::all();
   $records= BonSortie::all();
     return view('Magasiner.magasiner-page', compact('bonsorties',  'records','magasinerBonSorties'));
}

public function magasinerDashboard()
{
    // Retrieve Bons de Sortie awaiting approval
 
    return view('Magasiner.magasiner-page',  );
}

    public function create()
    {
        // Show the form for creating a new magasinier
    }

    public function store(Request $request)
    {
        // Store a new magasinier in the database
    }
    public function showNotifications()
    {
        $user = auth()->user();
        $notifications = $user->notifications;
    
        // Log the user type
        \Illuminate\Support\Facades\Log::info('User Type: ' . $user->user_type);
    
        // Add this line to check the user type
        dd(auth()->user()->user_type);
    
        return view('Magasiner.notifications', compact('notifications'));
    }
    
    
    

    

    public function show($id)
    {
        // Display the details of a specific magasinier
    }

    public function edit($id)
    {
        // Show the form for editing a specific magasinier
    }

    public function update(Request $request, $id)
    {
        // Update a specific magasinier in the database
    }

    public function destroy($id)
    {
        // Delete a specific magasinier
    }
}
