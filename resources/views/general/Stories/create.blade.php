<!DOCTYPE html>
<html lang="es">
@include('general.Head.head')
<body>
    <div class="site-wrap">
        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        @include('general.Header.header')
        @include('general.Stories.upload-estilos')

        <main class="upload-story-container">
            <div class="upload-card">
                <div class="upload-header">
                    <a href="{{ route('home') }}" class="back-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h1>Crear Story</h1>
                </div>

                <form id="story-upload-form" action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="user_id">Selecciona usuario</label>
                        <select 
                            id="user_id" 
                            name="user_id" 
                            class="form-input user-selector" 
                            required
                        >
                            <option value="">Selecciona un usuario</option>
                            @foreach($users as $user)
                                @if($user->name != 'Grupal')
                                <option 
                                    value="{{ $user->id }}" 
                                    data-image="{{ $user->imagen ? '/images//perfiles/' . $user->imagen : '' }}"
                                >
                                    {{ $user->name }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                        <div id="selected-user-preview" style="display: none; margin-top: 12px; align-items: center; gap: 12px;">
                            <img id="selected-user-img" src="" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #2563eb;">
                            <span id="selected-user-name" style="color: #fff; font-weight: 500;"></span>
                        </div>
                    </div>

                    <input type="hidden" name="duration" id="duration-input" value="">

                    <div class="form-group">
                        <label>Imagen o Video</label>
                        <div class="upload-area" id="upload-area">
                            <input 
                                type="file" 
                                id="image-input" 
                                name="image" 
                                accept="image/*,video/*" 
                                required
                                hidden
                            >
                            <div class="upload-placeholder" id="upload-placeholder">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                <p>Click para seleccionar</p>
                                <span>Imagen o video (máx 2min)</span>
                            </div>
                            <div class="image-preview" id="image-preview" style="display: none;">
                                <img id="preview-img" src="" alt="Preview" style="display: none;">
                                <video id="preview-video" controls style="display: none; max-width: 100%; max-height: 500px; border-radius: 16px;"></video>
                                <button type="button" class="remove-image" id="remove-image">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="upload-info">
                            <small>Imágenes: JPG, PNG, GIF | Videos: MP4, WebM, MOV (máx 2min) | Máximo 200MB</small>
                            <div id="video-duration-info" style="display: none; margin-top: 8px;">
                                <small style="color: #2563eb;">Duración: <span id="video-duration-text">0</span>s</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit" id="submit-btn">
                            <span id="submit-text">Publicar Story</span>
                            <span id="submit-loading" style="display: none;">
                                <svg class="spinner" width="20" height="20" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="3"/>
                                </svg>
                                Subiendo...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </main>

        @include('general.Stories.upload-scripts')
        @include('general.Links.scripts')
    </div>
</body>
</html>
