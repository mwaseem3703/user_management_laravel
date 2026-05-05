@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800">Register New User</h2>
        <p class="text-gray-500 mt-2">Fill in the details below to create a new record.</p>
    </div>

    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name </label>
                <!-- Forces Alphabets and Spaces ONLY -->
                <input type="text" name="name" value="{{ old('name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 bg-gray-50" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 bg-gray-50" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CNIC </label>
                <input type="text" name="cnic" value="{{ old('cnic') }}" placeholder="12345-1234567-1" maxlength="15" oninput="let v=this.value.replace(/\D/g,''); this.value=(v.slice(0,5)+(v.length>5?'-':'')+v.slice(5,12)+(v.length>12?'-':'')+v.slice(12,13));" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 bg-gray-50" required>
                @error('cnic') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telephone</label>
                <input type="text" name="telephone" value="{{ old('telephone') }}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 bg-gray-50" placeholder="03001234567" required>
                @error('telephone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Comments</label>
            <textarea name="comments" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 bg-gray-50">{{ old('comments') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
            <input type="file" name="profile_picture" accept="image/*" class="w-full px-4 py-2 border rounded-lg bg-gray-50">
        </div>
        <div class="pt-4 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition">Save Record</button>
        </div>
    </form>
</div>
@endsection