@php
    use App\Models\Story;
    use App\Models\StoryView;
    use Carbon\Carbon;
    
    // Get stories from last 24 hours
    $twentyFourHoursAgo = Carbon::now()->subHours(24);
    $stories = Story::with(['user', 'views'])->where('created_at', '>=', $twentyFourHoursAgo)
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Get IDs of viewed stories for current user
    $viewedStoryIds = [];
    if (auth()->check()) {
        $viewedStoryIds = StoryView::where('user_id', auth()->id())
            ->pluck('story_id')
            ->toArray();
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<style>
    .stories-container {
        background: #000;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stories-scroll {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        padding: 10px 20px;
        scrollbar-width: none;
    }

    .stories-scroll::-webkit-scrollbar {
        display: none;
    }

    .story-circle {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .story-circle:hover {
        transform: scale(1.05);
    }

    .story-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        padding: 3px;
        background: linear-gradient(45deg, #2563eb, #3b82f6, #60a5fa);
        position: relative;
    }

    .story-avatar.viewed {
        background: rgba(255, 255, 255, 0.2);
    }

    .story-avatar.add-story {
        background: rgba(255, 255, 255, 0.1);
    }

    .story-avatar-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        border: 3px solid #000;
        position: relative;
    }

    .story-avatar-inner.video::after {
        content: '▶';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 20px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.5);
    }

    .story-avatar-inner.add {
        background: rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .story-avatar-inner.add svg {
        width: 32px;
        height: 32px;
        color: #2563eb;
    }

    .content-type-badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 24px;
        height: 24px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #000;
    }

    .content-type-badge svg {
        width: 12px;
        height: 12px;
        color: #fff;
    }

    .story-name {
        font-size: 12px;
        color: #fff;
        max-width: 80px;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: 500;
    }

    /* Modal Styles */
    .stories-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        z-index: 10000;
        overflow: hidden;
    }

    .stories-modal.active {
        display: block;
    }

    .story-viewer {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .story-media {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* Desktop Improvements for Story Viewer */
    @media (min-width: 769px) {
        .story-media {
            max-width: 450px; /* Limit width on desktop to mimic mobile feeling */
            width: 100%;
            height: auto;
            max-height: 90vh; /* Ensure it fits vertically */
            border-radius: 12px; /* Smooth corners */
            box-shadow: 0 4px 20px rgba(0,0,0,0.5); /* Shadow for depth */
        }
        
        .story-viewer {
            background: #000; /* Ensure background is black */
        }
    }

    .story-header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, transparent 100%);
        z-index: 10001;
    }

    .story-progress-bars {
        display: flex;
        gap: 4px;
        margin-bottom: 15px;
    }

    .story-progress-bar {
        flex: 1;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
        overflow: hidden;
    }

    .story-progress-fill {
        height: 100%;
        width: 0%;
        background: #fff;
        transition: width 0.1s linear;
    }

    .story-progress-bar.completed .story-progress-fill {
        width: 100%;
    }

    .story-progress-bar.active .story-progress-fill {
        animation: progressAnim var(--duration, 5s) linear forwards;
    }

    @keyframes progressAnim {
        from { width: 0%; }
        to { width: 100%; }
    }

    .story-user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .story-user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #2563eb;
    }

    .story-user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .story-user-name {
        color: #fff;
        font-weight: 600;
        font-size: 15px;
    }

    .story-time {
        color: rgba(255, 255, 255, 0.7);
        font-size: 13px;
        margin-left: 0;
        font-weight: 400;
    }

    .story-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background: rgba(0, 0, 0, 0.5);
        border: none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10002;
        transition: all 0.3s ease;
    }

    .story-close:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .story-pause-btn {
        position: absolute;
        top: 20px;
        right: 70px;
        width: 40px;
        height: 40px;
        background: rgba(0, 0, 0, 0.5);
        border: none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10002;
        transition: all 0.3s ease;
    }

    .story-pause-btn:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .story-progress-bar.paused .story-progress-fill {
        animation-play-state: paused !important;
    }

    .story-nav {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 30%;
        cursor: pointer;
        z-index: 10001;
    }

    .story-nav-prev {
        left: 0;
    }

    .story-nav-next {
        right: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .story-avatar {
            width: 65px;
            height: 65px;
        }

        .story-name {
            font-size: 11px;
            max-width: 65px;
        }

        .stories-scroll {
            padding: 10px 15px;
        }
    }

    /* Comments Section - Desktop Horizontal Carousel */
    .comments-section {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(0deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.8) 40%, transparent 100%);
        padding: 80px 20px 20px 20px;
        z-index: 10001;
        max-height: 40vh; /* Controlled height */
        display: none; /* Default hidden, shown in desktop media query */
        flex-direction: column;
        justify-content: flex-end; /* Push content to bottom */
    }

    @media (min-width: 769px) {
        .comments-section {
            display: flex !important;
        }
    }

    .comments-carousel {
        overflow-x: auto;
        overflow-y: hidden;
        scrollbar-width: thin;
        margin-bottom: 20px;
        width: 100%;
        display: flex;
        align-items: flex-end;
        padding-bottom: 10px; /* Space for scrollbar */
    }

    .comments-carousel-inner {
        display: flex;
        flex-direction: row;
        gap: 15px;
        padding: 0 20px; /* Side padding */
    }

    .comments-carousel::-webkit-scrollbar {
        display: none;
    }

    .comments-carousel-inner {
        display: flex;
        gap: 12px;
        padding: 10px 0;
        min-width: 100%;
    }

    .comment-card {
        flex: 0 0 300px; /* Fixed width for horizontal scrolling */
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 16px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        animation: slideInComment 0.5s ease forwards;
        margin-right: 0; /* Handled by gap in container */
    }

    @keyframes slideInComment {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .comment-card:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
    }
    
    /* Ensure comments section is hidden on desktop but uses overlay instead */
    @media (min-width: 769px) {
        .comments-overlay-header, .comments-overlay-input {
            width: 100%;
            max-width: 700px;
        }
    }

    .comment-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .comment-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
    }

    .comment-user {
        font-weight: 600;
        color: #60a5fa;
        font-size: 14px;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .comment-time {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.5);
        flex-shrink: 0;
    }

    .comment-text {
        color: white;
        font-size: 14px;
        line-height: 1.5;
        word-wrap: break-word;
    }

    .comment-input-area {
        display: flex;
        gap: 10px;
        background: rgba(0, 0, 0, 0.5);
        padding: 12px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .comment-input {
        flex: 1;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 10px 14px;
        color: white;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .comment-input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .comment-input:focus {
        background: rgba(255, 255, 255, 0.12);
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    }

    .comment-name-input {
        flex: 0 0 120px;
    }

    .comment-submit-btn {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 8px;
        padding: 0 20px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .comment-submit-btn:hover {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }

    .comment-submit-btn:active {
        transform: translateY(0);
    }

    .empty-comments {
        text-align: center;
        padding: 30px 20px;
        color: rgba(255, 255, 255, 0.5);
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .comment-card {
            flex: 0 0 240px;
        }

        .comment-name-input {
            flex: 0 0 100px;
        }

        .comments-section {
            max-height: 50%;
        }


    /* Comments Overlay - Works on all screen sizes */
    /* Hide desktop comments section on all screens */
    /* .comments-section {
        display: none !important; 
    } REMOVED THIS to allow desktop section to show */

    /* Show Comments Button - Mobile Only */
    .show-comments-btn {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 25px;
        padding: 12px 24px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        z-index: 10003;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.4);
        transition: all 0.3s ease;
    }

    @media (min-width: 769px) {
        .show-comments-btn {
            display: none !important; /* Hide on desktop */
        }
    }

    .show-comments-btn:hover {
        transform: translateX(-50%) translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.6);
    }

    .show-comments-btn .comment-count {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 2px 8px;
        font-size: 12px;
        font-weight: 700;
    }

    /* Comments Overlay Modal - All screen sizes */
    .comments-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.92);
        z-index: 10004;
        overflow-y: auto;
        padding: 60px 16px 80px 16px;
        animation: fadeIn 0.3s ease;
    }

    .comments-overlay.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Desktop improvements - better max-width and centering */
    @media (min-width: 769px) {
        .comments-overlay {
            padding: 80px 20px 100px 20px;
            /* display property removed to prevent auto-show */
            flex-direction: column;
            align-items: center;
            display: none !important; /* Ensure it stays hidden on desktop unless we explicitly want it (which we don't anymore) */
        }
        
        /* Ensure overlay class with active state is also hidden on desktop */
        .comments-overlay.active {
            display: none !important;
        }

        /* Specific ID override to handle any JS forced display */
        #comments-overlay {
            display: none !important;
        }
        
        .comments-overlay-list {
            max-width: 700px;
            width: 100%;
        }
        
        .comments-overlay-header {
            left: 50% !important;
            right: auto !important;
            transform: translateX(-50%);
            max-width: 700px;
            width: calc(100% - 40px);
        }
        
        .comments-overlay-input {
            left: 50% !important;
            right: auto !important;
            transform: translateX(-50%);
            max-width: 700px;
            width: calc(100% - 40px);
        }
        
        .comment-card-overlay {
            padding: 16px;
        }
        
        .comment-card-overlay .comment-user {
            font-size: 14px;
        }
        
        .comment-card-overlay .comment-text {
            font-size: 14px;
        }
        
        .comment-card-overlay .comment-avatar {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Overlay Header */
    .comments-overlay-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.95);
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 10005;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .comments-overlay-title {
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    .comments-overlay-close {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .comments-overlay-close:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Overlay Comments List */
    .comments-overlay-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Compact Comment Card for Overlay */
    .comment-card-overlay {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        animation: slideInUp 0.3s ease forwards;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Add top margin to first comment in overlay */
    .comment-card-overlay:first-child {
        margin-top: 20px;
    }

    .comment-card-overlay .comment-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }

    .comment-card-overlay .comment-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 12px;
        flex-shrink: 0;
    }

    .comment-card-overlay .comment-user {
        font-weight: 600;
        color: #60a5fa;
        font-size: 13px;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .comment-card-overlay .comment-time {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.5);
        flex-shrink: 0;
    }

    .comment-card-overlay .comment-text {
        color: white;
        font-size: 13px;
        line-height: 1.5;
        word-wrap: break-word;
    }

    /* Load More Button */
    .load-more-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 12px 24px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        width: 100%;
        margin-top: 12px;
        transition: all 0.3s ease;
    }

    .load-more-btn:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .load-more-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Comment Input Area in Overlay */
    .comments-overlay-input {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.95);
        padding: 12px 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 10005;
    }

    .comments-overlay-input .comment-input-area {
        flex-direction: row; /* Fixed: Should be row to allow button next to input if space allows, or handle via flex-wrap */
        flex-wrap: wrap;
        gap: 8px;
    }

    .comments-overlay-input .comment-name-input,
    .comments-overlay-input .comment-input {
        flex: 1 1 auto;
        width: 100%;
    }

    .comments-overlay-input .comment-submit-btn {
        width: 100%;
        padding: 12px 20px;
    }

    /* Mobile-specific adjustments */
    @media (max-width: 768px) {
        .comment-card {
            flex: 0 0 240px;
        }

        .comment-name-input {
            flex: 0 0 100px;
        }
    }

</style>

@if(count($stories) > 0 || true)
<div class="stories-container">
    <div class="stories-scroll">
        <!-- Add Story Button -->
        <div class="story-circle" onclick="window.location.href='{{ route('stories.create') }}'">
            <div class="story-avatar add-story">
                <div class="story-avatar-inner add">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                </div>
            </div>
            <span class="story-name">Tu story</span>
        </div>

        <!-- Existing Stories -->
        @foreach($stories as $index => $story)
        <div class="story-circle" onclick="openStory({{ $index }})" data-story-id="{{ $story->id }}" data-created="{{ $story->created_at->toIso8601String() }}">
            <div class="story-avatar {{ in_array($story->id, $viewedStoryIds) ? 'viewed' : '' }}" id="avatar-{{ $story->id }}">
                <div class="story-avatar-inner" style="background-image: url('{{ $story->user && $story->user->imagen ? '/images/perfiles/' . $story->user->imagen : '/images/default-avatar.png' }}'); background-size: cover; background-position: center;">
                    <!-- Content type badge -->
                    <div class="content-type-badge">
                        @if($story->media_type === 'video')
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
            <span class="story-name">{{ $story->user ? $story->user->name : $story->user_name }}</span>
        </div>
        @endforeach
    </div>
</div>

<!-- Stories Modal -->
<div class="stories-modal" id="stories-modal">
    <div class="story-viewer">
        <div class="story-header">
            <div class="story-progress-bars" id="progress-bars"></div>
            <div class="story-user-info">
                <div class="story-user-avatar" id="story-avatar">
                    <img id="story-avatar-img" src="" alt="User">
                </div>
                <span class="story-user-name" id="story-username"></span>
                <span class="story-time" id="story-time" style="margin-left: 10px; opacity: 0.7; font-size: 0.9em; margin-top: 3px;"></span>
                <!-- View Count -->
                <span class="story-views" style="margin-left: 10px; opacity: 0.7; font-size: 0.9em; margin-top: 3px; display: flex; align-items: center; gap: 4px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span id="story-views-count">0</span>
                </span>
            </div>
        </div>
        
        <img class="story-media" id="story-image" src="" alt="Story" style="display: none;">
        <video class="story-media" id="story-video" controls style="display: none;"></video>
        <!-- ... -->

    <!-- ... inside script ... -->


        
        <button class="story-pause-btn" id="story-pause-btn" onclick="togglePause()">
            <svg id="pause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="6" y="4" width="4" height="16"></rect>
                <rect x="14" y="4" width="4" height="16"></rect>
            </svg>
            <svg id="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                <polygon points="5 3 19 12 5 21 5 3"></polygon>
            </svg>
        </button>
        
        <button class="story-close" onclick="closeStory()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        
        <div class="story-nav story-nav-prev" onclick="previousStory()"></div>
        <div class="story-nav story-nav-next" onclick="nextStory()"></div>

        <!-- Comments Section -->
        <div class="comments-section" id="comments-section">
            <div class="comments-carousel" id="comments-carousel">
                <div class="comments-carousel-inner" id="comments-list">
                    <div class="empty-comments">
                        💬 No hay comentarios aún. ¡Sé el primero en comentar!
                    </div>
                </div>
            </div>
            <div class="comment-input-area">
                <input type="text" id="comment-name-input" class="comment-input comment-name-input" placeholder="Tu nombre" maxlength="255">
                <input type="text" id="comment-text-input" class="comment-input" placeholder="Escribe un comentario..." maxlength="500">
                <button class="comment-submit-btn" onclick="submitComment()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Enviar
                </button>
            </div>
        </div>

        <!-- Show Comments Button - All screen sizes -->
        <button class="show-comments-btn" id="show-comments-btn" onclick="showCommentsOverlay()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            Ver comentarios
            <span class="comment-count" id="mobile-comment-count">0</span>
        </button>

        <!-- Mobile Comments Overlay -->
        <div class="comments-overlay" id="comments-overlay" onclick="hideCommentsOverlay(event)">
            <div class="comments-overlay-header">
                <div class="comments-overlay-title">Comentarios</div>
                <button class="comments-overlay-close" onclick="hideCommentsOverlay()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            
            <div class="comments-overlay-list" id="comments-overlay-list">
                <div class="empty-comments">
                    💬 No hay comentarios aún. ¡Sé el primero en comentar!
                </div>
            </div>

            <div class="comments-overlay-input">
                <div class="comment-input-area">
                    <input type="text" id="overlay-comment-name-input" class="comment-input comment-name-input" placeholder="Tu nombre" maxlength="255">
                    <input type="text" id="overlay-comment-text-input" class="comment-input mb-2" placeholder="Escribe un comentario..." maxlength="500">
                    <button class="comment-submit-btn" onclick="submitOverlayComment()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const storiesData = @json($stories);
    let currentStoryIndex = 0;
    let autoPlayTimer = null;
    let isPaused = false;
    let pauseStartTime = null;
    let remainingTime = null;
    const VIEWED_STORIES_KEY = 'viewedStories';

    // Load viewed stories from localStorage
    function getViewedStories() {
        const viewed = localStorage.getItem(VIEWED_STORIES_KEY);
        return viewed ? JSON.parse(viewed) : [];
    }

    function markStoryAsViewed(storyId) {
        let viewed = getViewedStories();
        if (!viewed.includes(storyId)) {
            viewed.push(storyId);
            localStorage.setItem(VIEWED_STORIES_KEY, JSON.stringify(viewed));
        }
        updateStoryCircleStyle(storyId);
    }

    function updateStoryCircleStyle(storyId) {
        const avatar = document.getElementById('avatar-' + storyId);
        if (avatar) {
            avatar.classList.add('viewed');
        }
    }

    // Initialize viewed stories on load
    function initializeViewedStories() {
        const viewed = getViewedStories();
        viewed.forEach(storyId => updateStoryCircleStyle(storyId));
    }

    function openStory(index) {
        currentStoryIndex = index;
        showStory();
        document.getElementById('stories-modal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeStory() {
        document.getElementById('stories-modal').classList.remove('active');
        document.body.style.overflow = 'auto';
        clearTimeout(autoPlayTimer);
        
        // Stop video if playing
        const video = document.getElementById('story-video');
        if (video) {
            video.pause();
            video.currentTime = 0;
            // Destroy HLS instance if exists
            if (window.hls) {
                window.hls.destroy();
                window.hls = null;
            }
        }
    }

    function showStory() {
        const story = storiesData[currentStoryIndex];
        if (!story) return;

        // Local read mark (blue ring)
        markStoryAsViewed(story.id);

        // Server-side view counting (IP/UA)
        fetch(`/stories/${story.id}/view`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (!story._viewIncremented) {
                    if (!story.views) story.views = [];
                    story.views.push({ dummy: true }); 
                    story._viewIncremented = true; 
                    
                    const viewsCountElement = document.getElementById('story-views-count');
                    if (viewsCountElement) {
                         viewsCountElement.textContent = story.views.length;
                    }
                }
            }
        })
        .catch(err => console.error('Error tracking view:', err));

        const storyImage = document.getElementById('story-image');
        const storyVideo = document.getElementById('story-video');
        
        // Update user info
        document.getElementById('story-username').textContent = story.user ? story.user.name : story.user_name;
        
        // Update timestamp
        const timeElement = document.getElementById('story-time');
        if (timeElement) {
            timeElement.textContent = timeAgo(story.created_at);
        }

        // Update Avatar - RESTORED
        const avatarImg = document.getElementById('story-avatar-img');
        if (story.user && story.user.imagen) {
            avatarImg.src = '/images/perfiles/' + story.user.imagen;
        } else {
            avatarImg.src = '/images/perfiles/default-avatar.png';
        }
        
        // Update View Count (Initial Load)
        const viewsCountElement = document.getElementById('story-views-count');
        if (viewsCountElement) {
             // Handle case where views might be null
             const count = story.views ? story.views.length : 0;
             viewsCountElement.textContent = count;
        }
        
        // Show appropriate media
        if (story.media_type === 'video') {
            storyImage.style.display = 'none';
            storyVideo.style.display = 'block';
            
            const videoPath = '/images/stories/' + story.image_path;
            
            // HLS Support
            if (videoPath.endsWith('.m3u8')) {
                if (Hls.isSupported()) {
                    if (window.hls) {
                        window.hls.destroy();
                    }
                    window.hls = new Hls();
                    window.hls.loadSource(videoPath);
                    window.hls.attachMedia(storyVideo);
                    window.hls.on(Hls.Events.MANIFEST_PARSED, function() {
                        storyVideo.play();
                    });
                } else if (storyVideo.canPlayType('application/vnd.apple.mpegurl')) {
                    // Safari Native HLS
                    storyVideo.src = videoPath;
                    storyVideo.addEventListener('loadedmetadata', function() {
                        storyVideo.play();
                    });
                }
            } else {
                // Determine if we need to clean up HLS
                if (window.hls) {
                    window.hls.destroy();
                    window.hls = null;
                }
                // Standard MP4
                storyVideo.src = videoPath;
                storyVideo.load();
                storyVideo.play();
            }
            
            // Use video duration for progress
            // Note: HLS might not have duration immediately available until metadata loads
            storyVideo.onloadedmetadata = function() {
                 let dur = storyVideo.duration;
                 if (!dur || dur === Infinity) dur = story.duration || 15; // Fallback
                 updateProgressBars(dur * 1000);
            };
            
            // If already loaded (cached), trigger manually
            if (storyVideo.duration && storyVideo.duration !== Infinity) {
                updateProgressBars(storyVideo.duration * 1000);
            }
            
            // Auto advance when video ends
            storyVideo.onended = () => nextStory();
        } else {
            // Clean HLS if switching to image
            if (window.hls) {
                window.hls.destroy();
                window.hls = null;
            }
            
            storyVideo.style.display = 'none';
            storyImage.style.display = 'block';
            storyImage.src = '/images/stories/' + story.image_path;
            
            // Use default 5s for images
            updateProgressBars(5000);
        }


        // Load comments
        loadComments();
        
        // Update mobile show comments button and load to overlay
        // Update mobile show comments button and load to overlay
        updateShowCommentsButton();
        // Always try to load overlay comments, but the UI only shows on mobile
        loadCommentsToOverlay();
    }

    function updateProgressBars(duration) {
        const progressBars = document.getElementById('progress-bars');
        progressBars.innerHTML = '';
        
        storiesData.forEach((_, i) => {
            const bar = document.createElement('div');
            bar.className = 'story-progress-bar';
            if (i < currentStoryIndex) bar.classList.add('completed');
            if (i === currentStoryIndex) {
                bar.classList.add('active');
                bar.style.setProperty('--duration', (duration / 1000) + 's');
            }
            bar.innerHTML = '<div class="story-progress-fill"></div>';
            progressBars.appendChild(bar);
        });

        // Auto advance
        clearTimeout(autoPlayTimer);
        if (storiesData[currentStoryIndex].media_type !== 'video') {
            autoPlayTimer = setTimeout(() => nextStory(), duration);
        }
    }

    function nextStory() {
        if (currentStoryIndex < storiesData.length - 1) {
            currentStoryIndex++;
            showStory();
        } else {
            closeStory();
        }
    }

    function previousStory() {
        if (currentStoryIndex > 0) {
            currentStoryIndex--;
            showStory();
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (document.getElementById('stories-modal').classList.contains('active')) {
            if (e.key === 'ArrowRight') nextStory();
            if (e.key === 'ArrowLeft') previousStory();
            if (e.key === 'Escape') closeStory();
        }
    });

    // Pause/Resume functionality
    function togglePause() {
        if (isPaused) {
            resumeStory();
        } else {
            pauseStory();
        }
    }

    function pauseStory() {
        if (isPaused) return;
        
        isPaused = true;
        pauseStartTime = Date.now();
        
        // Pause video if playing
        const video = document.getElementById('story-video');
        if (video && video.style.display !== 'none') {
            video.pause();
        }
        
        // Pause progress bar animation
        const progressBars = document.querySelectorAll('.story-progress-bar.active');
        progressBars.forEach(bar => bar.classList.add('paused'));
        
        // Clear auto-advance timer and save remaining time
        if (autoPlayTimer) {
            clearTimeout(autoPlayTimer);
        }
        
        // Update pause button UI
        document.getElementById('pause-icon').style.display = 'none';
        document.getElementById('play-icon').style.display = 'block';
    }

    function resumeStory() {
        if (!isPaused) return;
        
        isPaused = false;
        
        // Resume video if it was playing
        const video = document.getElementById('story-video');
        if (video && video.style.display !== 'none') {
            video.play();
        }
        
        // Resume progress bar animation
        const progressBars = document.querySelectorAll('.story-progress-bar.paused');
        progressBars.forEach(bar => bar.classList.remove('paused'));
        
        // Update pause button UI
        document.getElementById('pause-icon').style.display = 'block';
        document.getElementById('play-icon').style.display = 'none';
    }

    // Mobile Comments Overlay functionality
    let currentCommentsPage = 0;
    const commentsPerPage = 10;
    let allComments = [];

    function isMobileView() {
        return window.innerWidth <= 768;
    }

    function showCommentsOverlay() {
        // Double check we are on mobile
        if (!isMobileView()) return;
        
        const overlay = document.getElementById('comments-overlay');
        overlay.style.display = ''; // Clear strict hidden style if set
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        loadCommentsToOverlay();
    }

    function hideCommentsOverlay(event) {
        // If event is passed, check if click was on overlay background
        if (event && event.target.id !== 'comments-overlay') {
            return;
        }
        
        const overlay = document.getElementById('comments-overlay');
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    async function loadCommentsToOverlay() {
        const story = storiesData[currentStoryIndex];
        if (!story) return;
        
        try {
            const response = await fetch(`/stories/${story.id}/comments`);
            allComments = await response.json();
            
            currentCommentsPage = 0;
            renderOverlayComments();
            updateMobileCommentCount();
        } catch (error) {
            console.error('Error loading comments:', error);
        }
    }

    function renderOverlayComments() {
        const commentsList = document.getElementById('comments-overlay-list');
        const startIndex = 0;
        const endIndex = (currentCommentsPage + 1) * commentsPerPage;
        const commentsToShow = allComments.slice(startIndex, endIndex);
        
        if (allComments.length === 0) {
            commentsList.innerHTML = `
                <div class="empty-comments">
                    💬 No hay comentarios aún. ¡Sé el primero en comentar!
                </div>
            `;
        } else {
            commentsList.innerHTML = commentsToShow.map(comment => {
                const initial = comment.user_name.charAt(0).toUpperCase();
                return `
                    <div class="comment-card-overlay">
                        <div class="comment-header">
                            <div class="comment-avatar">${initial}</div>
                            <span class="comment-user">${escapeHtml(comment.user_name)}</span>
                            <span class="comment-time">${timeAgo(comment.created_at)}</span>
                        </div>
                        <div class="comment-text">${escapeHtml(comment.comment)}</div>
                    </div>
                `;
            }).join('');
            
            // Add load more button if there are more comments
            if (endIndex < allComments.length) {
                commentsList.innerHTML += `
                    <button class="load-more-btn" onclick="loadMoreComments()">
                        Cargar más comentarios (${allComments.length - endIndex} más)
                    </button>
                `;
            }
        }
    }

    function loadMoreComments() {
        currentCommentsPage++;
        renderOverlayComments();
    }

    function updateMobileCommentCount() {
        const countBadge = document.getElementById('mobile-comment-count');
        if (countBadge) {
            countBadge.textContent = allComments.length;
        }
    }

    function updateShowCommentsButton() {
        const btn = document.getElementById('show-comments-btn');
        // Always show on mobile (detected via CSS media query usually, but here via JS to be safe)
        if (btn) {
            btn.style.display = isMobileView() ? 'flex' : 'none';
        }
    }

    async function submitOverlayComment() {
        const story = storiesData[currentStoryIndex];
        if (!story) return;
        
        const nameInput = document.getElementById('overlay-comment-name-input');
        const textInput = document.getElementById('overlay-comment-text-input');
        const name = nameInput.value.trim();
        const text = textInput.value.trim();
        
        // Validation
        if (!name) {
            nameInput.focus();
            nameInput.style.borderColor = '#ef4444';
            setTimeout(() => {
                nameInput.style.borderColor = '';
            }, 2000);
            return;
        }
        
        if (!text) {
            textInput.focus();
            textInput.style.borderColor = '#ef4444';
            setTimeout(() => {
                textInput.style.borderColor = '';
            }, 2000);
            return;
        }
        
        if (name.length > 255) {
            alert('El nombre es demasiado largo (máximo 255 caracteres)');
            return;
        }
        
        if (text.length > 500) {
            alert('El comentario es demasiado largo (máximo 500 caracteres)');
            return;
        }
        
        // Get button for feedback
        const btn = document.querySelector('.comments-overlay-input .comment-submit-btn');
        const originalText = btn ? btn.innerHTML : '';
        
        try {
            console.log('Enviando comentario overlay a:', `/stories/${story.id}/comments`);
            console.log('Datos:', { user_name: name, comment: text });
            
            const response = await fetch(`/stories/${story.id}/comments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    user_name: name,
                    comment: text
                })
            });
            
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || 'Error al enviar comentario');
            }
            
            // Clear input
            textInput.value = '';
            
            // Reload comments
            await loadCommentsToOverlay();
            await loadComments();  // Also update desktop view
            
            // Visual feedback
            if (btn) {
                btn.innerHTML = '✓ Enviado';
                btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                }, 2000);
            }
            
        } catch (error) {
            console.error('Error submitting comment:', error);
            alert('Error al enviar el comentario. Inténtalo de nuevo.');
        }
    }

    // Initialize on page load
    initializeViewedStories();

    // Comments functionality
    function timeAgo(dateString) {
        const now = new Date();
        const created = new Date(dateString);
        const diffMs = now - created;
        const diffMins = Math.floor(diffMs / (1000 * 60));
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
        
        if (diffMins < 1) return 'ahora';
        if (diffMins < 60) return `${diffMins}min`; // Short format
        if (diffHours < 24) return `${diffHours}h`; // Short format
        return `${diffDays}d`; // Short format
    }

    async function loadComments() {
        const story = storiesData[currentStoryIndex];
        if (!story) return;
        
        try {
            const response = await fetch(`/stories/${story.id}/comments`);
            const comments = await response.json();
            
            const commentsList = document.getElementById('comments-list');
            
            if (comments.length === 0) {
                commentsList.innerHTML = `
                    <div class="empty-comments">
                        💬 No hay comentarios aún. ¡Sé el primero en comentar!
                    </div>
                `;
            } else {
                commentsList.innerHTML = comments.map(comment => {
                    const initial = comment.user_name.charAt(0).toUpperCase();
                    return `
                        <div class="comment-card">
                            <div class="comment-header">
                                <div class="comment-avatar">${initial}</div>
                                <span class="comment-user">${escapeHtml(comment.user_name)}</span>
                                <span class="comment-time">${timeAgo(comment.created_at)}</span>
                            </div>
                            <div class="comment-text">${escapeHtml(comment.comment)}</div>
                        </div>
                    `;
                }).join('');
                
                // Auto scroll to latest comment
                const carousel = document.getElementById('comments-carousel');
                setTimeout(() => {
                    carousel.scrollLeft = 0;
                }, 100);
            }
        } catch (error) {
            console.error('Error loading comments:', error);
        }
    }

    async function submitComment() {
        const story = storiesData[currentStoryIndex];
        if (!story) return;
        
        const nameInput = document.getElementById('comment-name-input');
        const textInput = document.getElementById('comment-text-input');
        const name = nameInput.value.trim();
        const text = textInput.value.trim();
        
        // Validation
        if (!name) {
            nameInput.focus();
            nameInput.style.borderColor = '#ef4444';
            setTimeout(() => {
                nameInput.style.borderColor = '';
            }, 2000);
            return;
        }
        
        if (!text) {
            textInput.focus();
            textInput.style.borderColor = '#ef4444';
            setTimeout(() => {
                textInput.style.borderColor = '';
            }, 2000);
            return;
        }
        
        if (name.length > 255) {
            alert('El nombre es demasiado largo (máximo 255 caracteres)');
            return;
        }
        
        if (text.length > 500) {
            alert('El comentario es demasiado largo (máximo 500 caracteres)');
            return;
        }
        
        // Get button for feedback
        const btn = document.querySelector('#comments-section .comment-submit-btn');
        const originalText = btn ? btn.innerHTML : '';
        
        try {
            console.log('Enviando comentario (desktop) a:', `/stories/${story.id}/comments`);
            console.log('Datos:', { user_name: name, comment: text });
            
            const response = await fetch(`/stories/${story.id}/comments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    user_name: name,
                    comment: text
                })
            });
            
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || 'Error al enviar comentario');
            }
            
            // Clear input
            textInput.value = '';
            
            // Reload comments
            await loadComments();
            
            // Visual feedback
            if (btn) {
                btn.innerHTML = '✓ Enviado';
                btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                }, 2000);
            }
            
        } catch (error) {
            console.error('Error submitting comment:', error);
            alert('Error al enviar el comentario. Inténtalo de nuevo.');
        }
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Add Enter key support for inputs
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('comment-name-input');
        const textInput = document.getElementById('comment-text-input');
        
        if (nameInput) {
            nameInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    textInput.focus();
                }
            });
            
            // Auto-pause when focusing on name input
            nameInput.addEventListener('focus', () => {
                if (!isPaused) {
                    pauseStory();
                }
            });
        }
        
        if (textInput) {
            textInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    submitComment();
                }
            });
            
            // Auto-pause when focusing on comment input
            textInput.addEventListener('focus', () => {
                if (!isPaused) {
                    pauseStory();
                }
            });
        }
        
        // Add same functionality for overlay inputs
        const overlayNameInput = document.getElementById('overlay-comment-name-input');
        const overlayTextInput = document.getElementById('overlay-comment-text-input');
        
        if (overlayNameInput) {
            overlayNameInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    overlayTextInput.focus();
                }
            });
            
            // Auto-pause when focusing on overlay name input
            overlayNameInput.addEventListener('focus', () => {
                if (!isPaused) {
                    pauseStory();
                }
            });
        }
        
        if (overlayTextInput) {
            overlayTextInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    submitOverlayComment();
                }
            });
            
            // Auto-pause when focusing on overlay comment input
            overlayTextInput.addEventListener('focus', () => {
                if (!isPaused) {
                    pauseStory();
                }
            });
        }
        
        // Update mobile button visibility and FORCE hide overlay on desktop
        function handleResize() {
            updateShowCommentsButton();
            
            // Nuclear option: If desktop, force hide the overlay
            if (!isMobileView()) {
                const overlay = document.getElementById('comments-overlay');
                if (overlay) {
                    overlay.classList.remove('active');
                    overlay.style.display = 'none';
                }
            } else {
                // On mobile, reset standard display (let CSS/Active class handle it)
                const overlay = document.getElementById('comments-overlay');
                if (overlay) {
                     overlay.style.display = ''; 
                }
            }
        }
        
        window.addEventListener('resize', handleResize);
        
        // Run once on load
        handleResize();
    });

</script>
@endif
