<x-guest-layout>

<style>
    .confirm-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg);
        padding: 2rem;
        animation: auth-fade .55s ease both;
    }

    .confirm-card {
        width: 100%;
        max-width: 440px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 52px 48px;
    }

    .confirm-icon {
        width: 52px;
        height: 52px;
        background: rgba(200,245,69,.1);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 28px;
    }

    .confirm-icon svg {
        width: 26px;
        height: 26px;
        color: var(--accent);
    }

    .confirm-desc {
        font-size: .84rem;
        color: var(--muted);
        line-height: 1.75;
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid var(--border);
    }
</style>

<div class="confirm-wrapper">
    <div class="confirm-card">

        <div class="confirm-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="5" y="11" width="14" height="10" rx="2"/>
                <path d="M8 11V7a4 4 0 0 1 8 0v4"/>
            </svg>
        </div>

        <p class="auth-eyebrow">Área segura</p>
        <h1 class="auth-title">Confirme sua senha</h1>

        <p class="confirm-desc">
            Esta é uma área protegida. Por segurança, confirme sua senha antes de continuar.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="auth-field">
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input id="password" type="password" name="password"
                    placeholder="••••••••"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <button type="submit" class="auth-btn" style="margin-top: 8px;">
                Confirmar acesso
            </button>

        </form>

    </div>
</div>

</x-guest-layout>