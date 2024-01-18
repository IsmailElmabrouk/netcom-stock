<?php

namespace App\Http\Controllers;

use App\Imports\ClientsImport;
use Illuminate\Http\Request;
use App\Models\Client;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    // ...

    public function index()
    {
        try {
            $clientes = Client::paginate(5); // Use paginate instead of get to get paginated results
            return view('clientes.index', compact('clientes'));
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('clientes.create'); // Display a form for creating a new employee
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:clients',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
            ]);

            Client::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);

            return redirect()->route('clientes.index')->with('success', 'Client created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // ...

    public function edit($id)
    {
        try {
            $client = Client::findOrFail($id);
            return view('clientes.edit', compact('client')); // Display a form for editing a client
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:clients,email,' . $id,
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
            ]);

            $client = Client::findOrFail($id);
            $client->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);

            return redirect()->route('clientes.index')->with('success', 'Client updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();

            return redirect()->route('clientes.index')->with('success', 'Client deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $client = Client::findOrFail($id);
            return view('clientes.show', compact('client')); // Display details of the employee
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function importClients(Request $request)
    {
        try {
            $request->validate([
                'clientFile' => 'required|mimes:csv,xlsx,xls',
            ]);

            Excel::import(new ClientsImport, $request->file('clientFile'));

            return redirect()->back()->with('success', 'Clients imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
