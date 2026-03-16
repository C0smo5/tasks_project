<x-guest-layout>

<style>
    /* Página de verificação não tem split-screen — layout centralizado */
    .verify-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg);
        padding: 2rem;
        animation: auth-fade .55s ease both;
    }

    .verify-card {
        width: 100%;
        max-width: 480px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 52px 48px;
    }

    .verify-icon {
        width: 52px;
        height: 52px;
        background: rgba(200,245,69,.1);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 28px;
    }

    .verify-icon svg {
        width: 26px;
        height: 26px;
        color: var(--accent);
    }

    .verify-card .auth-title {
        margin-bottom: 12px;
    }

    .verify-desc {
        font-size: .84rem;
        color: var(--muted);
        line-height: 1.75;
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid var(--border);
    }

    /* Alerta de sucesso */
    .verify-alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: rgba(200,245,69,.07);
        border: 1px solid rgba(200,245,69,.2);
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 24px;
        font-size: .8rem;
        color: var(--accent);
        line-height: 1.5;
    }

    .verify-alert svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* Botões */
    .verify-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .auth-btn-outline {
        width: 100%;
        padding: 14px;
        background: transparent;
        color: var(--muted);
        font-family: 'Sora', sans-serif;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        border: 1px solid var(--border);
        border-radius: 10px;
        cursor: pointer;
        transition: border-color .2s, color .2s;
    }

    .auth-btn-outline:hover {
        border-color: var(--muted);
        color: var(--text);
    }
</style>

<div class="verify-wrapper">
    <div class="verify-card">

        <div class="verify-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <polyline points="2,4 12,13 22,4"/>
            </svg>
        </div>

        <p class="auth-eyebrow">Quase lá</p>
        <h1 class="auth-title">Verifique seu e-mail</h1>

        <p class="verify-desc">
            Enviamos um link de verificação para o seu endereço de e-mail.
            Clique nele para ativar sua conta e começar a usar o sistema.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="verify-alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Um novo link de verificação foi enviado para o seu e-mail.
            </div>
        @endif

        <div class="verify-actions">

            {{-- Reenviar e-mail --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="auth-btn">
                    Reenviar e-mail de verificação
                </button>
            </form>

            {{-- Sair --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="auth-btn-outline">
                    Sair da conta
                </button>
            </form>

        </div>

    </div>
</div>

</x-guest-layout>