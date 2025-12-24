<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap');

/* Trollers V5: Elegant Premium */
:root {
    --bg-app: #09090b; /* Zinc 950 - Deepest Grey */
    --bg-chat: #09090b;
    --text-primary: #fafafa;
    --text-secondary: #a1a1aa;
    
    --accent-blue: #3b82f6; 
    --accent-glow: rgba(59, 130, 246, 0.15);
    
    --msg-user-bg: #27272a;
    --msg-bot-bg: transparent;
    
    --border-subtle: rgba(255, 255, 255, 0.06);
    --glass-bg: rgba(9, 9, 11, 0.75);
    
    --font-main: 'Inter', sans-serif;
    --font-code: 'JetBrains Mono', monospace;
}

* { box-sizing: border-box; }

body, html {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: var(--bg-app);
    color: var(--text-primary);
    font-family: var(--font-main);
    overflow: hidden; /* Critical for fixed app-like feel */
}

/* Main Layout - The Scroll Fix */
.site-wrap, .main-content {
    height: 100dvh; /* Dynamic Viewport Height for mobile */
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chat-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: radial-gradient(circle at top center, #18181b 0%, #09090b 40%);
    position: relative;
    overflow: hidden; /* Contains the scroll area */
}

/* Header - Elegant & Minimal */
.chat-header-internal {
    flex-shrink: 0;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 1.5rem;
    border-bottom: 1px solid var(--border-subtle);
    background: var(--glass-bg);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    z-index: 100;
}

.chat-title {
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: -0.02em;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 8px;
}

.chat-title::before {
    content: "●";
    color: #10b981;
    font-size: 0.6rem;
    animation: pulseDot 2s infinite;
}

.chat-status {
    font-size: 0.75rem;
    color: var(--text-secondary);
    font-family: var(--font-code);
    opacity: 0.7;
}

@keyframes pulseDot {
    0% { opacity: 0.5; }
    50% { opacity: 1; text-shadow: 0 0 8px #10b981; }
    100% { opacity: 0.5; }
}

/* Messages Area - The Core Scrollable */
#chat-messages {
    flex: 1;
    overflow-y: auto; /* The ONLY scrollbar */
    overflow-x: hidden;
    padding: 2rem 0; /* Vertical padding */
    scroll-behavior: smooth;
    
    /* Centered Content Strategy */
    display: flex;
    flex-direction: column;
    align-items: center; /* Centers message wrappers */
    gap: 1.5rem;
}

#chat-messages::-webkit-scrollbar { width: 5px; }
#chat-messages::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 5px; }
#chat-messages::-webkit-scrollbar-track { background: transparent; }

/* Message Items */
.message {
    width: 100%;
    max-width: 800px; /* Optimal reading width */
    padding: 0 1.5rem; /* Horizontal margins */
    display: flex;
    gap: 1rem;
    opacity: 0;
    animation: fadeSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.message.user { justify-content: flex-end; }
.message.bot { justify-content: flex-start; }

@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}
.avatar img { width: 100%; height: 100%; object-fit: cover; }

.message-content {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #e4e4e7;
    padding: 0.75rem 1rem;
    position: relative;
    word-wrap: break-word;
    max-width: 100%;
}

/* User Message Bubble */
.message.user .message-content {
    background: var(--msg-user-bg);
    border-radius: 18px 18px 4px 18px;
    border: 1px solid var(--border-subtle);
}

/* Bot Message - No Bubble, Editor Look */
.message.bot .message-content {
    background: transparent;
    padding-left: 0;
    padding-top: 2px;
}

/* Input Area - Minimalist Floating Capsule */
.input-area {
    flex-shrink: 0;
    padding: 1.5rem;
    width: 100%;
    display: flex;
    justify-content: center;
    background: linear-gradient(to top, var(--bg-app) 20%, transparent); /* Fade out sooner */
    z-index: 200;
}

.input-wrapper {
    width: 100%;
    max-width: 750px; /* Slightly narrower for focus */
    background: rgba(20, 20, 23, 0.4); /* Much more transparent/minimal */
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.05); /* Very subtle border */
    border-radius: 24px; /* Soft rounding, not full pill */
    padding: 8px 8px 8px 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.2); /* Soft ambient shadow */
    transition: all 0.3s ease;
}

.input-wrapper:focus-within {
    background: rgba(20, 20, 23, 0.7);
    border-color: rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    transform: translateY(-1px);
}

#chat-input {
    flex: 1;
    background: transparent;
    border: none;
    color: var(--text-primary);
    font-family: var(--font-main);
    font-size: 1rem;
    max-height: 120px;
    padding: 6px 0;
    resize: none;
    outline: none;
    font-weight: 400;
}

#chat-input::placeholder { 
    color: #52525b; 
    font-weight: 300; 
}

.send-btn {
    width: 40px;
    height: 40px;
    border-radius: 14px; /* Squircle matching input */
    border: none;
    background: var(--text-primary); /* High contrast, white usually */
    color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.2, 0.8, 0.2, 1);
    flex-shrink: 0;
}

.send-btn:disabled {
    background: rgba(255, 255, 255, 0.1);
    color: #52525b;
    cursor: not-allowed;
    transform: none;
}

.send-btn:not(:disabled):hover {
    transform: scale(1.05);
    background: #fff;
    box-shadow: 0 0 15px rgba(255,255,255,0.2);
}

.send-icon { width: 22px; height: 22px; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .chat-header-internal { height: 56px; padding: 0 1rem; }
    .message { max-width: 100%; padding: 0 1rem; }
    .input-area { padding: 1rem; }
    #chat-messages { padding-top: 1rem; }
}
</style></style>