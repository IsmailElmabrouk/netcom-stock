<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category;
use App\Models\Category as ModelsCategory;
use App\Models\Product;
use App\Models\Stock;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Exceptions\SheetNotFoundException;
use Maatwebsite\Excel\Exceptions\UnsupportedSheetFormatException;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::paginate(5); // Change 10 to the number of items you want per page
        $categories = \App\Models\Category::all(); // Retrieve all products
        $stocks = \App\Models\Stock::all();

         return view('product.index', compact('products','categories','stocks'));
    }

    public function getAllProducts()
    {
        $allProducts = Product::all();
    
        return response()->json($allProducts);
    }

    public function create($id)
    {
        try {
            $categories = \App\Models\Category::find($id);
            $stocks = Stock::all();

            return view('product.create', compact('categories', 'stocks'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
 

public function store(Request $request): RedirectResponse
{


    $name =$request->name;
        $reference = $request->reference;
      
         $label = $request->label;
        $description =$request->description;
        $unit = $request->unit;
      
        $price =$request->price;
        $category_id = $request->category_id;
        $stock_id = $request->stock_id;
        $quantity = $request->quantity;

        $isSecces=Product::insert(['name'=>$name,'reference'=>$reference,'label'=>$label,'description'=>$description,'unit'=>$unit,'price'=>$price,'category_id'=>$category_id,'stock_id'=>$stock_id,'quantity'=>$quantity, ]);

  
    
    return redirect()->route('product.index')->with('success', 'Product created successfully.');
}


public function edit($id)
{
    try {
        $product = Product::findOrFail($id);
        $categories = ModelsCategory::all();
        $stocks = Stock::all();

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found');
        }

        return view('product.edit', compact('product', 'categories', 'stocks'));
    } catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    
    public function show($id)
{
    $product = \App\Models\Product::findOrFail($id);
    return view('product.show', compact('product'));
}

public function update(Request $request, $id): RedirectResponse
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'unit' => 'required|string',
            'price' => 'required|numeric',
             
        ]);

        $product = Product::findOrFail($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found');
        }

        // Use the update method to update the product
        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    } catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    
 // ProductController.php

public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
}



    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'price' => $request->input('price'),
        ]);

        return redirect()->route('product.index')->with('success', 'Product price updated successfully.');
    }

    public function replenishStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->increment('quantity', $request->input('quantity'));

        return redirect()->route('product.index')->with('success', 'Stock replenished successfully.');
    }




    

    public function ProductsImport(Request $request)
    {
        try {
            $request->validate([
                'productFile' => 'required|mimes:csv,xlsx,xls',
            ]);

            Excel::import(new ProductsImport, $request->file('productFile'));

            return redirect()->back()->with('success', 'product imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
