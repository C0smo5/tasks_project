// ── Dropdown de salas ──
function toggleRooms() {
    const trigger  = document.getElementById('roomsTrigger');
    const dropdown = document.getElementById('roomsDropdown');
    const isOpen   = trigger.classList.contains('open');

    trigger.classList.toggle('open', !isOpen);
    dropdown.classList.toggle('open', !isOpen);
}

function selectRoom(name, initial, el) {
    // Atualiza trigger
    document.getElementById('currentRoomName').textContent = name;
    document.getElementById('breadcrumbRoom').textContent  = name;
    document.querySelector('.rooms-trigger .room-avatar').textContent = initial;

    // Remove active e check dos outros itens
    document.querySelectorAll('.dropdown-room-item').forEach(item => {
        item.classList.remove('active');
        const check = item.querySelector('.dropdown-room-check');
        if (check) check.remove();
    });

    // Marca o selecionado
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

    // Fecha dropdown
    document.getElementById('roomsTrigger').classList.remove('open');
    document.getElementById('roomsDropdown').classList.remove('open');
}

// Fecha ao clicar fora
document.addEventListener('click', e => {
    const trigger  = document.getElementById('roomsTrigger');
    const dropdown = document.getElementById('roomsDropdown');
    if (!trigger.contains(e.target) && !dropdown.contains(e.target)) {
        trigger.classList.remove('open');
        dropdown.classList.remove('open');
    }
});

// ── Filtros ──
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    });
});