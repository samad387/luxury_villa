@extends('layouts.admin')

@section('title', 'Modifier Yacht')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">✏️ Modifier Yacht</h2>
        <a href="{{ route('admin.yachts.index') }}" class="text-gray-600 hover:text-gray-800">
            ← Retour à la liste
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.yachts.update', $yacht) }}"
          class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nom du yacht *</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name', $yacht->name) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Capacité (passagers) *</label>
                <input type="number" 
                       name="capacity" 
                       value="{{ old('capacity', $yacht->capacity) }}"
                       min="1"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Longueur (mètres) *</label>
                <input type="number" 
                       name="length_meters" 
                       value="{{ old('length_meters', $yacht->length_meters) }}"
                       step="0.1"
                       min="0"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Prix par jour (MAD) *</label>
            <input type="number" 
                   name="price_per_day" 
                   value="{{ old('price_per_day', $yacht->price_per_day) }}"
                   step="0.01"
                   min="0"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
            <textarea name="description" 
                      rows="5"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      required>{{ old('description', $yacht->description) }}</textarea>
        </div>

        <!-- Existing Images -->
        @if($yacht->images->isNotEmpty() || $yacht->image)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Images actuelles :</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($yacht->images as $image)
                    <div class="relative group rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Yacht Image" class="w-full h-32 object-cover transition-transform duration-200 transform group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <label class="text-white flex items-center cursor-pointer">
                                <input type="checkbox" name="existing_images_to_delete[]" value="{{ $image->id }}" class="form-checkbox h-5 w-5 text-red-600 rounded">
                                <span class="ml-2 text-sm">Supprimer</span>
                            </label>
                        </div>
                    </div>
                @endforeach
                @if($yacht->image && $yacht->images->isEmpty())
                    <div class="relative group rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('storage/' . $yacht->image) }}" alt="Yacht Image" class="w-full h-32 object-cover transition-transform duration-200 transform group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="text-white text-sm">Ancienne image</span>
                        </div>
                    </div>
                @endif
            </div>
            <p class="text-gray-500 text-sm mt-2">Cochez la case sur une image pour la supprimer lors de l'enregistrement.</p>
        </div>
        @endif

        <!-- New Image Upload Field (Multiple) -->
        <div class="mb-6">
            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Ajouter de nouvelles images (Max 2MB chacune) :</label>
            <input type="file" 
                   name="images[]" 
                   id="images" 
                   multiple 
                   accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <p class="mt-1 text-sm text-gray-500">Format accepté: JPG, PNG, GIF, WEBP (max 2MB par image). Vous pouvez sélectionner plusieurs images à la fois.</p>
            <div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- New image previews will be dynamically added here by JavaScript -->
            </div>
        </div>

        <div class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" 
                   name="active" 
                   value="1" 
                   id="active"
                   {{ old('active', $yacht->active) ? 'checked' : '' }}
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="active" class="ml-2 block text-sm text-gray-700">
                Yacht actif (affiché sur le site public)
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-medium text-lg">
                <i class="fas fa-save mr-2"></i> Update Yacht
            </button>
            <a href="{{ route('admin.yachts.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-medium">
                Annuler
            </a>
        </div>
    </form>
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
                        attachRemoveListeners();
                    }
                };
                reader.readAsDataURL(file);
            });
        }

        function attachRemoveListeners() {
            document.querySelectorAll('.remove-image-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    currentFiles.splice(index, 1);
                    updateFileInput();
                    renderImagePreviews();
                });
            });
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            currentFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }

        imageInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                Array.from(this.files).forEach(file => {
                    if (!currentFiles.some(f => f.name === file.name && f.size === file.size)) {
                        currentFiles.push(file);
                    }
                });
                updateFileInput();
                renderImagePreviews();
            }
        });
    });
</script>
@endpush

