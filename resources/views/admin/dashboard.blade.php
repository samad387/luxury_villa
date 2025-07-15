@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Villas -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
            <div>
                <h3 class="text-gray-500 text-sm font-medium uppercase mb-2">Total Villas</h3>
                <p class="text-3xl font-bold text-gray-900">{{ App\Models\Villa::count() }}</p>
            </div>
            <div class="text-indigo-500 text-4xl">
                <i class="fas fa-hotel"></i>
            </div>
        </div>
        <!-- Riads -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
            <div>
                <h3 class="text-gray-500 text-sm font-medium uppercase mb-2">Total Riads</h3>
                <p class="text-3xl font-bold text-gray-900">{{ App\Models\Riad::count() }}</p>
            </div>
            <div class="text-green-500 text-4xl">
                <i class="fas fa-building"></i>
            </div>
        </div>
        <!-- Appartements -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
            <div>
                <h3 class="text-gray-500 text-sm font-medium uppercase mb-2">Total Appartements</h3>
                <p class="text-3xl font-bold text-gray-900">{{ App\Models\Appartement::count() }}</p>
            </div>
            <div class="text-purple-500 text-4xl">
                <i class="fas fa-city"></i>
            </div>
        </div>
        <!-- Location Voiture -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
            <div>
                <h3 class="text-gray-500 text-sm font-medium uppercase mb-2">Total Location Voiture</h3>
                <p class="text-3xl font-bold text-gray-900">{{ App\Models\Transport::where('type', 'voiture')->count() }}</p>
            </div>
            <div class="text-blue-500 text-4xl">
                <i class="fas fa-car-side"></i>
            </div>
        </div>
        <!-- Location Moto -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
            <div>
                <h3 class="text-gray-500 text-sm font-medium uppercase mb-2">Total Location Moto</h3>
                <p class="text-3xl font-bold text-gray-900">{{ App\Models\Transport::where('type', 'moto')->count() }}</p>
            </div>
            <div class="text-orange-500 text-4xl">
                <i class="fas fa-motorcycle"></i>
            </div>
        </div>
        <!-- VIP Transport -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
            <div>
                <h3 class="text-gray-500 text-sm font-medium uppercase mb-2">Total VIP Transport</h3>
                <p class="text-3xl font-bold text-gray-900">{{ App\Models\Transport::where('type', 'vip')->count() }}</p>
            </div>
            <div class="text-yellow-500 text-4xl">
                <i class="fas fa-crown"></i>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.villas.create') }}" class="flex items-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                <i class="fas fa-plus-circle"></i>
                <span>Add New Villa</span>
            </a>
            <a href="{{ route('admin.riads.create') }}" class="flex items-center space-x-2 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200">
                <i class="fas fa-plus-circle"></i>
                <span>Add New Riad</span>
            </a>
            <a href="{{ route('admin.appartements.create') }}" class="flex items-center space-x-2 px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 transition duration-200">
                <i class="fas fa-plus-circle"></i>
                <span>Add New Appartement</span>
            </a>
            <!-- Ajout des actions pour les transports -->
            <a href="{{ route('admin.transports.create', ['type' => 'voiture']) }}" class="flex items-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                <i class="fas fa-plus-circle"></i>
                <span>Ajouter Location Voiture</span>
            </a>
            <a href="{{ route('admin.transports.create', ['type' => 'moto']) }}" class="flex items-center space-x-2 px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition duration-200">
                <i class="fas fa-plus-circle"></i>
                <span>Ajouter Location Moto</span>
            </a>
            <a href="{{ route('admin.transports.create', ['type' => 'vip']) }}" class="flex items-center space-x-2 px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-200">
                <i class="fas fa-plus-circle"></i>
                <span>Ajouter VIP Transport</span>
            </a>
        </div>
    </div>
@endsection
