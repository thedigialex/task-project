@props(['task'])

<div class="shadow-lg p-2 rounded-md w-64 bg-header" x-data="{ open: false }">
    <div class="flex items-center justify-between">
        <span class="text-sm font-semibold text-text">{{ $task->priority }}</span>
        <span class="text-text">{{ $task->user->name ?? 'Unassigned' }}</span>
    </div>
    <div class="mt-2">
        <button @click="open = !open" class=" hover:scale-110 px-2 text-accent rounded-md focus:outline-none">
            <span x-text="open ? '▲' : '▼'"></span>
        </button>
        <a href="{{ route('tasks.edit', ['taskId' => $task->id]) }}" class="font-bold text-lg text-accent hover:text-text hover:cursor-pointer transition-colors ease-in-out">
            {{ $task->title }}
        </a>
    </div>
    <div class="flex flex-col">
        <div x-show="open" class="w-full mt-4">
            <x-paragraph>{{ $task->truncateString($task->description, 5) }}</x-paragraph>
            <hr class="my-4">
            @foreach($task->subtasks as $subtask)
            <div class="flex items-center space-x-4 justify-center py-2">
                <div class="w-8 h-8 rounded-full {{ $subtask->is_complete ? 'bg-green-500' : 'bg-red-500' }}">
                </div>
                <div class="w-3/4">
                    <a href="{{ route('subtasks.edit', ['subtaskId' => $subtask->id]) }}" class="text-accent hover:underline">
                        {{ $subtask->name }}
                    </a>
                </div>
            </div>
            @endforeach
            <div class="flex justify-center mt-4">
                <a href="{{ route('subtasks.create', ['taskId' => $task->id]) }}">
                    <x-primary-button>New Sub Task</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</div>