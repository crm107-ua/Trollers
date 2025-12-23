<style>
    .upload-story-container {
        min-height: 100vh;
        background: #0a0a0a;
        padding: 100px 20px 40px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .upload-card {
        background: #1a1a1a;
        border-radius: 20px;
        padding: 40px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .upload-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .back-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #fff;
        text-decoration: none;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(-3px);
    }

    .upload-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #fff;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .form-group {
        margin-bottom: 30px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 10px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .form-input {
        width: 100%;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #fff;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #2563eb;
        background: rgba(255, 255, 255, 0.08);
    }

    .upload-area {
        position: relative;
        width: 100%;
        min-height: 300px;
        border: 2px dashed rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .upload-area:hover {
        border-color: #2563eb;
        background: rgba(37, 99, 235, 0.05);
    }

    .upload-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 300px;
        color: rgba(255, 255, 255, 0.6);
        text-align: center;
        padding: 20px;
    }

    .upload-placeholder svg {
        margin-bottom: 20px;
        opacity: 0.4;
    }

    .upload-placeholder p {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: rgba(255, 255, 255, 0.8);
    }

    .upload-placeholder span {
        font-size: 14px;
        opacity: 0.7;
    }

    .image-preview {
        position: relative;
        width: 100%;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
        border-radius: 16px;
    }

    .remove-image {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        background: rgba(0, 0, 0, 0.8);
        border: none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .remove-image:hover {
        background: #ef4444;
        transform: scale(1.1);
    }

    .upload-info {
        margin-top: 10px;
    }

    .upload-info small {
        color: rgba(255, 255, 255, 0.5);
        font-size: 13px;
    }

    .form-actions {
        margin-top: 40px;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        border: none;
        border-radius: 12px;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .spinner {
        animation: spin 1s linear infinite;
        display: inline-block;
        margin-right: 8px;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .upload-story-container {
            padding: 80px 15px 30px;
        }

        .upload-card {
            padding: 25px;
        }

        .upload-header h1 {
            font-size: 24px;
        }

        .upload-area {
            min-height: 250px;
        }

        .upload-placeholder {
            height: 250px;
        }
    }
</style>
