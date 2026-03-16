<x-app-layout>

<x-slot name="header"><span></span></x-slot>

<div class="dash-layout">

    <x-dashnavbar />

    <x-dashsidebar :tasks="$tasks" />

    {{-- ══════════════════════════════════
         ÁREA CENTRAL — CHAT
    ══════════════════════════════════ --}}
    <main class="dash-main chat-main">

        <div class="chat-layout">

            {{-- ── Lista de conversas ── --}}
            <aside class="chat-list">
                <div class="chat-list-header">
                    <span class="chat-list-title">Conversas</span>
                    <button class="chat-new-btn" title="Nova conversa">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    </button>
                </div>

                <div class="chat-list-items">
                    {{-- item ativo --}}
                    <div class="chat-list-item active">
                        <div class="chat-item-avatar">A</div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">Ana Silva</div>
                            <div class="chat-item-preview">Pode revisar a task de...</div>
                        </div>
                        <div class="chat-item-meta">
                            <span class="chat-item-time">14:32</span>
                            <span class="chat-item-badge">2</span>
                        </div>
                    </div>

                    <div class="chat-list-item">
                        <div class="chat-item-avatar">R</div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">Rafael Costa</div>
                            <div class="chat-item-preview">Ok, vou verificar amanhã</div>
                        </div>
                        <div class="chat-item-meta">
                            <span class="chat-item-time">11:20</span>
                        </div>
                    </div>

                    <div class="chat-list-item">
                        <div class="chat-item-avatar">M</div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">Mariana Luz</div>
                            <div class="chat-item-preview">Design aprovado ✓</div>
                        </div>
                        <div class="chat-item-meta">
                            <span class="chat-item-time">Seg</span>
                        </div>
                    </div>

                    <div class="chat-list-item">
                        <div class="chat-item-avatar">G</div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">Gabriel Nunes</div>
                            <div class="chat-item-preview">Precisamos alinhar o sprint</div>
                        </div>
                        <div class="chat-item-meta">
                            <span class="chat-item-time">Dom</span>
                        </div>
                    </div>

                    <div class="chat-list-item">
                        <div class="chat-item-avatar">L</div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">Larissa Mota</div>
                            <div class="chat-item-preview">Subiu para produção</div>
                        </div>
                        <div class="chat-item-meta">
                            <span class="chat-item-time">Sáb</span>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- ── Área de mensagens ── --}}
            <section class="chat-window">

                {{-- Header da conversa --}}
                <div class="chat-window-header">
                    <div class="chat-window-avatar">A</div>
                    <div class="chat-window-info">
                        <div class="chat-window-name">Ana Silva</div>
                        <div class="chat-window-status">
                            <span class="chat-status-dot"></span>
                            Online
                        </div>
                    </div>
                </div>

                {{-- Mensagens --}}
                <div class="chat-messages" id="chatMessages">

                    <div class="chat-day-divider">Hoje</div>

                    {{-- Mensagem recebida --}}
                    <div class="chat-msg chat-msg-received">
                        <div class="chat-msg-bubble">
                            Oi! Pode revisar a task de autenticação? Tá quase pronta.
                        </div>
                        <span class="chat-msg-time">14:28</span>
                    </div>

                    {{-- Mensagem recebida --}}
                    <div class="chat-msg chat-msg-received">
                        <div class="chat-msg-bubble">
                            Deixei os detalhes no card do Jira.
                        </div>
                        <span class="chat-msg-time">14:29</span>
                    </div>

                    {{-- Mensagem enviada --}}
                    <div class="chat-msg chat-msg-sent">
                        <div class="chat-msg-bubble">
                            Claro, já vou dar uma olhada!
                        </div>
                        <span class="chat-msg-time">14:31</span>
                    </div>

                    {{-- Mensagem recebida --}}
                    <div class="chat-msg chat-msg-received">
                        <div class="chat-msg-bubble">
                            Obrigada 🙏 qualquer dúvida me chama
                        </div>
                        <span class="chat-msg-time">14:32</span>
                    </div>

                </div>

                {{-- Input de mensagem --}}
                <div class="chat-input-area">
                    <input
                        type="text"
                        class="chat-input"
                        placeholder="Digite algo..."
                        id="chatInput"
                        onkeydown="handleChatKey(event)"
                    />
                    <button class="chat-send-btn" onclick="sendMessage()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                    </button>
                </div>

            </section>

        </div>
        
        <x-dashdetailtasks />

    </main>
    

    <x-dashright />

</div>

</x-app-layout>