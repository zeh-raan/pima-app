<div class="task-card">
    <h4 class="outfit {{ $task->status === 'done' ? 'done' : '' }}">
        {{ $task->title }}
    </h4>

    <span class="task-due inter">
        Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
    </span>

    <select onchange="updateTaskStatus({{ $task->id }}, this.value)" class="">
        <option value="pending" {{ $task->status==='todo'?'selected':'' }}>Pending</option>
        <option value="done" {{ $task->status==='doing'?'selected':'' }}>Done</option>
        <option hidden value="missed" {{ $task->status==='done'?'selected':'' }}>Missed</option>
    </select>
</div>
