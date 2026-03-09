<x-app-layout>

<x-slot name="header"><span></span></x-slot>

<div class="dash-layout">

    {{-- ══════════════════════════════════
         NAVBAR DE ÍCONES
    ══════════════════════════════════ --}}
    <nav class="dash-navbar">

        <div class="navbar-logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                <path d="M2 17l10 5 10-5"/>
                <path d="M2 12l10 5 10-5"/>
            </svg>
        </div>

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" class="nav-item active" data-tooltip="Dashboard">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
        </a>

        {{-- Chat --}}
        <a href="#" class="nav-item" data-tooltip="Chat">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </a>

        {{-- Calendário --}}
        <a href="#" class="nav-item" data-tooltip="Calendário">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </a>

        {{-- Tasks --}}
        <a href="#" class="nav-item" data-tooltip="Tasks">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <line x1="8" y1="6" x2="21" y2="6"/>
                <line x1="8" y1="12" x2="21" y2="12"/>
                <line x1="8" y1="18" x2="21" y2="18"/>
                <polyline points="3 6 4 7 6 5"/>
                <polyline points="3 12 4 13 6 11"/>
                <polyline points="3 18 4 19 6 17"/>
            </svg>
        </a>

        <div class="navbar-divider"></div>

        {{-- Perfil --}}
        <a href="{{ route('profile.edit') }}" class="nav-item" data-tooltip="Perfil">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </a>

    </nav>

    {{-- ══════════════════════════════════
         SIDEBAR ESQUERDA — Salas
    ══════════════════════════════════ --}}
    <aside class="dash-rooms">

        {{-- Header com dropdown de salas --}}
        <div class="rooms-header">
            <div class="rooms-label">Sala ativa</div>

            <div style="position: relative;">
                <button class="rooms-trigger" id="roomsTrigger" onclick="toggleRooms()">
                    <div class="rooms-trigger-left">
                        <div class="room-avatar">A</div>
                        <span class="room-current-name" id="currentRoomName">Sala Alpha</span>
                    </div>
                    <div class="rooms-chevron">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                </button>

                <div class="rooms-dropdown" id="roomsDropdown">
                    <div class="dropdown-section-label">Suas salas</div>

                    {{-- Salas — substitua por @foreach quando tiver dados --}}
                    <button class="dropdown-room-item active" onclick="selectRoom('Sala Alpha', 'A', this)">
                        <div class="room-avatar-sm">A</div>
                        <span class="dropdown-room-name">Sala Alpha</span>
                        <svg class="dropdown-room-check" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </button>

                    <button class="dropdown-room-item" onclick="selectRoom('Sala Beta', 'B', this)">
                        <div class="room-avatar-sm">B</div>
                        <span class="dropdown-room-name">Sala Beta</span>
                    </button>

                    <button class="dropdown-room-item" onclick="selectRoom('Sala Gamma', 'G', this)">
                        <div class="room-avatar-sm">G</div>
                        <span class="dropdown-room-name">Sala Gamma</span>
                    </button>

                    <div class="dropdown-divider"></div>

                    <button class="dropdown-new-room">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Criar nova sala
                    </button>
                </div>
            </div>
        </div>

        {{-- Tasks da sala atual --}}
        <div class="rooms-tasklist">
            <div class="rooms-tasklist-label">Tasks da sala</div>

            {{-- Substitua por @foreach quando tiver dados --}}
            <a href="#" class="sidebar-task-item active">
                <div class="sidebar-task-dot dot-alta"></div>
                <span class="sidebar-task-name">Implementar OAuth</span>
            </a>
            <a href="#" class="sidebar-task-item">
                <div class="sidebar-task-dot dot-media"></div>
                <span class="sidebar-task-name">Revisar PR #42</span>
            </a>
            <a href="#" class="sidebar-task-item">
                <div class="sidebar-task-dot dot-media"></div>
                <span class="sidebar-task-name">Design mobile</span>
            </a>
            <a href="#" class="sidebar-task-item">
                <div class="sidebar-task-dot dot-baixa"></div>
                <span class="sidebar-task-name">Documentar API</span>
            </a>
            <a href="#" class="sidebar-task-item">
                <div class="sidebar-task-dot dot-feita"></div>
                <span class="sidebar-task-name">CI/CD pipeline</span>
            </a>
            <a href="#" class="sidebar-task-item">
                <div class="sidebar-task-dot dot-feita"></div>
                <span class="sidebar-task-name">Setup do projeto</span>
            </a>
        </div>

    </aside>

    {{-- ══════════════════════════════════
         ÁREA CENTRAL
    ══════════════════════════════════ --}}
    <main class="dash-main">

        {{-- Topbar --}}
        <div class="dash-topbar">
            <div class="dash-breadcrumb">
                Salas
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
                <span id="breadcrumbRoom">Sala Alpha</span>
            </div>
            <div class="dash-topbar-right">
                <div class="dash-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    Buscar tasks...
                </div>
            </div>
        </div>

        {{-- Info card --}}
        <div class="dash-info-card">
            <div class="dash-info-left">
                <h2>Dashboard principal</h2>
                <p>Tasks organizadas por prazo — {{ now()->format('d \d\e F \d\e Y') }}</p>
            </div>
            <div class="dash-info-stats">
                <div class="stat-item">
                    <div class="stat-val">12</div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-item">
                    <div class="stat-val">5</div>
                    <div class="stat-label">Em andamento</div>
                </div>
                <div class="stat-item">
                    <div class="stat-val">3</div>
                    <div class="stat-label">Urgentes</div>
                </div>
            </div>
        </div>

        {{-- Filtros --}}
        <div class="dash-filters">
            <span class="filter-label">Filtrar:</span>
            <button class="filter-btn active">Todos</button>
            <button class="filter-btn">Prazo</button>
            <button class="filter-btn">Tipo</button>
            <button class="filter-btn">Data</button>
            <button class="filter-btn">Alta prioridade</button>
        </div>

        {{-- Lista de tasks --}}
        <div class="dash-tasks">

            <div class="tasks-header">
                <div>Task</div>
                <div>Tipo</div>
                <div>Prazo</div>
                <div>Prioridade</div>
            </div>

            {{-- Tasks mock — substitua por @forelse($tasks as $task) quando tiver dados --}}

            <div class="task-item">
                <div class="task-name">
                    <div class="task-check"></div>
                    Implementar autenticação OAuth
                </div>
                <div class="task-type">Feature</div>
                <div class="task-date urgent">Hoje</div>
                <div><span class="task-badge badge-alta">Alta</span></div>
            </div>

            <div class="task-item">
                <div class="task-name">
                    <div class="task-check"></div>
                    Revisar pull request #42
                </div>
                <div class="task-type">Review</div>
                <div class="task-date soon">Amanhã</div>
                <div><span class="task-badge badge-media">Média</span></div>
            </div>

            <div class="task-item">
                <div class="task-name">
                    <div class="task-check"></div>
                    Design das telas mobile
                </div>
                <div class="task-type">Design</div>
                <div class="task-date">12 mar</div>
                <div><span class="task-badge badge-media">Média</span></div>
            </div>

            <div class="task-item">
                <div class="task-name">
                    <div class="task-check"></div>
                    Documentar API de usuários
                </div>
                <div class="task-type">Docs</div>
                <div class="task-date">15 mar</div>
                <div><span class="task-badge badge-baixa">Baixa</span></div>
            </div>

            <div class="task-item">
                <div class="task-name">
                    <div class="task-check done"></div>
                    <span class="done-text">Configurar CI/CD pipeline</span>
                </div>
                <div class="task-type">DevOps</div>
                <div class="task-date">Concluído</div>
                <div><span class="task-badge badge-feita">Feita</span></div>
            </div>

            <div class="task-item">
                <div class="task-name">
                    <div class="task-check done"></div>
                    <span class="done-text">Setup inicial do projeto</span>
                </div>
                <div class="task-type">Setup</div>
                <div class="task-date">Concluído</div>
                <div><span class="task-badge badge-feita">Feita</span></div>
            </div>

            {{-- @empty
            <div class="tasks-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                    <line x1="9" y1="9" x2="15" y2="9"/>
                    <line x1="9" y1="13" x2="13" y2="13"/>
                </svg>
                <p>Nenhuma task encontrada<br>para este projeto.</p>
            </div>
            @endforelse --}}

        </div>

    </main>

    {{-- ══════════════════════════════════
         SIDEBAR DIREITA
    ══════════════════════════════════ --}}
    <aside class="dash-right">

        {{-- Perfil --}}
        <div class="right-profile">
            <a href="{{ route('profile.edit') }}" class="profile-card">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ auth()->user()->name }}</div>
                    <div class="profile-role">{{ auth()->user()->function ?? 'Membro' }}</div>
                </div>
                <div class="profile-chevron">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </a>
        </div>

        {{-- Histórico de conversas --}}
        <div class="right-history">
            <div class="history-title">Histórico de conversas</div>

            <div class="history-list">

                {{-- Placeholder — substitua por dados reais quando tiver --}}
                <div class="history-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                    <p>Nenhuma conversa<br>ainda.</p>
                </div>

                {{-- Exemplo de item — descomente quando tiver dados:
                <div class="history-item">
                    <div class="history-item-title">Discussão sobre o deploy</div>
                    <div class="history-item-meta">há 2 horas · 3 mensagens</div>
                </div>
                --}}

            </div>
        </div>

        {{-- Logout --}}
        <div class="right-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Sair da conta
                </button>
            </form>
        </div>

    </aside>

</div>



</x-app-layout>