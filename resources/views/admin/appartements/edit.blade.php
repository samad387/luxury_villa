@extends('layouts.admin')

@section('title', 'Edit appartement: ' . $appartement->name)

@section('content')
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit appartement: <span class="text-indigo-600">{{ $appartement->name }}</span></h2>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.appartements.update', $appartement->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div class="mb-5">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">appartement Name:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('name') border-red-500 @enderror" value="{{ old('name', $appartement->name) }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="mb-5">
                    <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price (MAD):</label>
                    <input type="number" name="price" id="price" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('price') border-red-500 @enderror" value="{{ old('price', $appartement->price) }}" step="0.01" required>
                    @error('price')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacity Field -->
                <div class="mb-5">
                    <label for="capacity" class="block text-gray-700 text-sm font-bold mb-2">Capacity:</label>
                    <input type="number" name="capacity" id="capacity" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('capacity') border-red-500 @enderror" value="{{ old('capacity', $appartement->capacity) }}" required>
                    @error('capacity')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-5">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                    <textarea name="description" id="description" rows="5" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('description') border-red-500 @enderror">{{ old('description', $appartement->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Geo-Emplacement Field -->
                <div class="mb-5">
                    <label for="geo_emplacement" class="block text-gray-700 text-sm font-bold mb-2">Geo-Emplacement (e.g., Lat,Lng):</label>
                    <input type="text" name="geo_emplacement" id="geo_emplacement" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('geo_emplacement') border-red-500 @enderror" value="{{ old('geo_emplacement', $appartement->geo_emplacement) }}" placeholder="e.g., 31.6295, -7.9811">
                    <p class="text-gray-500 text-xs mt-1">Enter Latitude and Longitude separated by a comma (e.g., 34.020882, -6.84165).</p>
                    @error('geo_emplacement')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Existing Images -->
                @if($appartement->images->isNotEmpty())
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Current Images:</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach ($appartement->images as $image)
                            <div class="relative group rounded-lg overflow-hidden shadow-md">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="appartement Image" class="w-full h-32 object-cover transition-transform duration-200 transform group-hover:scale-105">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <label class="text-white flex items-center cursor-pointer">
                                        <input type="checkbox" name="existing_images_to_delete[]" value="{{ $image->id }}" class="form-checkbox h-5 w-5 text-red-600 rounded">
                                        <span class="ml-2">Delete</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-gray-500 text-sm mt-2">Check the box on an image to mark it for deletion upon saving.</p>
                </div>
                @endif

                <!-- New Image Upload Field (Multiple) -->
                <div class="mb-6">
                    <label for="images" class="block text-gray-700 text-sm font-bold mb-2">Add New Images (Max 2MB each):</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition duration-200 @error('images.*') border-red-500 @enderror">
                    @error('images.*')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                    <div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- New image previews will be dynamically added here by JavaScript -->
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i> Update appartement
                    </button>
                    <a href="{{ route('admin.appartements.index') }}" class="ml-4 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 text-lg font-semibold rounded-lg shadow-md transition duration-200 ease-in-out">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('images');
        const imagePreviewContainer = document.getElementById('image-preview');

        imageInput.addEventListener('change', function() {
            imagePreviewContainer.innerHTML = ''; // Clear previous previews
            if (this.files && this.files.length > 0) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgWrapper = document.createElement('div');
                        imgWrapper.className = 'relative group';
                        imgWrapper.innerHTML = `
                            <img src="${e.target.result}" alt="New Image Preview" class="w-full h-32 object-cover rounded-md shadow-md">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-md">
                                <span class="text-white text-xs px-2 py-1 bg-gray-800 bg-opacity-75 rounded-md">${file.name}</span>
                            </div>
                        `;
                        imagePreviewContainer.appendChild(imgWrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endpush
