@extends('layouts.admin')

@section('title', 'Modifier une activité')

@section('content')
<style>
    .edit-activity-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .form-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }
    .form-body {
        padding: 2rem;
    }
    .form-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #f0f0f0;
    }
    .form-section:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .section-title i {
        color: #667eea;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    .image-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 3px solid transparent;
        transition: all 0.3s;
    }
    .image-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    .image-item.selected {
        border-color: #ef4444;
    }
    .image-item img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        display: block;
    }
    .image-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .image-item:hover .image-overlay {
        opacity: 1;
    }
    .image-checkbox {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 24px;
        height: 24px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        z-index: 10;
    }
    .image-checkbox input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #ef4444;
    }
    .delete-label {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    .preview-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .preview-item img {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }
    .preview-remove {
        position: absolute;
        top: 8px;
        right: 8px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: transform 0.2s;
    }
    .preview-remove:hover {
        transform: scale(1.1);
    }
    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        background: #f7fafc;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
    }
    .file-input-label:hover {
        border-color: #667eea;
        background: #edf2f7;
    }
    .file-input-label i {
        font-size: 2rem;
        color: #667eea;
        margin-right: 0.75rem;
    }
    .file-input-label span {
        color: #4a5568;
        font-weight: 500;
    }
    input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    .action-bar {
        position: sticky;
        bottom: 0;
        background: white;
        border-top: 2px solid #e0e0e0;
        padding: 1.5rem 2rem;
        margin: 2rem -2rem -2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
    }
    .btn-update {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 2.5rem;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
    }
    .btn-cancel {
        background: #e2e8f0;
        color: #4a5568;
        padding: 1rem 2rem;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-cancel:hover {
        background: #cbd5e0;
    }
    .info-text {
        color: #718096;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-text i {
        color: #667eea;
    }
    @media (max-width: 768px) {
        .edit-activity-container {
            padding: 1rem 0.5rem;
        }
        .form-body {
            padding: 1.5rem;
        }
        .form-header {
            padding: 1rem 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .images-grid,
        .preview-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        }
        .action-bar {
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
        }
        .btn-update,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="edit-activity-container">
    <div class="form-card">
        <div class="form-header">
            <h1>
                <i class="fas fa-edit mr-2"></i>
                Modifier l'activité
            </h1>
            <a href="{{ route('admin.activities.index') }}" class="text-white hover:text-gray-200 transition">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 m-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 m-4 rounded">
                <div class="font-bold mb-2">Erreurs de validation :</div>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-body">
                <!-- Informations générales -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Informations générales
                    </h2>
                    
                    <div class="form-group">
                        <label for="nom">Nom de l'activité *</label>
                        <input type="text" 
                               id="nom" 
                               name="nom" 
                               value="{{ old('nom', $activity->nom) }}" 
                               required
                               placeholder="Ex: Balade en montgolfière">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="5"
                                  placeholder="Décrivez l'activité en détail...">{{ old('description', $activity->description) }}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="prix">Prix (MAD)</label>
                            <input type="number" 
                                   id="prix" 
                                   name="prix" 
                                   step="0.01" 
                                   value="{{ old('prix', $activity->prix) }}"
                                   placeholder="0.00">
                        </div>
                        
                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <input type="text" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category', $activity->category) }}"
                                   placeholder="Ex: Aventure, Détente...">
                        </div>
                    </div>
                </div>

                <!-- Images existantes -->
                @if($activity->images && $activity->images->isNotEmpty())
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-images"></i>
                        Images existantes ({{ $activity->images->count() }})
                    </h2>
                    <p class="info-text">
                        <i class="fas fa-info-circle"></i>
                        Survolez une image et cochez la case pour la supprimer lors de la mise à jour.
                    </p>
                    
                    <div class="images-grid">
                        @foreach ($activity->images as $image)
                            <div class="image-item" id="image-{{ $image->id }}">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="Image">
                                <div class="image-checkbox">
                                    <input type="checkbox" 
                                           name="existing_images_to_delete[]" 
                                           value="{{ $image->id }}"
                                           id="delete-{{ $image->id }}"
                                           onchange="toggleImageSelection({{ $image->id }})">
                                </div>
                                <div class="image-overlay">
                                    <label for="delete-{{ $image->id }}" class="delete-label">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Supprimer</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Ajouter de nouvelles images -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-plus-circle"></i>
                        Ajouter de nouvelles images
                    </h2>
                    
                    <div class="file-input-wrapper">
                        <label class="file-input-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Cliquez pour sélectionner des images ou glissez-déposez ici</span>
                        </label>
                        <input type="file" 
                               name="images[]" 
                               id="images" 
                               multiple 
                               accept="image/*">
                    </div>
                    
                    <p class="info-text">
                        <i class="fas fa-info-circle"></i>
                        Formats acceptés: JPG, PNG, GIF, WEBP (max 2MB par image). Vous pouvez sélectionner plusieurs images.
                    </p>
                    
                    <div id="image-preview" class="preview-grid">
                        <!-- Aperçus des nouvelles images -->
                    </div>
                </div>
            </div>

            <!-- Barre d'actions fixe en bas -->
            <div class="action-bar">
                <div>
                    <span class="text-gray-600 text-sm">
                        <i class="fas fa-save mr-1"></i>
                        N'oubliez pas de sauvegarder vos modifications
                    </span>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.activities.index') }}" class="btn-cancel">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i>
                        Mettre à jour l'activité
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleImageSelection(imageId) {
        const imageItem = document.getElementById('image-' + imageId);
        const checkbox = document.getElementById('delete-' + imageId);
        if (checkbox.checked) {
            imageItem.classList.add('selected');
        } else {
            imageItem.classList.remove('selected');
        }
    }

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
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" 
                                data-index="${index}" 
                                class="preview-remove remove-preview-btn"
                                title="Retirer cette image">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    imagePreviewContainer.appendChild(previewItem);
                    loadedImages++;
                    if (loadedImages === currentFiles.length) {
                        attachRemoveListeners();
                    }
                };
                reader.readAsDataURL(file);
            });
        }

        function attachRemoveListeners() {
            document.querySelectorAll('.remove-preview-btn').forEach(btn => {
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

        if (imageInput) {
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
        }
    });
</script>
@endsection
