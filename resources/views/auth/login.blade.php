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
            <h2>Bem-vindo<br>de <em>volta.</em></h2>
        </div>
    </div>

    {{-- ══ PAINEL DIREITO (formulário) ══ --}}
    <div class="auth-form-panel">

        <div class="auth-header">
            <p class="auth-eyebrow">Acesso</p>
            <h1 class="auth-title">Entrar na conta</h1>
        </div>

        <div class="auth-status">
            <x-auth-session-status class="mb-4" :status="session('status')" />
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-field">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email"
                    :value="old('email')" placeholder="seu@email.com"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="auth-field">
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input id="password" type="password" name="password"
                    placeholder="••••••••"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="auth-links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Esqueci a senha</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Cadastrar-se</a>
                @endif
            </div>

            <button type="submit" class="auth-btn">Logar</button>

        </form>
    </div>

</div>

</x-guest-layout>