@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Registered Users</h2>
        
        <!-- Live Search Input -->
        <div class="flex gap-2 relative">
            <input type="email" id="liveSearchInput" placeholder="Live search by email..." class="px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 w-64 shadow-sm">
            <i class="fa-solid fa-search absolute right-3 top-3 text-gray-400"></i>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Photo</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">CNIC</th>
                    <th class="py-3 px-6 text-left">Telephone</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="text-gray-600 text-sm font-light">
                @forelse($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left">
                        @if($user->profile_picture)
                            <img src="{{ asset('uploads/' . $user->profile_picture) }}" class="w-12 h-12 rounded-full object-cover border-2 border-blue-500">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500"><i class="fa-solid fa-user"></i></div>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap font-medium">{{ $user->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->cnic }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->telephone }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center gap-3">
                            <a href="{{ route('user.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700 transform hover:scale-110 transition">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transform hover:scale-110 transition">
                                    <i class="fa-solid fa-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-500 text-lg">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Live Search Script -->
<script>
    document.getElementById('liveSearchInput').addEventListener('input', function() {
        let searchValue = this.value;
        
        // Fetch the updated table data based on the search query
        fetch("{{ route('user.index') }}?search=" + encodeURIComponent(searchValue))
            .then(response => response.text())
            .then(html => {
                // Parse the returned HTML and extract just the table body
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');
                document.getElementById('tableBody').innerHTML = doc.getElementById('tableBody').innerHTML;
            });
    });
</script>
@endsection