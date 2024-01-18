<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminOnlyMethod()
    {
        $this->middleware('type:admin');
        
        // Rest of your code here
        $users = User::where('type', 'admin')->get();
        
        return view('admin.users', compact('users'));
    }

    public function magasinerOnlyMethod()
    {
        $this->middleware('type:Magasiner');
        
        // Rest of your code here
        $magasiniers = User::where('type', 'Magasiner')->get();
        
        return view('magasiner.users', compact('magasiniers'));
    }    

    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'type' => 'required|in:0,1,2,3',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'current_password' => 'required|string',
                'type' => 'required|in:0,1,2,3',
            ]);
    
            $user = User::findOrFail($id);
    
            // Check if the provided current password matches the actual current password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
    
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->type,
            ]);
    
            // Update the password only if a new password is provided
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
    
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // or log it
            return redirect()->back()->with('error', 'An error occurred while updating the user: ' . $e->getMessage());
        }
        
    }
    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    // Add other functions as needed (update, edit, destroy, etc.)
}
