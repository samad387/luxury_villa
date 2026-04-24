@extends('layouts.admin')

@section('title', 'Manage Activités')

@section('content')
<div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Activités</h1>
    <a href="{{ route('admin.activities.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i>
        Ajouter
    </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Prix</th>
                    <th class="px-4 py-2">Catégorie</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $activity->id }}</td>
                    <td class="px-4 py-2">
                        @if(method_exists($activity, 'images') && $activity->images && $activity->images->isNotEmpty())
                            <img src="{{ asset('storage/'.$activity->images->first()->path) }}" alt="{{ $activity->nom }}" class="w-16 h-12 object-cover rounded">
                        @elseif($activity->image)
                            <img src="{{ asset('storage/'.$activity->image) }}" alt="{{ $activity->nom }}" class="w-16 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-400">Aucune</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 font-semibold">{{ $activity->nom }}</td>
                    <td class="px-4 py-2">{{ $activity->prix ? number_format($activity->prix,2).' MAD' : '-' }}</td>
                    <td class="px-4 py-2">{{ $activity->category ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-3 items-center">
                        <a href="{{ route('admin.activities.show', $activity) }}" title="Voir"><i class="fas fa-eye text-blue-600 hover:text-blue-800 text-lg"></i></a>
                        <a href="{{ route('admin.activities.edit', $activity) }}" title="Modifier"><i class="fas fa-edit text-purple-600 hover:text-purple-800 text-lg"></i></a>
                        <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Supprimer cette activité ?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; padding:0;" title="Supprimer"><i class="fas fa-trash text-red-600 hover:text-red-800 text-lg"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">Aucune activité.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $activities->links() }}</div>
@endsection







