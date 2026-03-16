<x-app-layout>

<x-slot name="header"><span></span></x-slot>

<div class="dash-layout">

    <x-dashnavbar />

    <x-dashsidebar :tasks="$tasks" />

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
                <span id="breadcrumbRoom">{{ $room->name ?? 'Sem sala' }}</span>
            </div>
            <div class="dash-topbar-right">
                <div class="dash-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    Buscar tasks...
                </div>

                {{-- Sininho — só aparece para scrum master --}}
                @if(auth()->user()->function === 'scrum master')
                    <div class="notif-wrap">
                        <button class="notif-btn" onclick="toggleNotif()" id="notifBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                            </svg>
                            @if($pendentes->count() > 0)
                                <span class="notif-badge">{{ $pendentes->count() }}</span>
                            @endif
                        </button>

                        {{-- Dropdown de requisições --}}
                        <div class="notif-dropdown" id="notifDropdown">
                            <div class="notif-header">
                                <span class="notif-title">Solicitações pendentes</span>
                                <span class="notif-count">{{ $pendentes->count() }}</span>
                            </div>
                            <div class="notif-list">
                                @forelse($pendentes as $pendente)
                                    <div class="notif-item">
                                        <div class="notif-avatar">{{ strtoupper(substr($pendente->user->name, 0, 1)) }}</div>
                                        <div class="notif-info">
                                            <div class="notif-name">{{ $pendente->user->name }}</div>
                                            <div class="notif-role">{{ $pendente->user->function }}</div>
                                        </div>
                                        <div class="notif-actions">
                                            <form method="POST" action="{{ route('room-requests.aprovar', $pendente->id) }}">
                                                @csrf
                                                <button type="submit" class="notif-btn-aprovar" title="Aprovar">✓</button>
                                            </form>
                                            <form method="POST" action="{{ route('room-requests.recusar', $pendente->id) }}">
                                                @csrf
                                                <button type="submit" class="notif-btn-recusar" title="Recusar">✕</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="notif-empty">Nenhuma solicitação pendente</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        {{-- Info card --}}
        <div class="dash-info-card">
            <div class="dash-info-left">
                <h2>Dashboard principal</h2>
                <p>Tasks organizadas por prazo — {{ now()->format('d \d\e F \d\e Y') }}</p>

                {{-- Código da sala — só para scrum master --}}
                @if(auth()->user()->function === 'scrum master' && $room)
                    <div class="room-code-tag">
                        <span class="room-code-label">Código da sala</span>
                        <span class="room-code-value">{{ $room->id_share }}</span>
                    </div>
                @endif
            </div>
            <div class="dash-info-stats">
                <div class="stat-item">
                    <div class="stat-val">{{ $totalTasks }}</div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-item">
                    <div class="stat-val">{{ $emAndamento }}</div>
                    <div class="stat-label">Em andamento</div>
                </div>
                <div class="stat-item">
                    <div class="stat-val">{{ $urgentes }}</div>
                    <div class="stat-label">Urgentes</div>
                </div>
            </div>
        </div>

        {{-- Filtros + botão criar task --}}
        <div class="dash-filters">
            <span class="filter-label">Filtrar:</span>
            <button class="filter-btn active">Todos</button>
            <button class="filter-btn">Prazo</button>
            <button class="filter-btn">Tipo</button>
            <button class="filter-btn">Data</button>
            <button class="filter-btn">Alta prioridade</button>

            @can('create-task')
                <button class="auth-btn" style="width:auto; padding:7px 18px; font-size:.72rem; margin-left:auto;"
                        onclick="document.getElementById('modalCriarTask').classList.add('open')">
                    <svg style="width:12px;height:12px;display:inline;margin-right:6px;vertical-align:middle;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Nova task
                </button>
            @endcan
        </div>

        {{-- Lista de tasks --}}
        <div class="dash-tasks">

            <div class="tasks-header">
                <div>Task</div>
                <div>Status</div>
                <div>Tipo</div>
                <div>Prazo</div>
                <div>Prioridade</div>
            </div>

            @forelse($tasks as $task)
                @php
                    $taskJson = json_encode([
                        'id'              => $task->id,
                        'name'            => $task->name,
                        'type'            => $task->type,
                        'priority'        => $task->priority,
                        'descri_task'     => $task->descri_task ?? null,
                        'date_expiration' => $task->date_expiration,
                        'status'          => $task->status ?? 'pendente',
                        'who_does_name'   => optional($task->assignee)->name ?? 'Não atribuído',
                        'who_does_role'   => optional($task->assignee)->function ?? '',
                    ]);

                    $statusClass = match(strtolower($task->status ?? '')) {
                        'pendente'     => 'status-pendente',
                        'semi-entrega' => 'status-semi-entrega',
                        'entrega'      => 'status-entrega',
                        default        => 'status-pendente',
                    };
                @endphp
                <div class="task-item"
                     data-task="{{ $taskJson }}"
                     onclick="openTaskDetail(JSON.parse(this.dataset.task))">
                    <div class="task-name">
                        <div class="task-check"></div>{{ $task->name }}
                    </div>
                    <div class="task-status {{ $statusClass }}">{{ $task->status ?? 'pendente' }}</div>
                    <div class="task-type">{{ $task->type }}</div>
                    <div class="task-date urgent">{{ $task->date_expiration }}</div>
                    <div><span class="task-badge badge-{{ $task->priority ?? 'baixa' }}">{{ $task->priority }}</span></div>
                </div>
            @empty
                <div class="tasks-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <line x1="9" y1="9" x2="15" y2="9"/>
                        <line x1="9" y1="13" x2="13" y2="13"/>
                    </svg>
                    <p>Nenhuma task encontrada<br>para este projeto.</p>
                </div>
            @endforelse

        </div>

    </main>

    <x-dashright />

</div>

{{-- ══ MODAL CRIAR TASK ══ --}}
<div class="task-modal-backdrop" id="modalCriarTask" onclick="fecharModal(event)">
    <div class="task-modal">

        <div class="task-modal-header">
            <div>
                <p class="auth-eyebrow" style="margin-bottom:6px;">Nova task</p>
                <h2 class="task-modal-title">Criar task</h2>
            </div>
            <button class="task-modal-close"
                    onclick="document.getElementById('modalCriarTask').classList.remove('open')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="/tasks" class="task-modal-body">
            @csrf

            <div class="auth-field">
                <x-input-label for="task_nome" :value="__('Nome da task')" />
                <x-text-input id="task_nome" type="text" name="name"
                    placeholder="Ex: Implementar login OAuth" required />
            </div>

            <div class="auth-field">
                <x-input-label for="task_descricao" :value="__('Descrição')" />
                <textarea id="task_descricao" name="descri_task"
                    placeholder="Descreva o que precisa ser feito..."
                    class="task-modal-textarea"></textarea>
            </div>

            <div class="task-modal-grid">

                <div class="auth-field">
                    <x-input-label for="task_tipo" :value="__('Tipo')" />
                    <select id="task_tipo" name="type">
                        <option value="" disabled selected>Selecione</option>
                        <option value="feature">Feature</option>
                        <option value="review">Review</option>
                        <option value="design">Design</option>
                        <option value="docs">Docs</option>
                        <option value="devops">DevOps</option>
                        <option value="bug">Bug</option>
                    </select>
                </div>

                <div class="auth-field">
                    <x-input-label for="task_prioridade" :value="__('Prioridade')" />
                    <select id="task_prioridade" name="priority">
                        <option value="" disabled selected>Selecione</option>
                        <option value="alta">Alta</option>
                        <option value="media">Media</option>
                        <option value="baixa">Baixa</option>
                    </select>
                </div>

                <div class="auth-field">
                    <x-input-label for="task_prazo" :value="__('Prazo')" />
                    <x-text-input id="task_prazo" type="date" name="date_expiration" />
                </div>

                <div class="auth-field">
                    <x-input-label for="task_atribuir" :value="__('Atribuir para')" />
                    <select id="task_atribuir" name="who_does">
                        <option value="" disabled selected>Selecione</option>
                        <option value="1">Usuário exemplo</option>
                    </select>
                </div>

            </div>

            <div class="task-modal-footer">
                <button type="button" class="auth-btn-outline"
                        onclick="document.getElementById('modalCriarTask').classList.remove('open')">
                    Cancelar
                </button>
                <button type="submit" class="auth-btn" style="width:auto; padding:12px 28px;">
                    Criar task
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ══ MODAL DETALHE DA TASK ══ --}}
<div class="task-detail-backdrop" id="taskDetailBackdrop">
    <div class="task-detail-panel">

        <div class="task-detail-header">
            <div class="task-detail-header-left">
                <span class="task-detail-eyebrow">Detalhes da task</span>
                <div class="task-detail-title" id="tdTitle">—</div>
            </div>
            <button class="task-detail-close" onclick="closeTaskDetail()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="task-detail-body">

            <div class="task-detail-badges">
                <span class="td-badge td-badge-type" id="tdBadgeType">—</span>
                <span class="td-badge"               id="tdBadgePriority">—</span>
            </div>

            <div class="task-detail-section">
                <div class="task-detail-section-label">Descrição</div>
                <div class="task-detail-desc" id="tdDesc">—</div>
            </div>

            <div class="task-detail-meta">
                <div class="task-meta-item">
                    <div class="task-meta-label">Prazo</div>
                    <div class="task-meta-value" id="tdDate">—</div>
                </div>
                <div class="task-meta-item">
                    <div class="task-meta-label">Status</div>
                    <div class="task-meta-value" id="tdStatus">—</div>
                </div>
            </div>

            <div class="task-detail-section">
                <div class="task-detail-section-label">Atribuído para</div>
                <div class="task-detail-assignee">
                    <div class="assignee-avatar" id="tdAssigneeInitial">?</div>
                    <div class="assignee-info">
                        <div class="assignee-name" id="tdAssigneeName">—</div>
                        <div class="assignee-role" id="tdAssigneeRole">—</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="task-detail-footer">
            <button class="td-btn-outline" onclick="closeTaskDetail()">Fechar</button>

            @can('create-task')
                <button class="td-btn-danger" id="tdDeleteBtn"
                        onclick="confirmarDelete(this.dataset.taskId)">
                    Excluir task
                </button>
            @endcan
        </div>

    </div>
</div>

</x-app-layout>