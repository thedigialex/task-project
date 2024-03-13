@props(['task'])

<div class="shadow-lg p-5 rounded-md transition-transform duration-200 w-56" >
    <div class="flex items-center justify-between">
        <span class="text-sm font-semibold">{{ $task->priority }}</span>
        <span>{{ $task->user->name ?? 'Unassigned' }}</span>
    </div>
    <div class="mt-4 text-center">
        <a @click="$dispatch('task-info-click', { id:{{ $task->id }}, title:'{{ $task->title }}', description:'{{ $task->description }}', priority:'{{ $task->priority }}', target_date:'{{ $task->target_date }}', hours_required:'{{ $task->hours_required }}', technological_level:'{{ $task->technological_level }}', image_path:'{{ $task->image_path }}'})" class="task-info-link font-bold text-lg text-blue-500 hover:text-blue-700 hover:cursor-pointer transition-colors ease-in-out">
            {{ $task->title }}
        </a>
        <p class="text-sm text-gray-600">{{ $task->truncatDescription()}}</p>
    </div>
    <hr class="my-4">
    <div class="flex flex-col" x-data="{ open: false }" >
        <button @click="open = !open" class=" hover:scale-110 px-4 py-2 text-blue-500 rounded-md focus:outline-none">
            <span x-text="open ? '▲' : '▼'"></span>
        </button>
        <div x-show="open" class="mt-2 w-full">
            @foreach($task->subtasks as $subtask)
            <div class="flex items-center space-x-4 justify-center py-2">
                <button type="button" class="toggle-status w-1/4 h-10 rounded-lg transition-colors duration-300 {{ $subtask->is_complete ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}" data-subtask-id="{{ $subtask->id }}" data-subtask-status="{{ $subtask->is_complete }}">
                </button>
                <div class="w-3/4">
                    <a href="{{ route('subtasks.edit', ['subtaskId' => $subtask->id]) }}" class="text-blue-500 hover:underline">
                        {{ $subtask->name }}
                    </a>
                </div>
            </div>
            @endforeach
            <div class="flex items-center space-x-4 justify-center py-4">
                <a href="{{ route('subtasks.create', ['taskId' => $task->id]) }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md focus:outline-none hover:bg-blue-600 transition-colors duration-300">New Subtask</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.toggle-status').on('click', function() {
            let button = $(this);
            let subtaskId = button.data('subtask-id');
            let isCompleted = button.data('subtask-status');
            $.ajax({
                url: '/subtasks/toggle/' + subtaskId,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: 'PATCH',
                    is_completed: !isCompleted
                },
                success: function() {
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