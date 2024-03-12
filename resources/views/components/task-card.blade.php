@props(['priority', 'assignedUser', 'title', 'subtitle', 'subtasks', 'taskId'])

<div class="shadow-lg p-5 rounded-md transition-transform duration-200 w-48 shadow-lg hover:scale-105">
    <div class="flex items-center justify-between">
        <span class="text-sm font-semibold">{{ $priority }}</span>
        <span>{{ $assignedUser }}</span>
    </div>
    <div class="mt-4 text-center">
        <h3 class="text-lg font-medium">{{ $title }}</h3>
        <p class="text-sm text-gray-600">{{ $subtitle }}</p>
    </div>
    <hr class="my-4">
    <div x-data="{ open: false }">
        <button @click="open = !open" class="px-4 py-2 bg-blue-500 text-white rounded-md focus:outline-none text-center">
            ▼
        </button>
        <div x-show="open" class="mt-2">
            <ul>
                @foreach($subtasks as $subtask)
                <li>{{ $subtask->name }}</li>
                @endforeach
                <li>
                    <x-button>
                        <a href="{{ route('subtasks.create', ['taskId' => $taskId]) }}">New Subtask</a>
                    </x-button>
                </li>
            </ul>
        </div>
    </div>
</div>