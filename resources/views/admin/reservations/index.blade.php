@extends('layouts.admin')

@section('title', 'Gestion des Réservations')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Toutes les réservations</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Date</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Client</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Service</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Période</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left whitespace-nowrap">Statut</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($reservations as $reservation)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-4 mb-2">
                            <div class="font-bold">{{ $reservation->name }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->email }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->phone }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 rounded-full mb-1">{{ $reservation->reservation_type }}</span>
                            <br>
                            <span class="font-medium">{{ $reservation->item_name }}</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            Du: <strong>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d/m/Y') }}</strong><br>
                            Au: <strong>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}</strong>
                        </td>
                        <td class="py-3 px-4 text-left">
                            @if($reservation->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold border border-yellow-200">En attente</span>
                            @elseif($reservation->status === 'confirmed')
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold border border-green-200">Confirmée</span>
                            @elseif($reservation->status === 'cancelled')
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-semibold border border-red-200">Annulée</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full font-semibold border border-gray-200">{{ ucfirst($reservation->status) }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Quick Confirm Button -->
                                @if($reservation->status !== 'confirmed')
                                <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous confirmer cette réservation et envoyer le PDF ?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1.5 rounded flex items-center shadow-sm" title="Confirmer">
                                        <i class="fas fa-check mr-1"></i> Confirmer
                                    </button>
                                </form>
                                @endif

                                <!-- Edit button -->
                                <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1.5 rounded flex items-center shadow-sm" title="Éditer">
                                    <i class="fas fa-edit mr-1"></i> Modifier
                                </a>
                                
                                <!-- Delete form -->
                                <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2 h-8 flex items-center justify-center p-2 rounded hover:bg-red-50" title="Supprimer">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                            @if($reservation->message)
                            <div class="mt-2 text-xs text-left whitespace-normal bg-gray-100 p-2 rounded max-w-xs break-words">
                                <strong>Message:</strong><br>{{ Str::limit($reservation->message, 120) }}
                            </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 px-4 text-center text-gray-500 text-lg">Aucune réservation pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
