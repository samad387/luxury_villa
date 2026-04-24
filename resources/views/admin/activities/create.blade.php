@extends('layouts.admin')

@section('title', 'Ajouter une activité')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Ajouter une activité</h2>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

                <!-- Nom Field -->
                <div class="mb-5">
                    <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom de l'activité:</label>
                    <input type="text" name="nom" id="nom" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('nom') border-red-500 @enderror" value="{{ old('nom') }}" required>
                    @error('nom')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-5">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                    <textarea name="description" id="description" rows="5" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
        </div>

                <!-- Prix Field -->
                <div class="mb-5">
                    <label for="prix" class="block text-gray-700 text-sm font-bold mb-2">Prix (MAD):</label>
                    <input type="number" step="0.01" name="prix" id="prix" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('prix') border-red-500 @enderror" value="{{ old('prix') }}">
                    @error('prix')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
        </div>

                <!-- Catégorie Field -->
                <div class="mb-5">
                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Catégorie:</label>
                    <input type="text" name="category" id="category" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('category') border-red-500 @enderror" value="{{ old('category', $category ?? '') }}" placeholder="Ex: Sport, Culture, Aventure">
                    @error('category')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
        </div>

                <!-- Image Upload Field (Multiple) -->
                <div class="mb-6">
                    <label for="images" class="block text-gray-700 text-sm font-bold mb-2">Upload Images (Max 2MB each, multiple images autorisées):</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition duration-200 @error('images.*') border-red-500 @enderror">
                    @error('images.*')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                    <div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Image previews will be dynamically added here by JavaScript -->
        </div>
        </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end">
                    <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white text-lg font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.activities.index') }}" class="ml-4 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 text-lg font-semibold rounded-lg shadow-md transition duration-200 ease-in-out">
                        Annuler
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
        let currentFiles = [];

        function renderImagePreviews() {
            imagePreviewContainer.innerHTML = '';
            let loadedImages = 0;

            currentFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'relative group';
                    imgWrapper.innerHTML = `
                        <img src="${e.target.result}" alt="Image Preview" class="w-full h-32 object-cover rounded-md shadow-md">
                        <button type="button" data-index="${index}" class="z-40 remove-image-btn absolute top-2 right-2 bg-red-600 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-md">
                            <span class="text-white text-xs px-2 py-1 bg-gray-800 bg-opacity-75 rounded-md">${file.name}</span>
                        </div>
                    `;
                    imagePreviewContainer.appendChild(imgWrapper);

                    loadedImages++;
                    if (loadedImages === currentFiles.length) {
                        attachRemoveButtonListeners();
                    }
                };
                reader.readAsDataURL(file);
            });

            if (currentFiles.length === 0) {
                attachRemoveButtonListeners();
            }
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            currentFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }

        function attachRemoveButtonListeners() {
            document.querySelectorAll('.remove-image-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const indexToRemove = parseInt(this.dataset.index);
                    currentFiles.splice(indexToRemove, 1);
                    updateFileInput();
                    renderImagePreviews();
                });
            });
        }

        imageInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                Array.from(this.files).forEach(file => {
                    currentFiles.push(file);
                });
            }
            renderImagePreviews();
            updateFileInput();
        });
    });
</script>
@endpush







