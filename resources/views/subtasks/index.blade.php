<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-center p-2">
            <h2 class="dark:text-white text-xl font-bold">
                {{ __('Subtasks for ') . $taskName}}
            </h2>
        </div>
    </x-slot>
    <div class="flex flex-col dark:text-white bg-gray-300 dark:bg-gray-800 p-2">
        <h2 class="flex justify-center text-xl">SubTasks</h2>
        <div class="flex flex-col dark:bg-gray-300">
            @foreach($subtasks as $subtask)
                <div class="flex flex-row">
                    <p>Name</p>
                    <p>Description</p>
                    <p>Is Complete</p>
                </div>
                <div class="flex flex-row">
                    <div>{{$subtask->name}}</div>
                    <div>{{$subtask->description}}</div>
                    <div>{{$subtask->is_complete}}</div>
                </div>
                <button>
                    <a href="{{ route('subtasks.edit', ['subtaskId' => $subtask->id]) }}">Edit</a>
                </button>
            @endforeach
        </div>
        <button>
            <a href="{{ route('subtasks.create', ['taskId' => $task->id]) }}">Create New Subtask</a>
        </button>

    </div>
    {{--        @foreach($subtasks as $subtask)
                <div class="flex flex-col dark:bg-gray-300">
                    <div class="flex p-1">
                        {{$subtask->name}}
                        {{$subtask->description}}
                        {{$subtask->is_complete}}
                    </div>

                </div>
            @endforeach--}}
</x-app-layout>
