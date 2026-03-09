<x-app-layout>

@push('styles')
    @vite('resources/css/dashboard.css')
@endpush

<x-slot name="header"><span></span></x-slot>

<style>
    body {
        background: var(--bg) !important;
        font-family: 'Sora', sans-serif !important;
        color: var(--text) !important;
    }

    header.bg-white { display: none !important; }
    nav { display: none !important; }
    main { padding: 0 !important; }

    .profile-layout {
        min-height: 100vh;
        background: var(--bg);
        display: grid;
        grid-template-columns: 1fr 680px 1fr;
        animation: auth-fade .45s ease both;
    }

    .profile-content {
        grid-column: 2;
        padding: 48px 0 80px;
    }

    /* ── Topbar de navegação ── */
    .profile-topbar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 40px;
    }

    .profile-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: .75rem;
        color: var(--muted);
        text-decoration: none;
        transition: color .2s;
    }

    .profile-back:hover { color: var(--accent); }
    .profile-back:hover svg { transform: translateX(-3px); }

    .profile-back svg {
        width: 14px;
        height: 14px;
        transition: transform .2s;
    }

    .profile-topbar-divider {
        width: 1px;
        height: 14px;
        background: var(--border);
    }

    .profile-page-label {
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: var(--muted);
    }

    /* ── Cabeçalho ── */
    .profile-header {
        margin-bottom: 40px;
        padding-bottom: 32px;
        border-bottom: 1px solid var(--border);
    }

    .profile-eyebrow {
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .2em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 10px;
    }

    .profile-title {
        font-family: 'DM Serif Display', serif;
        font-size: 2rem;
        font-weight: 400;
        color: var(--text);
        line-height: 1.15;
    }

    /* ── Avatar ── */
    .profile-avatar-section {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 40px;
    }

    .profile-avatar-big {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: rgba(200,245,69,.12);
        border: 1px solid rgba(200,245,69,.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Serif Display', serif;
        font-size: 1.8rem;
        color: var(--accent);
        flex-shrink: 0;
    }

    .profile-avatar-info h3 {
        font-size: .9rem;
        font-weight: 500;
        color: var(--text);
        margin-bottom: 4px;
    }

    .profile-avatar-info p {
        font-size: .75rem;
        color: var(--muted);
    }

    /* ── Cards de seção ── */
    .profile-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 20px;
    }

    .profile-section-title {
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }

    /* ── Campos reutilizando auth-field ── */
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .profile-grid .auth-field { margin-bottom: 0; }

    .auth-field.full { grid-column: 1 / -1; }

    /* ── Danger zone ── */
    .profile-danger {
        background: rgba(248,113,113,.04);
        border: 1px solid rgba(248,113,113,.15);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 20px;
    }

    .profile-danger .profile-section-title {
        color: #f87171;
        border-bottom-color: rgba(248,113,113,.15);
    }

    .profile-danger p {
        font-size: .82rem;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .btn-danger {
        padding: 11px 24px;
        background: transparent;
        border: 1px solid rgba(248,113,113,.4);
        border-radius: 10px;
        font-family: 'Sora', sans-serif;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .08em;
        color: #f87171;
        cursor: pointer;
        transition: background .2s, border-color .2s;
    }

    .btn-danger:hover {
        background: rgba(248,113,113,.08);
        border-color: #f87171;
    }

    /* ── Botão salvar ── */
    .profile-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 24px;
    }

    .profile-saved {
        font-size: .75rem;
        color: var(--accent);
        display: flex;
        align-items: center;
        gap: 6px;
        opacity: 0;
        transition: opacity .3s;
    }

    .profile-saved.show { opacity: 1; }
    .profile-saved svg { width: 14px; height: 14px; }

    /* Select no perfil */
    .auth-field select {
        display: block !important;
        width: 100% !important;
        background: var(--input-bg) !important;
        border: 1px solid var(--border) !important;
        border-radius: 10px !important;
        padding: 13px 16px !important;
        font-family: 'Sora', sans-serif !important;
        font-size: .88rem !important;
        color: var(--text) !important;
        outline: none !important;
        transition: border-color .2s, box-shadow .2s !important;
        box-shadow: none !important;
        appearance: none !important;
        -webkit-appearance: none !important;
        cursor: pointer !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 16px center !important;
        background-size: 14px !important;
        padding-right: 40px !important;
    }

    .auth-field select:focus {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px rgba(200,245,69,.1) !important;
    }

    .auth-field select option { background: #1a1a1a; color: var(--text); }

    @media (max-width: 768px) {
        .profile-layout { grid-template-columns: 1fr; }
        .profile-content { padding: 32px 24px 60px; }
        .profile-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="profile-layout">
    <div class="profile-content">

        {{-- Topbar --}}
        <div class="profile-topbar">
            <a href="{{ route('dashboard') }}" class="profile-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Dashboard
            </a>
            <div class="profile-topbar-divider"></div>
            <span class="profile-page-label">Configurações</span>
        </div>

        {{-- Cabeçalho --}}
        <div class="profile-header">
            <p class="profile-eyebrow">Conta</p>
            <h1 class="profile-title">Seu perfil</h1>
        </div>

        {{-- Avatar --}}
        <div class="profile-avatar-section">
            <div class="profile-avatar-big">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="profile-avatar-info">
                <h3>{{ auth()->user()->name }}</h3>
                <p>{{ auth()->user()->email }}</p>
            </div>
        </div>

        {{-- Informações do perfil --}}
        @include('profile.partials.update-profile-information-form')

        {{-- Atualizar senha --}}
        @include('profile.partials.update-password-form')

        {{-- Deletar conta --}}
        @include('profile.partials.delete-user-form')

    </div>
</div>

</x-app-layout>