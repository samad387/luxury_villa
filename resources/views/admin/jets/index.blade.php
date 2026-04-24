@extends('layouts.admin')

@section('title', 'Manage Jets')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Jets Privés</h2>
            <a href="{{ route('admin.jets.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-medium rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i> Add New Jet
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/Hour</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Range</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image Preview</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($jets as $jet)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $jet->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $jet->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ number_format($jet->price_per_hour, 2) }} €</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $jet->capacity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ number_format($jet->range_km, 0, ',', ' ') }} km</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">{{ $jet->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($jet->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $jet->images->first()->path) }}" alt="{{ $jet->name }}" class="w-16 h-16 object-cover rounded-md shadow-sm">
                                            @if($jet->images->count() > 1)
                                                <span class="text-xs text-gray-500 ml-1">(+{{ $jet->images->count() - 1 }})</span>
                                            @endif
                                        @elseif ($jet->image)
                                            <img src="{{ asset('storage/' . $jet->image) }}" alt="{{ $jet->name }}" class="w-16 h-16 object-cover rounded-md shadow-sm">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($jet->active)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.jets.edit', $jet->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.jets.destroy', $jet->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this jet? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500">No jets found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $jets->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
