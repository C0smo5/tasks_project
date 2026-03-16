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
            <h2>Nova senha,<br><em>novo começo.</em></h2>
        </div>
    </div>

    {{-- ══ PAINEL DIREITO (formulário) ══ --}}
    <div class="auth-form-panel">

        <div class="auth-header">
            <p class="auth-eyebrow">Segurança</p>
            <h1 class="auth-title">Redefinir senha</h1>
            <p class="auth-desc">
                Escolha uma nova senha para sua conta. Use algo seguro e fácil de lembrar.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="auth-field">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email"
                    :value="old('email', $request->email)"
                    placeholder="seu@email.com"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="auth-field">
                <x-input-label for="password" :value="__('Nova senha')" />
                <x-text-input id="password" type="password" name="password"
                    placeholder="••••••••"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="auth-field">
                <x-input-label for="password_confirmation" :value="__('Confirmar nova senha')" />
                <x-text-input id="password_confirmation" type="password"
                    name="password_confirmation" placeholder="••••••••"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="auth-btn" style="margin-top: 8px;">
                Redefinir senha
            </button>

        </form>

    </div>

</div>

</x-guest-layout>