@props(['task'])

<div class="shadow-lg p-5 rounded-md transition-transform duration-200 w-56 bg-slate-800">
    <div class="flex items-center justify-between">
        <span class="text-sm font-semibold text-cyan-100">{{ $task->priority }}</span>
        <span class="text-cyan-100">{{ $task->user->name ?? 'Unassigned' }}</span>
    </div>
    <div class="mt-4 text-center">
        <a @click="$dispatch('task-info-click', { task: {{ json_encode($task) }} })" class="task-info-link font-bold text-lg text-cyan-400 hover:text-cyan-100 hover:cursor-pointer transition-colors ease-in-out">
            {{ $task->title }}
        </a>
    </div>
    <hr class="my-4">
    <div class="flex flex-col" x-data="{ open: false }">
        <button @click="open = !open" class=" hover:scale-110 px-4 py-2 text-cyan-400 rounded-md focus:outline-none">
            <span x-text="open ? '▲' : '▼'"></span>
        </button>
        <div x-show="open" class="mt-2 w-full">
            @foreach($task->subtasks as $subtask)
            <div class="flex items-center space-x-4 justify-center py-2">
                <div class="w-10 h-10 rounded-full {{ $subtask->is_complete ? 'bg-green-500' : 'bg-red-500' }}">
                </div>
                <div class="w-3/4">
                    <a href="{{ route('subtasks.edit', ['subtaskId' => $subtask->id]) }}" class="text-cyan-400 hover:underline">
                        {{ $subtask->name }}
                    </a>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>