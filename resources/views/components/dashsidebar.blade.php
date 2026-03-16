{{-- resources/views/components/dashsidebar.blade.php --}}
{{-- Recebe $tasks via prop ou da view pai --}}

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

        @forelse($tasks as $task)
            @php
                $taskJson = json_encode([
                    'id'              => $task->id,
                    'name'            => $task->name,
                    'type'            => $task->type,
                    'priority'        => $task->priority,
                    'descri_task'     => $task->descri_task ?? null,
                    'date_expiration' => $task->date_expiration,
                    'status'          => $task->status ?? 'Pendente',
                    'who_does_name'   => optional($task->assignee)->name ?? 'Não atribuído',
                    'who_does_role'   => optional($task->assignee)->function ?? '',
                ]);
            @endphp
            <a href="#" class="sidebar-task-item active"
               data-task="{{ $taskJson }}"
               onclick="event.preventDefault(); openTaskDetail(JSON.parse(this.dataset.task))">
                <div class="sidebar-task-dot dot-{{ $task->priority ?? 'baixa' }}"></div>
                <span class="sidebar-task-name">{{ $task->name }}</span>
            </a>
        @empty
            <a href="#" class="sidebar-task-item">
                <div class="sidebar-task-dot dot-baixa"></div>
                <span class="sidebar-task-name">Nenhuma task</span>
            </a>
        @endforelse

    </div>

</aside>