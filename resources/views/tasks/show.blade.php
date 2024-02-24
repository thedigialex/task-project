<div x-data="{ showModal: false, task: {}}" x-init="document.addEventListener('task-info-click', event => { showModal = true; task = event.detail; })">
    <div x-show="showModal" class="modal flex text-center justify-center">
        <div class="modal-content flex flex-col self-center bg-gray-100 dark:bg-gray-200 p-2 rounded-lg w-full max-w-[500px]">
            {{-- Task Title --}}
            <div class="flex flex-row justify-center ml-2.5 w-full">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight w-11/12 " x-text="task.title"></h2>
                <div class="close max-w-4 text-2xl hover:cursor-pointer text-red-800" @click="showModal = false">&times;</div>
            </div>
            {{-- Task Completion Date --}}
            <div class="flex flex-row justify-around">
                <p class="text-sm  font-bold">Expected Completion Date:</p>
                <div class="text-sm" x-text="task.completion_expected_date"></div>
            </div>
            {{-- Task Information --}}
            <div class="flex flex-col pt-1" x-show="task.id">
                <div class="flex flex-row justify-around">
                    <div class="flex flex-col w-1/2 font-bold">
                        <p>Hours:</p>
                        <p>Priority:</p>
                        <p>Tech Level:</p>
                    </div>
                    <div class="flex flex-col w-1/2">
                        <div x-text="task.hours_required"></div>
                        <div x-text="task.priority"></div>
                        <div x-text="task.technological_level"></div>
                    </div>
                </div>
                {{-- Task Description --}}
                <div class="flex flex-col py-2">
                    <p class="font-bold">Description</p>
                    <div x-text="task.description"></div>
                </div>
                {{-- Task Image and Edit button to modify task --}}
                <div class="py-2" x-show="task.image_path">
                    <img :src="'/storage/' + task.image_path" alt="Task Image" class="max-w-full h-auto mb-4">
                </div>

                <div class="flex flex-row justify-evenly">
                    <button class="text-white bg-gray-600 hover:bg-gray-500 dark:bg-gray-500 dark:hover:bg-gray-600 shadow shadow-gray-400  hover:shadow-md hover:shadow-gray-400 hover:cursor-pointer rounded px-4 transition duration-150">
                        <a :href="'{{ route('tasks.edit', ['taskId' => 'TASK_ID']) }}'.replace('TASK_ID', task.id)">Edit</a>
                    </button>
                    <button class="close text-white bg-gray-600 hover:bg-gray-500 dark:bg-gray-500 dark:hover:bg-gray-600 shadow shadow-gray-400 hover:shadow-md hover:shadow-gray-400  rounded hover:cursor-pointer px-4 transition duration-150" @click="showModal = false">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
