@extends('layouts.admin')

@section('title', 'Modifier la Réservation')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Éditer la réservation #{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</h2>
        <a href="{{ route('admin.reservations.index') }}" class="text-sm bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-200">
            Retour
        </a>
    </div>

    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Client Info Group -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nom Complet *</label>
                <input type="text" name="name" value="{{ old('name', $reservation->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email', $reservation->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone', $reservation->phone) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de personnes</label>
                <input type="number" name="guests_count" value="{{ old('guests_count', $reservation->guests_count) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" min="1">
            </div>

            <!-- Booking Info Group -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Type de Réservation</label>
                <input type="text" name="reservation_type" value="{{ old('reservation_type', $reservation->reservation_type) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nom de l'établissement / Service</label>
                <input type="text" name="item_name" value="{{ old('item_name', $reservation->item_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Date d'arrivée *</label>
                <input type="date" name="check_in" value="{{ old('check_in', \Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Date de départ *</label>
                <input type="date" name="check_out" value="{{ old('check_out', \Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            
            <!-- Pricing Group -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Montant avance (€)</label>
                <input type="number" step="0.01" name="advance_payment" value="{{ old('advance_payment', $reservation->advance_payment) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">TOTAL (€)</label>
                <input type="number" step="0.01" name="total_payment" value="{{ old('total_payment', $reservation->total_payment) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">
            </div>
            
            <!-- Status & Action (Hiding explicit dropdown to use dedicated buttons) -->
            <div class="col-span-1 md:col-span-2">
                <input type="hidden" name="status" value="{{ $reservation->status }}">
                <p class="text-sm text-gray-700"><strong>Statut Actuel :</strong> 
                    @if($reservation->status === 'pending')
                        <span class="text-yellow-600 font-bold">En attente</span>
                    @elseif($reservation->status === 'confirmed')
                        <span class="text-green-600 font-bold">Confirmée</span>
                    @elseif($reservation->status === 'cancelled')
                        <span class="text-red-600 font-bold">Annulée</span>
                    @else
                        {{ ucfirst($reservation->status) }}
                    @endif
                </p>
                <div class="mt-4 flex flex-wrap gap-4 items-center justify-end">
                    
                    <button type="submit" name="action" value="test_pdf" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-200">
                        <i class="fas fa-envelope mr-2"></i> Envoyer Test PDF à l'Admin
                    </button>
                    
                    @if($reservation->status !== 'confirmed')
                        <button type="submit" onclick="this.form.status.value='confirmed';" name="action" value="save" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-200 shadow-lg flex items-center">
                            <i class="fas fa-check-circle mr-2"></i> Confirmer & Envoyer PDF Client
                        </button>
                    @endif
                    
                    <button type="submit" name="action" value="save" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-200">
                        Enregistrer (Sans envoyer de PDF)
                    </button>
                    
                    @if($reservation->status !== 'cancelled')
                        <button type="submit" onclick="this.form.status.value='cancelled';" name="action" value="save" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-200">
                            Annuler la réservation
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
