<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\FacturDevent;
use App\Models\User;
use App\Models\Stock;
use App\Models\BonSortie;

use Illuminate\Support\Facades\Auth;

use App\Models\Employee;
 
use App\Models\Client;

class AdminController extends Controller
{ 
    public function adminHome(): View

    {
        $stocks = Stock::all();
        $products = Product::all(); // Adjust this based on your actual logic
        $latestBonSortie = BonSortie::where('verified_by_commercial', true)
        ->orderBy('created_at', 'desc')
        ->first();
    $notifications = Auth::user()->notifications;
    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $totalUser = User::count();

    $totalEmployees = Employee::count();
    $totalClients = Client::count();
$totalFactureDevents=FacturDevent::count();
$users = User::all(); // You can modify this query based on your needs
$stockId = 1; // Replace with the actual stock ID
$stock = Stock::find($stockId);

$bonsSortiesAwaitingCommercial = BonSortie::where(function ($query) {
    $query->where('status', 0)
          ->orWhere('verified_by_commercial', true);
})->get();
$thresholdQuantity = 10; // Définissez votre seuil de quantité minimale

$productsAlmostEmpty = Product::where('quantity', '<=', $thresholdQuantity)->get();

        return view('Admin.admin-page', compact('stocks','products','notifications','totalProducts', 'totalCategories', 'totalEmployees', 'totalClients','totalFactureDevents','users','totalUser', 'bonsSortiesAwaitingCommercial', 'productsAlmostEmpty', 'thresholdQuantity','latestBonSortie'));
    }

    
    
}

