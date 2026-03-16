<x-guest-layout>

<div class="auth-wrapper">

    {{-- ══ PAINEL ESQUERDO (imagem) ══ --}}
    <div class="auth-visual">

        {{-- Descomente quando tiver a imagem:
        <img src="{{ asset('images/login-bg.jpg') }}" alt=""> --}}

        <div class="auth-placeholder">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width=".8"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
            </svg>
            <p>Sua imagem aqui</p>
        </div>

        <div class="auth-visual-overlay"></div>

        <div class="auth-caption">
            <h2>Recupere<br>seu <em>acesso.</em></h2>
        </div>
    </div>

    {{-- ══ PAINEL DIREITO (formulário) ══ --}}
    <div class="auth-form-panel">

        <div class="auth-header">
            <p class="auth-eyebrow">Recuperação</p>
            <h1 class="auth-title">Esqueceu a senha?</h1>
            <p class="auth-desc">
                Sem problema. Informe seu e-mail e enviaremos um link para você criar uma nova senha.
            </p>
        </div>

        <div class="auth-status">
            <x-auth-session-status class="mb-4" :status="session('status')" />
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="auth-field">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email"
                    :value="old('email')" placeholder="seu@email.com"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button type="submit" class="auth-btn">Enviar link de recuperação</button>

        </form>

        @if (Route::has('login'))
            <a href="{{ route('login') }}" class="auth-link-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Voltar para o login
            </a>
        @endif

    </div>

</div>

</x-guest-layout>