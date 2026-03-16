<x-guest-layout>

<style>
    .auth-wrapper-inv {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 38vw 1fr;
        background: var(--bg);
        animation: auth-fade .55s ease both;
    }

    .auth-field-label {
        display: block;
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 8px;
    }

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

    .auth-field select option {
        background: #1a1a1a;
        color: var(--text);
    }

    .auth-wrapper-inv .auth-visual {
        border-left: 1px solid var(--border);
        border-right: none;
    }

    .auth-wrapper-inv .auth-form-panel {
        border-left: none;
        border-right: 1px solid var(--border);
    }

    .auth-field-sm { margin-bottom: 16px; }

    /* Grid de 2 colunas para os campos */
    .register-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0 16px;
    }

    /* Campo que ocupa as 2 colunas */
    .register-grid .col-span-2 {
        grid-column: span 2;
    }

    @media (max-width: 768px) {
        .auth-wrapper-inv { grid-template-columns: 1fr; }
        .auth-wrapper-inv .auth-visual {
            order: -1;
            min-height: 240px;
            border-left: none;
            border-bottom: 1px solid var(--border);
        }
        .register-grid { grid-template-columns: 1fr; }
        .register-grid .col-span-2 { grid-column: span 1; }
    }
</style>

<div class="auth-wrapper-inv">

    {{-- ══ PAINEL ESQUERDO (formulário) ══ --}}
    <div class="auth-form-panel">

        <div class="auth-header">
            <p class="auth-eyebrow">Novo por aqui?</p>
            <h1 class="auth-title">Criar uma conta</h1>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="register-grid">

                {{-- Nome --}}
                <div class="auth-field auth-field-sm">
                    <x-input-label for="name" :value="__('Nome')" />
                    <x-text-input id="name" type="text" name="name"
                        :value="old('name')" placeholder="Seu nome completo"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Email --}}
                <div class="auth-field auth-field-sm">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email"
                        :value="old('email')" placeholder="seu@email.com"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Senha --}}
                <div class="auth-field auth-field-sm">
                    <x-input-label for="password" :value="__('Senha')" />
                    <x-text-input id="password" type="password" name="password"
                        placeholder="••••••••" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Confirmar senha --}}
                <div class="auth-field auth-field-sm">
                    <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />
                    <x-text-input id="password_confirmation" type="password"
                        name="password_confirmation" placeholder="••••••••"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- Função --}}
                <div class="auth-field auth-field-sm">
                    <x-input-label for="function" :value="__('Função')" />
                    <select id="function" name="function" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="scrum master">Scrum Master</option>
                        <option value="dev">Desenvolvedor</option>
                        <option value="designer">Designer</option>
                    </select>
                    <x-input-error :messages="$errors->get('function')" class="mt-2" />
                </div>

                {{-- Campo dinâmico — aparece ao selecionar função --}}
                <div class="auth-field auth-field-sm" id="roomField" style="display:none;">
                    <label class="auth-field-label" id="roomFieldLabel">Sala</label>
                    <x-text-input id="room_input" type="text" name="room_name"
                        placeholder="" autocomplete="off" />
                    <x-input-error :messages="$errors->get('room_name')" class="mt-2" />
                </div>

            </div>{{-- fim .register-grid --}}

            <div class="auth-links" style="margin-top: 20px;">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Já tem uma conta?</a>
                @endif
            </div>

            <button type="submit" class="auth-btn">Cadastrar</button>

        </form>
    </div>

    {{-- ══ PAINEL DIREITO (imagem) ══ --}}
    <div class="auth-visual">

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
            <h2>Faça parte<br>do <em>time.</em></h2>
        </div>
    </div>

</div>

<script>
    document.getElementById('function').addEventListener('change', function () {
        const field = document.getElementById('roomField');
        const label = document.getElementById('roomFieldLabel');
        const input = document.getElementById('room_input');

        if (this.value === 'scrum master') {
            field.style.display = 'block';
            label.innerText     = 'Nome da sala';
            input.name          = 'room_name';
            input.placeholder   = 'Ex: Sala Alpha';
        } else if (this.value === 'dev' || this.value === 'designer') {
            field.style.display = 'block';
            label.innerText     = 'Código da sala';
            input.name          = 'room_code';
            input.placeholder   = 'Ex: ALPHA123';
        } else {
            field.style.display = 'none';
        }
    });
</script>

</x-guest-layout>