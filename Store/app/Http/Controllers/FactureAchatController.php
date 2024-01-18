<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FacturDachat;
use App\Models\Client;

class FactureAchatController extends Controller
{
    public function index()
    {
        $factures = FacturDachat::all();
        $clients = Client::all();

        return view('facturedachats.index', compact('factures','clients'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('facturedachats.create', compact('clients'));
    }

    public function store(Request $request)
    {
        // Handle storing purchase invoices here
    }

    public function show($id)
    {
        $factures = FacturDachat::with('client')->findOrFail($id);
        return view('facturedachats.show', compact('factures'));
    }

    public function edit($id)
    {
        $factures = FacturDachat::findOrFail($id);
        $clients = Client::all();
        return view('facturedachats.edit', compact('factures', 'clients'));
    }

    public function update(Request $request, $id)
    {
        // Handle updating purchase invoices here
    }

    public function destroy($id)
    {
        // Handle deleting purchase invoices here
    }
}
