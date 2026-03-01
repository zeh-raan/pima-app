<div class="bg-white p-4 rounded shadow">
    <h3 class="font-bold">{{ $project->title }}</h3>
    <p class="text-gray-600">{{ $project->description }}</p>
    <a href="/projects/{{ $project->id }}/tasks" class="text-blue-500 mt-2 inline-block">View Tasks</a>
</div>
