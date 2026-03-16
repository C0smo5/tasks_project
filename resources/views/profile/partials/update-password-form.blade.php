<section class="profile-section">
    <div class="profile-section-title">Alterar senha</div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="profile-grid">

            <div class="auth-field full">
                <x-input-label for="update_password_current_password" :value="__('Senha atual')" />
                <x-text-input id="update_password_current_password"
                    type="password" name="current_password"
                    placeholder="••••••••"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="auth-field">
                <x-input-label for="update_password_password" :value="__('Nova senha')" />
                <x-text-input id="update_password_password"
                    type="password" name="password"
                    placeholder="••••••••"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="auth-field">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirmar nova senha')" />
                <x-text-input id="update_password_password_confirmation"
                    type="password" name="password_confirmation"
                    placeholder="••••••••"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

        </div>

        <div class="profile-footer">
            <div class="profile-saved {{ session('status') === 'password-updated' ? 'show' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Senha atualizada
            </div>
            <button type="submit" class="auth-btn" style="width: auto; padding: 12px 28px;">
                Atualizar senha
            </button>
        </div>

    </form>
</section>