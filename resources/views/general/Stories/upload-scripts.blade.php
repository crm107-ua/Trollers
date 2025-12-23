<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('upload-area');
    const imageInput = document.getElementById('image-input');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const previewVideo = document.getElementById('preview-video');
    const removeImageBtn = document.getElementById('remove-image');
    const form = document.getElementById('story-upload-form');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    const submitLoading = document.getElementById('submit-loading');
    const durationInput = document.getElementById('duration-input');
    const videoDurationInfo = document.getElementById('video-duration-info');
    const videoDurationText = document.getElementById('video-duration-text');
    const userSelector = document.getElementById('user_id');
    const userPreview = document.getElementById('selected-user-preview');
    const userPreviewImg = document.getElementById('selected-user-img');
    const userPreviewName = document.getElementById('selected-user-name');

    let currentFileType = null;

    // User selector change handler
    if (userSelector) {
        userSelector.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const userImage = selectedOption.getAttribute('data-image');
            const userName = selectedOption.text;
            
            if (this.value && userImage) {
                userPreviewImg.src = userImage;
                userPreviewName.textContent = userName;
                userPreview.style.display = 'flex';
            } else {
                userPreview.style.display = 'none';
            }
        });
    }

    // Click to upload
    uploadArea.addEventListener('click', (e) => {
        if (e.target.id !== 'remove-image' && !e.target.closest('.remove-image')) {
            imageInput.click();
        }
    });

    // File input change
    imageInput.addEventListener('change', handleFileSelect);

    // Drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#2563eb';
        uploadArea.style.background = 'rgba(37, 99, 235, 0.1)';
    });

    uploadArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'rgba(255, 255, 255, 0.2)';
        uploadArea.style.background = 'transparent';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'rgba(255, 255, 255, 0.2)';
        uploadArea.style.background = 'transparent';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleFileSelect();
        }
    });

    // Remove media
    removeImageBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        imageInput.value = '';
        imagePreview.style.display = 'none';
        uploadPlaceholder.style.display = 'flex';
        previewImg.style.display = 'none';
        previewVideo.style.display = 'none';
        videoDurationInfo.style.display = 'none';
        currentFileType = null;
    });

    // Handle file selection
    function handleFileSelect() {
        const file = imageInput.files[0];
        if (!file) return;

        // Validate file size (200MB)
        if (file.size > 200 * 1024 * 1024) {
            alert('El archivo es demasiado grande. Máximo 200MB');
            return;
        }

        // Detect file type
        currentFileType = file.type.startsWith('video') ? 'video' : 'image';

        if (currentFileType === 'video') {
            handleVideoSelect(file);
        } else if (currentFileType === 'image') {
            handleImageSelect(file);
        } else {
            alert('Por favor selecciona una imagen o video válido');
        }
    }

    // Handle image selection
    function handleImageSelect(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.style.display = 'block';
            previewVideo.style.display = 'none';
            videoDurationInfo.style.display = 'none';
            uploadPlaceholder.style.display = 'none';
            imagePreview.style.display = 'flex';
            
            // Compress image
            compressImage(e.target.result);
        };
        reader.readAsDataURL(file);
    }

    // Handle video selection
    function handleVideoSelect(file) {
        const video = document.createElement('video');
        video.preload = 'metadata';
        
        video.onloadedmetadata = function() {
            window.URL.revokeObjectURL(video.src);
            const duration = Math.floor(video.duration);
            
            // Check duration (max 120 seconds = 2 minutes)
            if (duration > 120) {
                alert('El video es demasiado largo. Máximo 2 minutos');
                imageInput.value = '';
                return;
            }
            
            // Update UI
            previewVideo.src = URL.createObjectURL(file);
            previewVideo.style.display = 'block';
            previewImg.style.display = 'none';
            uploadPlaceholder.style.display = 'none';
            imagePreview.style.display = 'flex';
            videoDurationInfo.style.display = 'block';
            videoDurationText.textContent = duration;
            durationInput.value = duration;
        };
        
        video.src = URL.createObjectURL(file);
    }

    // Compress image using canvas
    function compressImage(base64Image) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            
            // Calculate new dimensions (max 1080px width/height)
            let width = img.width;
            let height = img.height;
            const maxSize = 1080;
            
            if (width > height && width > maxSize) {
                height = (height * maxSize) / width;
                width = maxSize;
            } else if (height > maxSize) {
                width = (width * maxSize) / height;
                height = maxSize;
            }
            
            canvas.width = width;
            canvas.height = height;
            
            // Draw image
            ctx.drawImage(img, 0, 0, width, height);
            
            // Convert to blob and create new file
            canvas.toBlob(function(blob) {
                const compressedFile = new File([blob], imageInput.files[0].name, {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                });
                
                // Create new FileList
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(compressedFile);
                imageInput.files = dataTransfer.files;
                
                console.log('Image compressed:', (blob.size / 1024).toFixed(2) + 'KB');
            }, 'image/jpeg', 0.8); // 80% quality
        };
        img.src = base64Image;
    }

    // Form submit
    form.addEventListener('submit', function(e) {
        // Validate
        if (currentFileType === 'video') {
            const duration = parseInt(durationInput.value);
            if (duration > 120) {
                e.preventDefault();
                alert('El video es demasiado largo. Máximo 2 minutos');
                return;
            }
        }
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.style.display = 'none';
        submitLoading.style.display = 'inline-flex';
    });
});
</script>
