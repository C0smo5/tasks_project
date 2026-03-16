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
                <h2>Quase<br><em>lá.</em></h2>
            </div>
        </div>

        {{-- ══ PAINEL DIREITO (status) ══ --}}
        <div class="auth-form-panel">

            <div class="auth-header">
                <p class="auth-eyebrow">Solicitação enviada</p>
                <h1 class="auth-title">Aguardando aprovação</h1>
                <p class="auth-desc">
                    Seu pedido foi enviado ao Scrum Master da sala.
                    Assim que ele aprovar, você terá acesso ao projeto.
                </p>
            </div>

            {{-- Ícone de espera --}}
            <div class="waiting-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>

            {{-- Info da sala --}}
            @if(isset($room))
            <div class="waiting-room-info">
                <span class="waiting-room-label">Sala</span>
                <span class="waiting-room-name">{{ $room->name }}</span>
            </div>
            @endif

            {{-- Dots animados --}}
            <div class="waiting-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <p class="waiting-hint">
                Você pode fechar esta página. Quando aprovado, basta fazer login normalmente.
            </p>

            <a href="{{ route('login') }}" class="auth-link-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Voltar ao login
            </a>

        </div>

    </div>

    <style>
        /* ── Ícone central ── */
        .waiting-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--input-bg);
            margin: 0 auto 32px;
        }

        .waiting-icon svg {
            width: 32px;
            height: 32px;
            color: var(--accent);
            animation: pulse-icon 2.4s ease-in-out infinite;
        }

        @keyframes pulse-icon {
            0%, 100% { opacity: 1;   transform: scale(1);    }
            50%       { opacity: .5; transform: scale(.92);  }
        }

        /* ── Info da sala ── */
        .waiting-room-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 32px;
        }

        .waiting-room-label {
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .waiting-room-name {
            font-size: .88rem;
            color: var(--text);
        }

        /* ── Dots animados ── */
        .waiting-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 32px;
        }

        .waiting-dots span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: dot-bounce .9s ease-in-out infinite;
        }

        .waiting-dots span:nth-child(2) { animation-delay: .15s; }
        .waiting-dots span:nth-child(3) { animation-delay: .30s; }

        @keyframes dot-bounce {
            0%, 80%, 100% { transform: translateY(0);   opacity: .3; }
            40%            { transform: translateY(-6px); opacity: 1;  }
        }

        /* ── Dica ── */
        .waiting-hint {
            font-size: .78rem;
            color: var(--muted);
            line-height: 1.7;
            text-align: center;
            margin-bottom: 32px;
            padding: 0 8px;
        }
    </style>

</x-guest-layout>
