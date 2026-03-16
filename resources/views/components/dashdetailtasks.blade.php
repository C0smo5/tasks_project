{{-- resources/views/components/dashdetailtasks.blade.php --}}

<aside class="dash-detail">

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

</aside>