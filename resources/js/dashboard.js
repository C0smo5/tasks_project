// ══════════════════════════════════════════════
//  DROPDOWN DE SALAS
// ══════════════════════════════════════════════

window.toggleRooms = function toggleRooms() {
    const trigger  = document.getElementById('roomsTrigger');
    const dropdown = document.getElementById('roomsDropdown');
    const isOpen   = trigger.classList.contains('open');

    trigger.classList.toggle('open', !isOpen);
    dropdown.classList.toggle('open', !isOpen);
}

window.selectRoom = function selectRoom(name, initial, el) {
    document.getElementById('currentRoomName').textContent = name;
    document.getElementById('breadcrumbRoom').textContent  = name;
    document.querySelector('.rooms-trigger .room-avatar').textContent = initial;

    document.querySelectorAll('.dropdown-room-item').forEach(item => {
        item.classList.remove('active');
        const check = item.querySelector('.dropdown-room-check');
        if (check) check.remove();
    });

    el.classList.add('active');
    const check = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    check.setAttribute('class', 'dropdown-room-check');
    check.setAttribute('viewBox', '0 0 24 24');
    check.setAttribute('fill', 'none');
    check.setAttribute('stroke', 'currentColor');
    check.setAttribute('stroke-width', '2.5');
    check.setAttribute('stroke-linecap', 'round');
    check.setAttribute('stroke-linejoin', 'round');
    check.innerHTML = '<polyline points="20 6 9 17 4 12"/>';
    el.appendChild(check);

    document.getElementById('roomsTrigger').classList.remove('open');
    document.getElementById('roomsDropdown').classList.remove('open');
}

// Fecha dropdown ao clicar fora
document.addEventListener('click', e => {
    const trigger  = document.getElementById('roomsTrigger');
    const dropdown = document.getElementById('roomsDropdown');
    if (!trigger || !dropdown) return;
    if (!trigger.contains(e.target) && !dropdown.contains(e.target)) {
        trigger.classList.remove('open');
        dropdown.classList.remove('open');
    }
});

// ══════════════════════════════════════════════
//  FILTROS
// ══════════════════════════════════════════════

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    });
});

// ══════════════════════════════════════════════
//  MODAL CRIAR TASK
// ══════════════════════════════════════════════

window.fecharModal = function fecharModal(e) {
    if (e.target.id === 'modalCriarTask') {
        document.getElementById('modalCriarTask').classList.remove('open');
    }
}

// ══════════════════════════════════════════════
//  MODAL DETALHE DA TASK
// ══════════════════════════════════════════════

window.openTaskDetail = function openTaskDetail(task) {
    const backdrop = document.getElementById('taskDetailBackdrop');

    // Título
    document.getElementById('tdTitle').textContent = task.name ?? '—';

    // Badge de tipo
    document.getElementById('tdBadgeType').textContent = task.type ?? '—';

    // Badge de prioridade com cor dinâmica
    const priorityBadge = document.getElementById('tdBadgePriority');
    priorityBadge.textContent = task.priority ?? '—';
    priorityBadge.className = 'td-badge';
    const priorityMap = {
        'alta':  'td-badge-alta',
        'media': 'td-badge-media',
        'baixa': 'td-badge-baixa',
    };
    priorityBadge.classList.add(priorityMap[task.priority?.toLowerCase()] ?? 'td-badge-media');

    // Descrição
    document.getElementById('tdDesc').textContent =
        task.descri_task?.trim() ? task.descri_task : 'Sem descrição cadastrada.';

    // Meta
    document.getElementById('tdDate').textContent   = task.date_expiration ?? '—';
    document.getElementById('tdStatus').textContent = task.status          ?? 'Pendente';

    // Atribuído para
    const assigneeName = task.who_does_name ?? 'Não atribuído';
    document.getElementById('tdAssigneeInitial').textContent = assigneeName.charAt(0).toUpperCase();
    document.getElementById('tdAssigneeName').textContent    = assigneeName;
    document.getElementById('tdAssigneeRole').textContent    = task.who_does_role ?? '';

    // ID no botão de deletar
    const deleteBtn = document.getElementById('tdDeleteBtn');
    if (deleteBtn) deleteBtn.dataset.taskId = task.id ?? '';

    // Abre o painel
    backdrop.classList.add('open');
    document.body.style.overflow = 'hidden';
}

window.closeTaskDetail = function closeTaskDetail() {
    document.getElementById('taskDetailBackdrop').classList.remove('open');
    document.body.style.overflow = '';
}

// Fecha ao clicar no backdrop (fora do painel)
document.addEventListener('DOMContentLoaded', () => {
    const backdrop = document.getElementById('taskDetailBackdrop');
    if (backdrop) {
        backdrop.addEventListener('click', e => {
            if (e.target === backdrop) closeTaskDetail();
        });
    }
});

// ── ESC fecha qualquer modal aberto ──
document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;
    document.getElementById('modalCriarTask')?.classList.remove('open');
    closeTaskDetail();
});

// ══════════════════════════════════════════════
//  SININHO DE NOTIFICAÇÕES
// ══════════════════════════════════════════════

window.toggleNotif = function toggleNotif() {
    const dropdown = document.getElementById('notifDropdown');
    dropdown.classList.toggle('open');
}

// Fecha ao clicar fora
document.addEventListener('click', e => {
    const wrap     = document.querySelector('.notif-wrap');
    const dropdown = document.getElementById('notifDropdown');
    if (!wrap || !dropdown) return;
    if (!wrap.contains(e.target)) {
        dropdown.classList.remove('open');
    }
});