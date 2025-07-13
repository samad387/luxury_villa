@extends('layouts.admin')

@section('title', 'Manage appartements')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Appartements</h2>
            <a href="{{ route('admin.appartements.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-medium rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i> Add New riad
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image Preview</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($appartements as $riad)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $riad->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $riad->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ number_format($riad->price, 2) }} MAD</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $riad->capacity }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">{{ $riad->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($riad->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $riad->images->first()->path) }}" alt="{{ $riad->name }}" class="w-16 h-16 object-cover rounded-md shadow-sm">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.appartements.show', $riad->id) }}" class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.appartements.edit', $riad->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.appartements.destroy', $riad->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this riad? This action cannot be undone.');">
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
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No appartements found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $appartements->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
