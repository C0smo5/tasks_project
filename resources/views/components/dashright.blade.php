{{-- resources/views/components/dashright.blade.php --}}

<aside class="dash-right">

    {{-- Perfil --}}
    <div class="right-profile">
        <a href="{{ route('profile.edit') }}" class="profile-card">
            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ auth()->user()?->name ?? 'Usuário' }}</div>
                <div class="profile-role">{{ auth()->user()?->function ?? 'Membro' }}</div>
            </div>
            <div class="profile-chevron">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </div>
        </a>
    </div>

    {{-- Histórico de conversas --}}
    <div class="right-history">
        <div class="history-title">Histórico de conversas</div>

        <div class="history-list">
            <div class="history-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <p>Nenhuma conversa<br>ainda.</p>
            </div>
        </div>
    </div>

    {{-- Logout --}}
    <div class="right-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Sair da conta
            </button>
        </form>
    </div>

</aside>
