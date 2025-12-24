<script>
$(document).ready(function() {
    const $messages = $('#chat-messages');
    const $input = $('#chat-input');
    const $sendBtn = $('#send-btn');
    const apiUrl = 'http://localhost:8001/chat';

    // Auto-resize textarea
    $input.on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
        
        // Enable/disable send button
        if (this.value.trim().length > 0) {
            $sendBtn.prop('disabled', false).css('color', 'var(--primary-color)');
        } else {
            $sendBtn.prop('disabled', true).css('color', '');
        }
    });

    // Handle Enter key to send (Shift+Enter for new line)
    $input.on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    $sendBtn.on('click', sendMessage);

    function sendMessage() {
        const text = $input.val().trim();
        if (!text) return;

        // Clear input
        $input.val('');
        $input.css('height', 'auto');
        $sendBtn.prop('disabled', true);

        // Add User Message
        addMessage(text, 'user');

        // Show Typing Indicator
        showTypingIndicator();

        // Call API
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ query: text })
        })
        .then(async response => {
            if (!response.ok) throw new Error('Network error');
            removeTypingIndicator(); // Start streaming immediately
            
            // Create empty bot message
            const msgId = 'msg-' + Date.now();
            const avatarImg = 'https://ui-avatars.com/api/?name=AI&background=000&color=fff';
            
            const html = `
                <div class="message bot">
                    <div class="avatar">
                        <img src="${avatarImg}" alt="AI">
                    </div>
                    <div class="message-content" id="${msgId}"></div>
                </div>
            `;
            $messages.append(html);
            const $msgContent = $('#' + msgId);
            
            // Stream Reader
            const reader = response.body.getReader();
            const decoder = new TextDecoder();
            let fullText = "";

            while (true) {
                const { done, value } = await reader.read();
                if (done) break;
                
                const chunk = decoder.decode(value, { stream: true });
                fullText += chunk;
                
                // Real-time update
                $msgContent.html(formatResponse(fullText));
                scrollToBottom();
            }
        })
        .catch(error => {
            removeTypingIndicator();
            addMessage("Lo siento, hubo un error al conectar con el cerebro digital. Asegúrate de que el servidor local (puerto 8001) esté activo.", 'bot');
            console.error(error);
        });
    }

    function addMessage(text, type) {
        const isUser = type === 'user';
        // Elegant avatar logic
        const avatarImg = isUser 
            ? 'https://ui-avatars.com/api/?name=User&background=3b82f6&color=fff' 
            : 'https://ui-avatars.com/api/?name=AI&background=000&color=fff';

        const msgId = 'msg-' + Date.now();
        const html = `
            <div class="message ${type}">
                <div class="avatar">
                    <img src="${avatarImg}" alt="${type}">
                </div>
                <div class="message-content" id="${msgId}">${isUser ? text : ''}</div>
            </div>
        `;
        
        $messages.append(html);
        scrollToBottom();

        // Progressive typing for Bot
        if (!isUser) {
            // Smart HTML Typewriter
            // 1. Split into text and tags
            const parts = text.split(/(<[^>]*>)/);
            const queue = [];
            
            parts.forEach(part => {
                if (part.startsWith('<') && part.endsWith('>')) {
                    // It's a tag, push as single item
                    queue.push(part);
                } else {
                    // It's text, push chars individually
                    for (let char of part) {
                        queue.push(char);
                    }
                }
            });

            let i = 0;
            const speed = 1; // ms per step (HYPER-FAST)
            const el = document.getElementById(msgId);
            
            function typeWriter() {
                if (i < queue.length) {
                    el.innerHTML += queue[i];
                    i++;
                    scrollToBottom();
                    setTimeout(typeWriter, speed);
                }
            }
            typeWriter();
        }
    }

    function showTypingIndicator() {
        // Elegant indicator
        const html = `
            <div class="message bot typing-indicator-msg">
                <div class="avatar">
                    <img src="https://ui-avatars.com/api/?name=AI&background=000&color=fff" alt="AI">
                </div>
                <div class="message-content" style="color: var(--text-secondary); font-style: italic;">
                    Thinking...
                </div>
            </div>
        `;
        $messages.append(html);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        $('.typing-indicator-msg').remove();
    }

    function scrollToBottom() {
        const messagesEl = document.getElementById('chat-messages');
        messagesEl.scrollTop = messagesEl.scrollHeight;
        
        // Ensure viewport scroll is also handled if needed, though overflow is on #chat-messages
    }

    function formatResponse(text) {
        // Convert newlines to <br>
        text = text.replace(/\n/g, '<br>');
        // Bold text logic if markdown style **text** is used (basic support)
        text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        return text;
    }
});
</script>