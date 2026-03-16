// ══════════════════════════════════════════════
//  CHAT
// ══════════════════════════════════════════════

window.sendMessage = function sendMessage() {
    const input = document.getElementById('chatInput');
    const text  = input.value.trim();
    if (!text) return;

    const messages = document.getElementById('chatMessages');

    // Cria bolha enviada
    const msg = document.createElement('div');
    msg.className = 'chat-msg chat-msg-sent';
    msg.innerHTML = `
        <div class="chat-msg-bubble">${escapeHtml(text)}</div>
        <span class="chat-msg-time">${currentTime()}</span>
    `;

    messages.appendChild(msg);
    input.value = '';

    // Scroll para o final
    messages.scrollTop = messages.scrollHeight;
}

window.handleChatKey = function handleChatKey(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
}

// Selecionar conversa
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.chat-list-item').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.chat-list-item').forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            // Atualiza nome no header
            const name = item.querySelector('.chat-item-name')?.textContent ?? '';
            const initial = name.charAt(0).toUpperCase();
            const headerName = document.querySelector('.chat-window-name');
            const headerAvatar = document.querySelector('.chat-window-avatar');
            if (headerName)   headerName.textContent   = name;
            if (headerAvatar) headerAvatar.textContent = initial;
        });
    });

    // Scroll inicial para o final das mensagens
    const messages = document.getElementById('chatMessages');
    if (messages) messages.scrollTop = messages.scrollHeight;
});

// ── Helpers ──
function currentTime() {
    const now = new Date();
    return now.getHours().toString().padStart(2, '0') + ':' +
           now.getMinutes().toString().padStart(2, '0');
}

function escapeHtml(str) {
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}