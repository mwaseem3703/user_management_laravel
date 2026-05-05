<?php

namespace App\Http\Controllers;

use App\Models\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserRegistrationController extends Controller
{
    // READ & SEARCH: Show home page with table
    public function index(Request $request)
    {
        $query = UserRegistration::query();

        // Search by email logic
        if ($request->has('search') && $request->search != '') {
            $query->where('email', 'LIKE', '%' . $request->search . '%');
        }

        // Fetch latest users
        $users = $query->latest()->get();
        return view('registration.index', compact('users'));
    }

    // CREATE: Show registration form
    public function create()
    {
        return view('registration.create');
    }

    // STORE: Save new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:user_registrations,email',
            'cnic' => ['required', 'string', 'regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', 'unique:user_registrations,cnic'],            
            'telephone' => 'required|digits:11',
            'comments' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.regex' => 'The name may only contain letters and spaces.',
            'cnic.regex' => 'The CNIC format must be XXXXX-XXXXXXX-X.',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $name);
            $data['profile_picture'] = $name;
        }

        UserRegistration::create($data);
        return redirect()->route('user.index')->with('success', 'User registered successfully.');
    }

    // EDIT: Show update form
    public function edit($id)
    {
        $user = UserRegistration::findOrFail($id);
        return view('registration.edit', compact('user'));
    }

    // UPDATE: Save changes
    public function update(Request $request, $id)
    {
        $user = UserRegistration::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:user_registrations,email,' . $user->id,
            'cnic' => ['required', 'string', 'regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', 'unique:user_registrations,cnic,' . $user->id],
            'telephone' => 'required|digits:11',
            'comments' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.regex' => 'The name may only contain letters and spaces.',
            'cnic.regex' => 'The CNIC format must be XXXXX-XXXXXXX-X.',
        ]);

        $data = $request->except('profile_picture');

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && File::exists(public_path('uploads/' . $user->profile_picture))) {
                File::delete(public_path('uploads/' . $user->profile_picture));
            }
            $image = $request->file('profile_picture');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $name);
            $data['profile_picture'] = $name;
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    // DELETE: Remove record
    public function destroy($id)
    {
        $user = UserRegistration::findOrFail($id);
        
        if ($user->profile_picture && File::exists(public_path('uploads/' . $user->profile_picture))) {
            File::delete(public_path('uploads/' . $user->profile_picture));
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}