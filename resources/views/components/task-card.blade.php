<div class="task-card" id="task-{{ $task->id }}">
    <h4 class="outfit {{ $task->status === 'done' ? 'done' : '' }}" id="task-title-{{ $task->id }}">
        {{ $task->title }}
    </h4>

    <span class="task-due inter">
        Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
    </span>

    <select onchange="TaskCRUD.updateStatus({{ $task->id }}, this.value)">
        <option value="pending" {{ $task->status==='pending'?'selected':'' }}>Pending</option>
        <option value="done" {{ $task->status==='done'?'selected':'' }}>Done</option>
    </select>

    <div class="task-actions">
        <button onclick="TaskCRUD.edit({{ $task->id }}, '{{ $task->title }}', '{{ $task->due_date }}', '{{ $task->status }}')">Edit</button>
        <button onclick="TaskCRUD.delete({{ $task->id }})">Delete</button>
    </div>
</div>