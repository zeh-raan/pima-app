<div class="bg-white p-2 rounded flex justify-between items-center shadow">
    <span class="{{ $task->status === 'done' ? 'line-through text-gray-400' : '' }}">
        {{ $task->title }}
    </span>
    <select onchange="updateTaskStatus({{ $task->id }}, this.value)" class="border rounded p-1">
        <option value="todo" {{ $task->status==='todo'?'selected':'' }}>To Do</option>
        <option value="doing" {{ $task->status==='doing'?'selected':'' }}>Doing</option>
        <option value="done" {{ $task->status==='done'?'selected':'' }}>Done</option>
    </select>
</div>
