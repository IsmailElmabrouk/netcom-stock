<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\FacturDevent;
use App\Models\Product; // Import the Product model for data retrieval
use App\Models\Magasinier;
use App\Models\User;
 use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class FactureVenteController extends Controller
{
    public function index()
    {
        $magasinerUsers = User::where('type', 'Magasiner')->get();
        $factures = FacturDevent::simplePaginate(3); // Adjust the number per page as needed

        $factures = FacturDevent::all();
        return view('facturedevents.index', compact('factures','magasinerUsers' ));
    }
    

 
    public function show($id)
    {
        $facture = FacturDevent::findOrFail($id);
        return view('facturedevents.show', compact('facture'));
    }


    public function create()
{$clients = Client::all(); // Add this line to get clients
 
    $products = Product::all();
    $user = Auth::user();

    // If the user is 'Magasiner', pass the user as the only magasiner
    $magasins = $user && $user->type == 'Magasiner' ? [$user] : User::where('type', 'Magasiner')->get();
     return view('facturedevents.create', compact('products','clients','magasins'));
}

public function store(Request $request):RedirectResponse
{
    
        $date= $request->input('date');
        $quantity=$request->input('quantity');
        $total_amount=$request->input('total_amount');
        $product_id=$request->input('product_id');
        $client_id=$request->input('client_id');
        $status_payment=$request->input('status_payment');

         $payment_method=$request->input('payment_method');
        $remiss_applique=$request->input('remiss_applique');
        $magasiner_id=$request->input('magasiner_id');
    
     
    $isSecces=FacturDevent::insert(['date'=>$date,'quantity'=>$quantity,'total_amount'=>$total_amount,'product_id'=>$product_id,'client_id'=>$client_id,'payment_method'=>$payment_method,'status_payment'=>$status_payment,'remiss_applique'=>$remiss_applique,'magasiner_id'=>$magasiner_id]);

   
    return redirect()->route('facturedevents.index')->with('success', 'Sale Invoice created successfully.');
}
 
public function update(Request $request, $id)
{
    $remiss_applique = $request->has('remiss_applique') ? true : false;
    $facture = FacturDevent::find($id);

    $facture->update([
        'date' => $request->date,
        'quantity' => $request->quantity,
        'total_amount' => $request->total_amount,
        'product_id' => $request->product_id,
        'client_id' => $request->client_id,
        'status_payment' => $request->status_payment,
        'payment_method' => $request->payment_method,
        'remiss_applique' => $remiss_applique,
        'magasiner_id' => $request->magasiner_id,
        // add other fields as needed
    ]);
    return redirect()->route('facturedevents.index')->with('success', 'Sale Invoice updated successfully.');
}

public function edit($id)
{
    $factures = FacturDevent::find($id);
    $clients = Client::all();
    $products = Product::all();
    $magasins = [];

    if (auth()->user()->type == 'Magasiner') {
        $magasins[] = auth()->user();
    } else {
        $magasins = User::where('type', 'Magasiner')->get();
    }

    return view('facturedevents.edit', compact('factures', 'products', 'clients', 'magasins'));
}


public function destroy($id)
{
    $facture = FacturDevent::findOrFail($id);
    $facture->delete();

    return redirect()->route('facturedevents.index')->with('success', 'Sale Invoice deleted successfully.');
}

//calculer les montant total
public function calculateTotalAmount($id)
    {
        $facture = FacturDevent::findOrFail($id);

        // Calculate the total amount based on your business logic
        $totalAmount = $facture->quantity * $facture->product->price;

        // You might have additional calculations or logic here

        return response()->json(['totalAmount' => $totalAmount]);
    }
}
