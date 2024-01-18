<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\BonSortie;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BonSortieNotification;
use App\Notifications\BonSortieStatusNotification;
use Illuminate\Support\Facades\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\RejectionJustificationNotification;
use App\Notifications\BonSortieUpdateNotification;

class BonSortieController extends Controller
{
    // ... existing code ...

// BonSortieController.php

public function index()
{
    // Check if the user is authenticated
    if (auth()->check()) {
        // Get the notifications for the authenticated user
        $notifications = auth()->user()->notifications;

        // Check if the authenticated user is an admin or Magasiner
        if (auth()->user()->type === 'admin' || auth()->user()->type === 'Magasiner') {
            // If the user is an admin or Magasiner, get all Bon de Sortie records
            $records = BonSortie::paginate(5);
        } else {
            // If the user is neither an admin nor Magasiner, get the Bon de Sortie records associated with the user
            $records = BonSortie::where('user_id', auth()->id())->paginate(5); // Use paginate here
        }

        return view('bonsorties.index', compact('records', 'notifications'));
    }

    // User is not authenticated, handle accordingly
    // For example, redirect to the login page
    return redirect()->route('login');
}



    public function create()
    {
        $stocks = Stock::all();
        $clients = Client::all();
        $products = Product::all();
    
        return view('bonsorties.create', compact('stocks', 'clients', 'products'));
    }
   

    // ... other methods ...

    // Add a method for Magasiner to view and manage their pending bon de sorties
    public function magasinerIndex()
    {
        $magasinerBonSorties = BonSortie::where('user_id', Auth::id())->get();
        return view('bonsorties.magasiner_index', compact('magasinerBonSorties'));
    }

    // ... other methods ...
    // Contrôleur BonSortieController
// Contrôleur BonSortieController
// Contrôleur BonSortieController
 
// Contrôleur BonSortieController
// BonSortieController.php

public function show($id)
{
    $magasinerUsers = User::where('type', 2)->get();

    $bonSortie = BonSortie::with(['products', 'client'])->findOrFail($id);

    return view('bonsorties.show', compact('bonSortie', 'magasinerUsers'));
}



    
public function store(Request $request)
{
    $request->validate([
        'stock_id' => 'required|exists:stocks,id',
        'client_id' => 'required|exists:clients,id',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        'date' => 'required|date',
        'reason' => 'required',
    ]);

    $bonSortie = BonSortie::create([
        'stock_id' => $request->stock_id,
        'client_id' => $request->client_id,
        'date' => $request->date,
        'reason' => $request->reason,
        'user_id' => Auth::id(),
        'status' => 0, // Set status to pending initially
    ]);
    $products = collect($request->products)->mapWithKeys(function ($product) {
        return [$product['id'] => ['quantity' => $product['quantity']]];
    });
    
    $bonSortie->products()->sync($products);
 
    // Notify the user
    Session::flash('success', 'Bon de Sortie created successfully!');

    // You can also trigger a notification using jQuery
    // Add the following line if you're not using the layout file shown earlier
    // echo '<script>showNotification("Bon de Sortie created successfully!", "success");</script>';

    return redirect()->route('bonsorties.index');
}
public function edit($id)
{
    $record = BonSortie::findOrFail($id);
    $clients = Client::all(); // Fetch all clients (adjust based on your actual logic)

    return view('bonsorties.edit', compact('record', 'clients'));
}

public function update(Request $request, $id)
{
    
 
    $request->validate([
        'stock_id' => 'required|exists:stocks,id',
        'date' => 'required|date',
        'reason' => 'required',
    ]);

    $record = BonSortie::findOrFail($id);
 
    $record->update([
        'stock_id' => $request->stock_id,
        'date' => $request->date,
        'reason' => $request->reason,
    ]);
    // Sync the associated products with quantities
     $this->updateStockQuantities($record);
     if (auth()->user()->type === 'Commercial') {
        // If so, update the status to 0
        $record->update(['status' => 0]);
    }

    // Notify the user
    Session::flash('success', 'Bon de Sortie updated successfully!');

    // You can also trigger a notification using jQuery
    // Add the following line if you're not using the layout file shown earlier
    // echo '<script>showNotification("Bon de Sortie updated successfully!", "success");</script>';
   

    return redirect()->route('bonsorties.index');
}
// BonSortieController.php

public function accept($id)
{
    $bonSortie = BonSortie::findOrFail($id);

    // Vérifiez si le bon de sortie est en attente d'approbation
    if ($bonSortie->status == 0) {
        // Mettez à jour le statut du bon de sortie à "Accepté"
        $bonSortie->update(['status' => 1]);

        // Notifiez l'utilisateur que le bon de sortie a été accepté
        $user = $bonSortie->user;
        $user->notify(new BonSortieStatusNotification($bonSortie, 'accepted'));

        // Redirigez l'administrateur vers la liste des bons de sortie en attente
        return redirect()->route('bonsorties.index')->with('success', 'Bon de Sortie accepté avec succès.');
    }

    // Si le bon de sortie n'est pas en attente d'approbation, gérez en conséquence (redirection, message d'erreur, etc.)
    return redirect()->route('bonsorties.index')->with('error', 'Le Bon de Sortie n\'est pas en attente d\'approbation.');
}


// BonSortieController.php

public function print($id)
{
    $bonSortie = BonSortie::findOrFail($id);

    // Vérifiez si l'utilisateur authentifié a le type correct pour imprimer
    if (Auth::user()->type === 'user' && Auth::id() === $bonSortie->user_id) {
        $sessionKey = 'bon_sortie_printed_' . $bonSortie->id;
        $magasinerUsers = User::where('type', 2)->get();

        // Vérifiez si la variable de session n'est pas définie
        if (!session()->has($sessionKey)) {
            $currentDate = Carbon::now()->toDateString();
            $pdf = PDF::loadView('bonsorties.pdf', compact('bonSortie', 'currentDate','magasinerUsers'));
            $pdfPath = storage_path('app/bon_de_sortie_' . $bonSortie->id . '.pdf');
            $pdf->save($pdfPath);

            // Définissez la variable de session
            session([$sessionKey => true]);

            return response()->download($pdfPath, 'bon_de_sortie.pdf')->deleteFileAfterSend();
        } else {
            // La variable de session est définie, l'utilisateur a déjà imprimé
            return redirect()->route('bonsorties.index')->with('error', 'Ce Bon de Sortie a déjà été imprimé lors de cette session.');
        }
    } else {
        // L'utilisateur n'a pas la permission d'imprimer
        return redirect()->route('bonsorties.index')->with('error', 'Vous n\'avez pas la permission d\'imprimer ce Bon de Sortie.');
    }
}

// BonSortieController.php

public function reject($id)
{
    $bonSortie = BonSortie::findOrFail($id);

    // Perform rejection logic (update status, send notification, etc.)
    $bonSortie->update(['status' => 2]); // Utilise la valeur 2 pour le statut "Rejected"

    // Notify the user about the Bon de Sortie status
    $user = $bonSortie->user;
    $user->notify(new BonSortieStatusNotification($bonSortie, 'rejected'));

    return redirect()->route('bonsorties.index')->with('success', 'Bon de Sortie rejected successfully.');
}




// BonSortieController.php

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:1,2', // 1 for Accept, 2 for Reject
        'reject_justification' => 'nullable|required_if:status,2|string', // Required only if status is Reject
    ]);

    $bonSortie = BonSortie::findOrFail($id);

    if ($request->input('status') == 1) {
        // If status is Accept, update accordingly
        $bonSortie->status = $request->input('status');
        $bonSortie->save();

        // Notify the user about the status update
        $bonSortie->user->notify(new BonSortieNotification($bonSortie, $request->input('status')));

        return redirect()->route('bonsorties.show', $id)->with('success', 'Bon de Sortie accepted successfully.');
    } elseif ($request->input('status') == 2) {
        // If status is Reject, update accordingly
        $bonSortie->status = $request->input('status');
        $bonSortie->reject_justification = $request->input('reject_justification'); // Save the justification
        $bonSortie->save();

        // Notify the user about the status update
        $bonSortie->user->notify(new BonSortieNotification($bonSortie, $request->input('status')));

        // Notify Commercials for verification
        $commercials = User::where('type', 'Commercial')->get();
        Notification::send($commercials, new BonSortieStatusNotification($bonSortie, 'pending_verification'));

        return redirect()->route('bonsorties.show', $id)->with('success', 'Bon de Sortie rejected successfully.');
    }

    // Handle other cases or provide an appropriate response
    return redirect()->route('bonsorties.show', $id)->with('error', 'Invalid status provided.');
}


private function updateStockQuantities(BonSortie $bonSortie)
{
    foreach ($bonSortie->products as $product) {
        // Calculate the new quantity of the product
        $newQuantity = $product->quantity - $bonSortie->products->find($product->id)->pivot->quantity;

        // Update the quantity of the product in the database
        $product->update(['quantity' => $newQuantity]);
    }
}

// Ajouter cette méthode à votre contrôleur BonSortieController
// BonSortieController.php

// BonSortieController.php

// BonSortieController.php

public function confirmSortie($id)
{
    $bonSortie = BonSortie::findOrFail($id);

    // Check if the Bon de Sortie is in the correct status for confirming sortie
    if ($bonSortie->status == 1) {
        // Update product quantities
        foreach ($bonSortie->products as $product) {
            $newQuantity = $product->quantity - $bonSortie->products->find($product->id)->pivot->quantity;
            $product->update(['quantity' => $newQuantity]);
            
        }

        // Notify the user about the Bon de Sortie status
        $user = $bonSortie->user;
        $user->notify(new BonSortieStatusNotification($bonSortie, 'sortie'));

        // Respond with a JSON message
        return response()->json(['message' => 'Bon de Sortie marked as Sortie successfully.']);
    } else {
        // If the Bon de Sortie is not in the correct status, return an error response
        return response()->json(['error' => 'Invalid Bon de Sortie status for confirming sortie.'], 400);
    }
}

// BonSortieController.php

// ... (autres méthodes)

// Dans le contrôleur BonSortieController.php
public function verify(Request $request, $id)
{
    // Logique de vérification par le commercial...

    $bonSortie = BonSortie::findOrFail($id);
    $bonSortie->verified_by_commercial = true;
    $bonSortie->save();

    // Envoi de la notification
    $bonSortie->sendVerificationNotification();

    // Autres redirections ou messages...

    return redirect()->route('bonsorties.index')->with('success', 'Bon de Sortie vérifié avec succès.');
}

 

}