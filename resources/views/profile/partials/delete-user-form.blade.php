<section class="profile-danger">
    <div class="profile-section-title">Zona de perigo</div>

    <p>
        Uma vez que sua conta for deletada, todos os seus dados serão permanentemente removidos.
        Antes de prosseguir, baixe qualquer dado que deseje manter.
    </p>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-danger">
        Deletar conta
    </button>
</section>

{{-- Modal de confirmação --}}
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

    <style>
        /* Estiliza o modal para combinar com o tema */
        [x-cloak] { display: none !important; }

        .modal-inner {
            padding: 36px;
            background: var(--surface);
            border-radius: 16px;
        }

        .modal-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            font-weight: 400;
            color: var(--text);
            margin-bottom: 12px;
        }

        .modal-desc {
            font-size: .82rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .modal-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-cancel {
            padding: 11px 22px;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: .78rem;
            color: var(--muted);
            cursor: pointer;
            transition: border-color .15s, color .15s;
        }

        .btn-cancel:hover { border-color: #444; color: var(--text); }
    </style>

    <div class="modal-inner">
        <h2 class="modal-title">Deletar conta</h2>
        <p class="modal-desc">
            Tem certeza que deseja deletar sua conta? Esta ação é irreversível e todos os seus dados serão permanentemente removidos.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="auth-field">
                <x-input-label for="password_delete" :value="__('Confirme sua senha para continuar')" />
                <x-text-input id="password_delete"
                    type="password" name="password"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel"
                    x-on:click="$dispatch('close-modal', 'confirm-user-deletion')">
                    Cancelar
                </button>
                <button type="submit" class="btn-danger">
                    Deletar permanentemente
                </button>
            </div>
        </form>
    </div>

</x-modal>