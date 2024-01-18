<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BonSortie;
use App\Models\Client;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $records = BonSortie::paginate(10); // Adjust the number based on your needs
    $stocks=Stock::all();
    $clients=Client::all();
    $products=Product::all();
        $notifications = Auth::user()->notifications;
    
        return view('home', compact('notifications', 'records','clients','stocks','products'));
    }

    public function markAllNotificationsAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
  


    public function managerHome(): View

    {

        return view('Magasiner.magasiner-page');

    }
    
}
