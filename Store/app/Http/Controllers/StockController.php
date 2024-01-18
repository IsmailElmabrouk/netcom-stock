<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        try {
            $stocks = Stock::all(); // Retrieve all stocks
            return view('stock.index', compact('stocks'));
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('stock.create'); // Display a form for creating a new stock
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'capacity' => 'required|integer',
            ]);

            Stock::create([
                'name' => $request->input('name'),
                'location' => $request->input('location'),
                'capacity' => $request->input('capacity'),
            ]);

            return redirect()->route('stock.index')->with('success', 'Stock created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $stock = Stock::findOrFail($id); // Find the stock by its ID
            return view('stock.show', compact('stock')); // Display details of the stock
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $stock = Stock::findOrFail($id); // Find the stock by its ID
            return view('stock.edit', compact('stock')); // Display a form for editing the stock
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'capacity' => 'required|integer',
            ]);

            $stock = Stock::findOrFail($id);
            $stock->update([
                'name' => $request->input('name'),
                'location' => $request->input('location'),
                'capacity' => $request->input('capacity'),
            ]);

            return redirect()->route('stock.index')->with('success', 'Stock updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $stock = Stock::findOrFail($id);
            $stock->delete();
            return redirect()->route('stock.index')->with('success', 'Stock deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function checkSpace($id)
    {
        try {
            $stock = Stock::findOrFail($id);
            $availableSpace = $stock->capacity - $stock->products->sum('quantity');
            return view('stock.check_space', compact('stock', 'availableSpace'));
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function manageMovements($id)
    {
        try {
            $stock = Stock::findOrFail($id);
            return view('stock.manage_movements', compact('stock'));
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function updateStockQuantities($bonSortie)
    {
        try {
            foreach ($bonSortie->products as $product) {
                // Update the quantity in the stock
                // You may need to add your own logic here
                $product->stock->update([
                    'quantity' => $product->stock->quantity - $product->pivot->quantity,
                ]);
            }

            return redirect()->route('stock.index')->with('success', 'Stock quantities updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('stock.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
