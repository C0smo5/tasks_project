<section class="profile-section">
    <div class="profile-section-title">Informações pessoais</div>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="profile-grid">

            <div class="auth-field full">
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" type="text" name="name"
                    :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="auth-field full">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email"
                    :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="auth-field full" style="margin-top: 16px;">
                <p style="font-size: .78rem; color: var(--muted); line-height: 1.6;">
                    Seu endereço de e-mail não foi verificado.
                    <button form="send-verification" style="color: var(--accent); background: none; border: none; cursor: pointer; font-family: 'Sora', sans-serif; font-size: .78rem; text-decoration: underline;">
                        Clique aqui para reenviar o e-mail de verificação.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p style="font-size: .75rem; color: var(--accent); margin-top: 8px;">
                        Um novo link de verificação foi enviado para o seu e-mail.
                    </p>
                @endif
            </div>
        @endif

        <div class="profile-footer">
            <div class="profile-saved {{ session('status') === 'profile-updated' ? 'show' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Salvo com sucesso
            </div>
            <button type="submit" class="auth-btn" style="width: auto; padding: 12px 28px;">
                Salvar alterações
            </button>
        </div>

    </form>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>
</section>