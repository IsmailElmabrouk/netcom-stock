<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Stock;
use App\Models\Product;
use App\Models\StockIssue;
class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::all(); // Retrieve all employees
    
        return view('employee.index', compact('employee'));
    }
    
    public function create()
    {
        $stock = Stock::all();
        return view('employee.create',compact('stock')); // Display a form for creating a new employee
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'stock_id' => 'required|exists:stocks,id',
        ]);
    
        Employee::create([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'stock_id' => $request->input('stock_id'),
        ]);
    
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }
    
    public function show($id)
    {
        $employee = Employee::findOrFail($id); // Find the employee by its ID
    
        return view('employee.show', compact('employee')); // Display details of the employee
    }
    
    public function edit($id)
    {
        $employee = Employee::findOrFail($id); // Find the employee by its ID
    
        return view('employee.edit', compact('employee')); // Display a form for editing the employee
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'stock_id' => 'required|exists:stocks,id',
        ]);
    
        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'stock_id' => $request->input('stock_id'),
        ]);
    
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }
    
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
    
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
   
    }


    public function performInventory(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'adjustment_quantity' => 'required|integer',
        ]);

        $employee = Employee::findOrFail($id);
        $product = Product::findOrFail($request->input('product_id'));

        // Perform logic to adjust inventory, e.g., update quantity
        // You can customize this based on your inventory management system
        $newQuantity = $product->quantity + $request->input('adjustment_quantity');
        $product->update(['quantity' => $newQuantity]);

        return redirect()->route('employee.index')->with('success', 'Inventory adjustment completed.');
    }

    public function reportStockIssue($id, Request $request)
    { $employee = Employee::findOrFail($id);

        // Validate the request
        $request->validate([
            'issue_description' => 'required|string',
            'quantity' => 'integer', // Add validation for quantity if needed
        ]);
    
        // Store the stock issue in the database
        $employee->stockIssues()->create([
            'issue_description' => $request->input('issue_description'),
            'quantity' => $request->input('quantity', 0), // Provide a default value if needed
        ]);
    
        return redirect()->route('employee.index')->with('success', 'Problème de stock signalé avec succès.');
    }
    


  public function showStockIssues($id)
  {
    $employee = Employee::findOrFail($id);

    return view('employee.problèmes de stock', compact('employee'));
  }



 
}