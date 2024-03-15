<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-center p-2">
            <h2 class="dark:text-white text-xl font-bold">
                {{ __('Subtasks for ') . $taskName}}
            </h2>
        </div>
    </x-slot>
    <div class="dark:text-white p-2">
        <div class="flex flex-col sm:flex-row bg-gray-300 dark:bg-gray-700 rounded p-2 gap-8">
            @foreach($subtasks as $subtask)
                <div class="flex flex-col border-2 border-gray-400 dark:border-gray-600 hover:border-gray-100 dark:hover:border-gray-800 rounded-md p-4 max-w-fit motion-safe:hover:scale-[1.05] transition duration-200">
                    <div class="flex flex-row space-x-8">
                        <div class="flex flex-col w justify-evenly">
                            <div>Name</div>
                            <div>Is Complete</div>
                            <div>Description</div>
                        </div>
                        <div class="flex flex-col justify-evenly">
                            <div>{{$subtask->name}}</div>
                            <div>{{$subtask->is_complete}}</div>
                            <div>{{$subtask->description}}</div>
                        </div>
                    </div>
                    <button class="text-white bg-gray-600 hover:bg-gray-500 dark:bg-gray-500 dark:hover:bg-gray-600 shadow shadow-gray-500 hover:shadow-gray-500 dark:hover:shadow-gray-600 hover:cursor-pointer rounded px-4 mt-4 transition duration-150">
                        <a href="{{ route('subtasks.edit', ['subtaskId' => $subtask->id]) }}">Edit</a>
                    </button>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center py-1">
            <button class="p-2 rounded bg-gray-300 dark:bg-gray-500 hover:bg-gray-400 dark:hover:bg-gray-600 shadow shadow-gray-300 hover:shadow-gray-400 dark:shadow-gray-500 dark:hover:shadow-gray-600 transition duration-150">
                <a href="{{ route('subtasks.create', ['taskId' => $task->id]) }}">Create New Subtask</a>
            </button>
        </div>
    </div>
</x-app-layout>
