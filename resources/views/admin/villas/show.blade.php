@extends('layouts.admin')

@section('title', 'Villa Details: ' . $villa->name)

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Villa: <span class="text-indigo-600">{{ $villa->name }}</span></h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.villas.edit', $villa->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded-md shadow-sm transition duration-200 ease-in-out">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('admin.villas.destroy', $villa->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this villa? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-md shadow-sm transition duration-200 ease-in-out">
                        <i class="fas fa-trash-alt mr-2"></i> Delete
                    </button>
                </form>
                <a href="{{ route('admin.villas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-md shadow-sm transition duration-200 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Villa Details -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Details</h3>
                    <div class="space-y-3 text-gray-700">
                        <p><strong class="font-medium">Price:</strong> {{ number_format($villa->price, 2) }} MAD</p>
                        <p><strong class="font-medium">Capacity:</strong> {{ $villa->capacity }} people</p>
                        <p><strong class="font-medium">Description:</strong> {{ $villa->description ?? 'N/A' }}</p>
                        <p><strong class="font-medium">Geo-Emplacement:</strong> {{ $villa->geo_emplacement ?? 'N/A' }}</p>
                        <p><strong class="font-medium">Created At:</strong> {{ $villa->created_at->format('M d, Y H:i') }}</p>
                        <p><strong class="font-medium">Last Updated:</strong> {{ $villa->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <!-- Villa Images Gallery -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Images</h3>
                    @if ($villa->images->isNotEmpty())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($villa->images as $image)
                                <a href="{{ asset('storage/' . $image->path) }}" target="_blank" class="block rounded-lg overflow-hidden shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $villa->name }} Image" class="w-full h-32 object-cover">
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No images available for this villa.</p>
                    @endif
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Location on Map</h3>
                @if ($villa->geo_emplacement && $villa->coordinates)
                    <div id="mapid" class="w-full rounded-lg shadow-md" style="height: 400px;"></div>
                @else
                    <p class="text-gray-500">No geographical location provided for this villa to display on a map.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@if ($villa->geo_emplacement && $villa->coordinates)
<script>
    console.log("Hello world")
    console.log('coordinates', {{ Js::from($villa->coordinates) }});
        document.addEventListener('DOMContentLoaded', function() {
        const coords = {{ Js::from($villa->coordinates) }};
        console.log(coords);
         // Laravel's Js facade for secure JSON
        const mapElement = document.getElementById('mapid');

        if (coords.lat && coords.lng && mapElement) {
            // Initialize the map
            const map = L.map('mapid').setView([coords.lat, coords.lng], 13); // 13 is zoom level

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add a marker to the location
            L.marker([coords.lat, coords.lng]).addTo(map)
                .bindPopup('<b>{{ $villa->name }}</b><br>{{ $villa->geo_emplacement }}')
                .openPopup();
        }
    });
</script>
@endif
@endpush
