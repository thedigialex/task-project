@props(['task'])

<div class="shadow-lg p-5 rounded-md transition-transform duration-200 w-48 shadow-lg hover:scale-105">
    <div class="flex items-center justify-between">
        <span class="text-sm font-semibold">{{ $task->priority }}</span>
        <span>{{ $task->user->name ?? 'Unassigned' }}</span>
    </div>
    <div class="mt-4 text-center">
        <a @click="$dispatch('task-info-click', { id:{{ $task->id }}, title:'{{ $task->title }}', description:'{{ $task->description }}', priority:'{{ $task->priority }}', target_date:'{{ $task->target_date }}', hours_required:'{{ $task->hours_required }}', technological_level:'{{ $task->technological_level }}', image_path:'{{ $task->image_path }}'})" class="task-info-link font-bold text-lg text-blue-500 hover:text-blue-700 hover:cursor-pointer transition-colors ease-in-out">
            {{ $task->title }}
        </a>
        <p class="text-sm text-gray-600">{{ $task->description }}</p>
    </div>
    <hr class="my-4">
    <div x-data="{ open: false }">
        <button @click="open = !open" class="px-4 py-2 bg-blue-500 text-white rounded-md focus:outline-none text-center">
            ▼
        </button>
        <div x-show="open" class="mt-2">
            <ul>
                @foreach($task->subtasks as $subtask)
                <li>
                    <button type="button" class="toggle-status py-3 px-6 rounded {{ $subtask->is_complete ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}" data-subtask-id="{{ $subtask->id }}" data-subtask-status="{{ $subtask->is_complete }}">
                    </button>
                    <a href="{{ route('subtasks.edit', ['subtaskId' => $subtask->id]) }}" class="ps-8 inline text-blue-500 hover:underline">
                        {{ $subtask->name }}
                    </a>: {{ $subtask->description }}
                </li>
                @endforeach
                <li>
                    <x-button>
                        <a href="{{ route('subtasks.create', ['taskId' => $task->id]) }}">New Subtask</a>
                    </x-button>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.toggle-status').on('click', function() {
            var button = $(this);
            var subtaskId = button.data('subtask-id');
            var isCompleted = button.data('subtask-status');
            $.ajax({
                url: '/subtasks/toggle/' + subtaskId,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: 'PATCH',
                    is_completed: !isCompleted
                },
                success: function(response) {
                    if (isCompleted) {
                        button.removeClass('bg-green-500 hover:bg-green-600').addClass('bg-red-500 hover:bg-red-600');
                    } else {
                        button.removeClass('bg-red-500 hover:bg-red-600').addClass('bg-green-500 hover:bg-green-600');
                    }
                    button.data('subtask-status', !isCompleted);
                }
            });
        });
    });
</script>